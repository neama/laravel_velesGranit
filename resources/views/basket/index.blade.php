@extends('layout.site')

@section('content')
    @include('layout.part.modalFormForCall')
    <h1>{{__('Корзина')}}</h1>
    @if (count($products))
        @php
            $basketCost = 0;
        @endphp
        <div class="list-group mb-4">
            @foreach($products as $product)
                @php
                    $option = $product->getProductOption($product->pivot->option);
                    $itemPrice = $option->pluck('prise')->first() ?? $product->price;
                    $itemOption = $option->pluck('option_value')->first() ?? '';
                    $itemQuantity = $product->pivot->quantity;
                    $itemCost = $itemPrice * $itemQuantity;
                    $basketCost += $itemCost;
                @endphp
                <div class="list-group-item">
                    <div class="row">
                        <div class="col-md-1">
                            {{ $loop->iteration }}
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('catalog.product', [$product->slug,'locale' => app()->getLocale()]) }}">{{ $product->name }}</a>
                        </div>
                        <div class="col-md-2">
                            {{ $itemOption }}
                        </div>
                        <div class="col-md-2">
                            {{ number_format($itemPrice, 2, '.', '') }}
                        </div>
                        <div class="col-md-2">
                            <form action="{{ route('basket.minus', ['id' => $product->id,'locale' => app()->getLocale()]) }}" method="post" class="d-inline">
                                @csrf
                                <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                                    <i class="fas fa-minus-square"></i>
                                </button>
                            </form>
                            <span class="mx-1">{{ $itemQuantity }}</span>
                            <form action="{{ route('basket.plus', ['id' => $product->id,'locale' => app()->getLocale()]) }}" method="post" class="d-inline">
                                @csrf
                                <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                                    <i class="fas fa-plus-square"></i>
                                </button>
                            </form>
                        </div>
                        <div class="col-md-2">
                            {{ number_format($itemCost, 2, '.', '') }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-end">
            <h4 class="mr-3">{{__('Total price')}} {{ number_format($basketCost, 2, '.', '') }}</h4>
            <a href="{{ route('basket.checkout',['locale' => app()->getLocale()]) }}" class="btn btn-success">
                {{__('Checkout')}}
            </a>
        </div>
    @else
        <p>{{__('Your basket is empty')}}</p>
    @endif

    @include('layout.part.description')
@endsection
