@extends('layout.site')
@section('content')
<h1>Бренд: {{ $brand->name }}</h1>
<ul>
    @foreach ($products as $product)
        @include('catalog.part.product', ['product' => $product])
    @endforeach
</ul>
@endsection
