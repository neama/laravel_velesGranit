<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cookie;


class Basket extends Model
{
    use HasFactory;

    /**
     * Связь «многие ко многим» таблицы `baskets` с таблицей `products`
     */
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity','option');
    }

    /**
     * Возвращает количество позиций в корзине
     */
    public static function getCount()
    {
        $basket_id = request()->cookie('basket_id');
        if (empty($basket_id)) {
            return 0;
        }
        try {
            return self::getBasket()->products->count();
        }catch (Exception $e){
            return 0;
        }

    }

    public static function getBasket()
    {
        $basket_id = request()->cookie('basket_id');
        if (!empty($basket_id)) {
            try {
                $basket = Basket::findOrFail($basket_id);
            } catch (ModelNotFoundException $e) {
                $basket = Basket::create();
            }
        } else {
            $basket = Basket::create();
        }
        Cookie::queue('basket_id', $basket->id, 525600);
        return $basket;
    }

    public function getAmount()
    {
        $amount = 0.0;
        foreach ($this->products as $product) {
            $amount = $amount + $product->price * $product->pivot->quantity;
        }
        return $amount;
    }

    public static function getAmountWithOption()
    {
        $basketCost = 0.0;

        foreach ( self::getBasket()->products as $product) {
            $newItemPrise = $product->getProductOption($product->pivot->option)->pluck('prise')->first();
            $newItemOption = $product->getProductOption($product->pivot->option)->pluck('option_value')->first();
            $itemPrice = $newItemPrise !== null ? $newItemPrise : $product->price;
            $itemQuantity =  $product->pivot->quantity;
            $itemCost = $itemPrice * $itemQuantity;
            $basketCost = $basketCost + $itemCost;

        }
        return $basketCost;
    }
}
