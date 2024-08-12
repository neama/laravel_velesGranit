@extends('layout.admin', ['title' => 'Все бренды каталога'])

@section('content')
    <a href="{{ route('admin.additional.showGallery') }}">Показать Галлерею</a>
    <br>
    <a href="{{ route('admin.additional.createSym') }}">Создать симлинк</a>
    <br>
    <a href="{{ route('admin.additional.categoryRemove') }}">удалить категории для хоста</a>
    <br>
    <a href="{{ route('admin.additional.category') }}">копия категорий</a>
    <br>
    <a href="{{ route('admin.additional.populateKeyWordsCategoryProducts') }}">заполнение ключевых слов SEO</a>
@endsection
