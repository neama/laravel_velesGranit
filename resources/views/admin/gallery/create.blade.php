@extends('layout.admin', ['title' => 'Создание товара'])

@section('content')
    <h1>Загрузка новой картинки</h1>
    <form method="post" action="{{ route('admin.galleries.store') }}" enctype="multipart/form-data">
        @include('admin.gallery.part.form')
    </form>
@endsection
