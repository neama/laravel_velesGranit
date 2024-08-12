<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Order;
use App\Models\ProductOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use function PHPUnit\Framework\returnArgument;

class BasketController extends Controller
{
    public function index(Request $request) {
        $basket_id = $request->cookie('basket_id');
        if (!empty($basket_id)) {
            $products = Basket::findOrFail($basket_id)->products;
            return view('basket.index', compact('products'));
        } else {
            abort(404);
        }
    }

    public function checkout() {
        return view('basket.checkout');
    }

    /**
     * Добавляет товар с идентификатором $id в корзину
     */
    public function add(Request $request, $lang, $id) {

        $basket_id = $request->cookie('basket_id');
        $quantity = $request->input('quantity') ?? 1;
        $option = $request->input('option') ?? 0;

        if (empty($basket_id)) {
            // если корзина еще не существует — создаем объект
            $basket = Basket::create();
            // получаем идентификатор, чтобы записать в cookie
            $basket_id = $basket->id;
        } else {
            // корзина уже существует, получаем объект корзины
            $basket = Basket::findOrFail($basket_id);
            // обновляем поле `updated_at` таблицы `baskets`
            $basket->touch();
        }

        if ($basket->products->contains($id)) {
            // если такой товар есть в корзине — изменяем кол-во
            $pivotRow = $basket->products()->where('product_id', $id)->first()->pivot;
            $pivotRow->option = $option;
            $quantity = $pivotRow->quantity + $quantity;
            $pivotRow->update(['quantity' => $quantity,'option'=>$option]);
        } else {
            // если такого товара нет в корзине — добавляем его
            $basket->products()->attach($id, ['quantity' => $quantity,'option'=>$option]);
        }
        // выполняем редирект обратно на страницу, где была нажата кнопка «В корзину»
        if ( ! $request->ajax()) {
            // выполняем редирект обратно на ту страницу,
            // где была нажата кнопка «В корзину»
            return back()->withCookie(cookie('basket_id', $basket_id, 525600));
        }
        $basketCost = 0;

        $positions = $basket::getAmountWithOption();

        // в случае ajax-запроса возвращаем html-код корзины в правом
        // верхнем углу, чтобы заменить исходный html-код, потому что
        // теперь количество позиций будет другим
      //  $positions = $quantity;
        return view('basket.part.basket', compact('positions'));

    }

    /**
     * Увеличивает кол-во товара $id в корзине на единицу
     */
    public function plus(Request $request,$lang, $id) {
        $basket_id = $request->cookie('basket_id');
        if (empty($basket_id)) {
            abort(404);
        }
        $this->change($basket_id, $id, 1);
        // выполняем редирект обратно на страницу корзины
        return redirect()
            ->route('basket.index',['locale' => app()->getLocale()])
            ->withCookie(cookie('basket_id', $basket_id, 525600));
    }

    /**
     * Уменьшает кол-во товара $id в корзине на единицу
     */
    public function minus(Request $request,$lang, $id) {
        $basket_id = $request->cookie('basket_id');
        if (empty($basket_id)) {
            abort(404);
        }
        $this->change($basket_id, $id, -1);
        // выполняем редирект обратно на страницу корзины
        return redirect()
            ->route('basket.index',['locale' => app()->getLocale()])
            ->withCookie(cookie('basket_id', $basket_id, 525600));
    }

    /**
     * Изменяет кол-во товара $product_id на величину $count
     */
    private function change($basket_id, $product_id, $count = 0) {
        if ($count == 0) {
            return;
        }
        $basket = Basket::findOrFail($basket_id);
        // если товар есть в корзине — изменяем кол-во
        if ($basket->products->contains($product_id)) {
            $pivotRow = $basket->products()->where('product_id', $product_id)->first()->pivot;
            $quantity = $pivotRow->quantity + $count;
            if ($quantity > 0) {
                // обновляем кол-во товара $product_id в корзине
                $pivotRow->update(['quantity' => $quantity]);
                // обновляем поле `updated_at` таблицы `baskets`
                $basket->touch();
            } else {
                // кол-во равно нулю — удаляем товар из корзины
                $pivotRow->delete();
            }
        }
    }

    /**
     * Сохранение заказа в БД
     */
    public function saveOrder(Request $request) {
        // проверяем данные формы оформления
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:255',
            'address' => 'required|max:255',
        ]);

        // валидация пройдена, сохраняем заказ
        $basket = Basket::getBasket();
        $user_id = auth()->check() ? auth()->user()->id : null;
        $order = Order::create(
            $request->all() + ['amount' => $basket->getAmount(), 'user_id' => $user_id, 'status'=>0]
        );

        $orderAmount = 0;
        foreach ($basket->products as $product) {
            $pivotRow = $basket->products()->where('product_id', $product->id)->first()->pivot;
            $productOption =$product->getProductOption($pivotRow->option);
            $newItemPrise = $productOption->pluck('prise')->first();
            $optionValuePivot = $productOption->pluck('option_value')->first();
            $itemPrice = $newItemPrise !== null ? $newItemPrise : $product->price;

            $order->items()->create([
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $itemPrice,
                'option' => $optionValuePivot ?? '',
                'quantity' => $product->pivot->quantity,
                'cost' => $itemPrice * $product->pivot->quantity,
            ]);
            $orderAmount += $itemPrice * $product->pivot->quantity;
        }
        $order->amount = $orderAmount;
        $order->save();

        // уничтожаем корзину
        $basket->delete();
        $route = route('basket.orderTelegram',['ticketBase64'=>Crypt::encryptString($order->id),'locale' => app()->getLocale()]);


        $this->sendTelegrammNotificationSuccess($route);


        $details = [
            'title' => 'Было создан заказ на сайте'. request()->getHost(),
            'body' => 'Посмотреть заказ можно по адресу. '.$route
        ];
        Mail::to(env('MAIL_SEND_NOTIFICATION_TO'))->send(new \App\Mail\TestMail($details));

        return redirect()
            ->route('basket.success',['locale' => app()->getLocale()])
            ->with('order_id', $order->id);
    }

    /**
     * Сообщение об успешном оформлении заказа
     */
    public function success(Request $request) {
        if ($request->session()->exists('order_id')) {
            // сюда покупатель попадает сразу после оформления заказа
            $order_id = $request->session()->pull('order_id');
            $order = Order::findOrFail($order_id);


            return view('basket.success', compact('order'));
        } else {
            // если покупатель попал сюда не после оформления заказа
            return redirect()->route('basket.index',['locale' => app()->getLocale()]);
        }
    }

    public function showOrderFromTelegramUrl($lang,$ticketBase64){

        $order_id = Crypt::decryptString($ticketBase64);
        $order = Order::findOrFail($order_id);
        return view('basket.successimple', compact('order','ticketBase64'));
    }

    public function sendTelegrammNotificationSuccess($route){
        $requestUrl = 'https://api.telegram.org/bot'.env('TELEGRAM_TOKEN').'/sendMessage?chat_id='.env('TELEGRAM_CHAT_ID').'&text='.$route;
        Http::get($requestUrl);
    }
    public function updateOrderStatus(Request $request){
        $crypt_tycket = $request->input('order_id');
        $order = Order::findOrFail(Crypt::decryptString($crypt_tycket));
        $order->status = $request->input('status');
        $order->save();
        return redirect()->route('basket.orderTelegram',['ticketBase64'=>$crypt_tycket,'locale' => app()->getLocale()]);
    }

    public function callRequest(Request $request){
        $firsNameLastName = $request->input('fname');
        $phoneNumber =  $request->getHost().'  '.$request->input('phoneNumber');
        $message = "Просят перезвонить ".$firsNameLastName.' номер телефона '.$phoneNumber;
        $this->sendTelegrammNotificationSuccess($message);
        return true;
    }

    public function callRequestFromOtherHost(Request $request,$lang,$params){
        $parms = explode(';',base64_decode($params));
        $firsNameLastName = $parms[0].'  имя '.$parms[1];
        $phoneNumber = $parms[2];
        $message = "Просят перезвонить сайт -  ".$firsNameLastName.' номер телефона '.$phoneNumber;
        $this->sendTelegrammNotificationSuccess($message);
        return true;
    }

    public function callOrderFromOtherHost(Request $request,$lang,$params){
        $parms = explode(';',base64_decode($params));
        $firsNameLastName = $parms[0].'  id ордера - '.$parms[1];
        $message = "Был оформлен заказ сайт - ".$firsNameLastName;
        $this->sendTelegrammNotificationSuccess($message);
        return true;
    }


}
