<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заказ размещен</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        th {
            background-color: #4CAF50;
            color: white;
            text-align: left;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>

<h1>Заказ размещен</h1>
<h2>Изменить статус заказа</h2>
<form action="{{ route('basket.updateOrder',['locale' => app()->getLocale()]) }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="status">Статус</label>
        <select class="form-control" id="status" name="status">
            @foreach(\App\Models\Order::STATUSES as $status => $label)
                <option value="{{ $status }}" @selected($order->status == $status)>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <input type="hidden" name="order_id" value="{{ $ticketBase64 }}">
    <button type="submit" class="btn btn-primary">Обновить статус</button>
</form>
<h2>Заказ</h2>
<table>
    <thead>
    <tr>
        <th>№</th>
        <th>Наименование</th>
        <th>Доп.парам</th>
        <th>Цена</th>
        <th>Кол-во</th>
        <th>Стоимость</th>
    </tr>
    </thead>
    <tbody>
    @foreach($order->items as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->option }}</td>
            <td>{{ number_format($item->price, 2, '.', '') }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ number_format($item->cost, 2, '.', '') }}</td>
        </tr>
    @endforeach
    <tr>
        <th colspan="4" class="text-right">Итого</th>
        <th colspan="2">{{ number_format($order->amount, 2, '.', '') }}</th>
    </tr>
    </tbody>
</table>

<h2>Данные клиента</h2>
<p>Имя, фамилия: {{ $order->name }}</p>
<p>Адрес почты: <a href="mailto:{{ $order->email }}">{{ $order->email }}</a></p>
<p>Номер телефона: {{ $order->phone }}</p>
<p>Адрес доставки: {{ $order->address }}</p>
@isset ($order->comment)
    <p>Комментарий: {{ $order->comment }}</p>
@endisset


</body>
</html>
