@extends('layout.site', ['title' => 'Заказ размещен'])

@section('content')
    <h1>{{__('Order placed')}}</h1>

    <p>{{__('order_placed_text')}}}}</p>

    <h2>{{__('Your order')}}</h2>
    <div class="container bg-light p-3">
        <div class="row font-weight-bold border-bottom py-2 d-none d-md-flex">
            <div class="col-1">№</div>
            <div class="col-3">{{__('Name')}}</div>
            <div class="col-2">{{__('Extra options')}}</div>
            <div class="col-2">{{__('Price')}}</div>
            <div class="col-2">{{__('Quantity')}}</div>
            <div class="col-2">{{__('Price total')}}</div>
        </div>
        @foreach($order->items as $item)
            <div class="row py-2 border-bottom">
                <div class="col-12 col-md-1 font-weight-bold">№</div>
                <div class="col-12 col-md-3">{{ $loop->iteration }}. {{ $item->name }}</div>
                <div class="col-12 col-md-2">{{ $item->option }}</div>
                <div class="col-12 col-md-2">{{ number_format($item->price, 2, '.', '') }}</div>
                <div class="col-12 col-md-2">{{ $item->quantity }}</div>
                <div class="col-12 col-md-2">{{ number_format($item->cost, 2, '.', '') }}</div>
            </div>
        @endforeach
        <div class="row font-weight-bold py-2">
            <div class="col-8 col-md-10 text-right">Итого</div>
            <div class="col-4 col-md-2">{{ number_format($order->amount, 2, '.', '') }}</div>
        </div>
    </div>

    <h2>{{__('Your data')}}</h2>
    <div class="container bg-light p-3">
        <div class="row">
            <div class="col-12 col-md-3 font-weight-bold">{{__('First name, Last name')}}</div>
            <div class="col-12 col-md-9">{{ $order->name }}</div>
        </div>
        <div class="row">
            <div class="col-12 col-md-3 font-weight-bold">{{__('E-mail')}}</div>
            <div class="col-12 col-md-9"><a href="mailto:{{ $order->email }}">{{ $order->email }}</a></div>
        </div>
        <div class="row">
            <div class="col-12 col-md-3 font-weight-bold">{{__('Phone number')}}</div>
            <div class="col-12 col-md-9">{{ $order->phone }}</div>
        </div>
        <div class="row">
            <div class="col-12 col-md-3 font-weight-bold">{{__('Delivery address')}}</div>
            <div class="col-12 col-md-9">{{ $order->address }}</div>
        </div>
        @isset ($order->comment)
            <div class="row">
                <div class="col-12 col-md-3 font-weight-bold">{{__('Comment')}}</div>
                <div class="col-12 col-md-9">{{ $order->comment }}</div>
            </div>
        @endisset
    </div>
    @include('layout.part.modalFormForCall')
    @include('layout.part.description')
@endsection
