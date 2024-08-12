@extends('layout.site')
@section('description', 'List of site categories')

@section('content')
    <div class="row">
        @include('layout.part.modalFormForCall')
        <div class="col-md-3">
            @include('layout.part.roots')
        </div>
        <div class="col-md-9">
            <div class="row">
                @foreach ($products as $product)
                    @include('catalog.part.product', ['product' => $product])
                @endforeach
            </div>
            {{ $products->links('vendor.pagination.simple-bootstrap-4') }}
        </div>
    </div>
    @include('layout.part.description')
@endsection
