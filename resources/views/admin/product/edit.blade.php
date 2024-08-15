@extends('layout.admin', ['title' => 'Редактирование товара'])

@section('content')
    <h1>Редактирование товара</h1>
    <form method="post" enctype="multipart/form-data"
          action="{{ route('admin.product.update', ['product' => $product->id]) }}">
        @method('PUT')
        @include('admin.gallery.part.form')
    </form>
    <a href="{{ route('admin.product-option.index',["category_id"=>'','product_id'=>$product->id]) }}"
       class="btn btn-success mb-4">
        Перейти к редактированию доп опций
    </a>
@endsection
