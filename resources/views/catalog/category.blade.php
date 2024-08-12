@extends('layout.site')

@section('title', $category->name)
@section('description',  $category->content)
@section('keywords', $category->keywords)

@section('content')
    <div class="row">
        @include('layout.part.modalFormForCall')
        <div class="col-md-3">
            @include('layout.part.roots')
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="ml-auto">
                    {{__('sort by price')}}
                    <a href="?filter=max" class="btn btn-link mx-2">{{__('Max')}}</a>
                    <a href="?filter=low" class="btn btn-link mx-2">{{__('Low')}}</a>
                </div>
            </div>
            <div class="row">
                @foreach ($products as $product)
                    @include('catalog.part.product', ['product' => $product])
                @endforeach
            </div>
            {{ $products->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
    @include('layout.part.description')
@endsection
