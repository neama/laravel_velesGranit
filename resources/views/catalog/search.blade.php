@extends('layout.site')

@section('title', 'Search Page')
@section('description', 'List of found products')

@section('content')
    @include('layout.part.modalFormForCall')
    <h1>{{__('Search Page')}}</h1>
    <p>{{__('Search query:')}} {{ $search ?? 'пусто' }}</p>
    @if (count($products))
        <div class="row">
            @foreach ($products as $product)
                @include('catalog.part.product', ['product' => $product])
            @endforeach
        </div>
        {{ $products->links('vendor.pagination.simple-bootstrap-4') }}
    @else
        <p>{{__('No results found for your request')}}</p>
    @endif
    @include('layout.part.description')
@endsection
