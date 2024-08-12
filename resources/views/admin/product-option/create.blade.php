@extends('layout.admin', ['title' => 'Создание товара'])

@section('content')
    <h1>Создание нового дополнительного параметра</h1>
    <form method="post" action="{{ route('admin.product-option.store') }}" enctype="multipart/form-data">
        @include('admin.product-option.part.form')
    </form>
@endsection
