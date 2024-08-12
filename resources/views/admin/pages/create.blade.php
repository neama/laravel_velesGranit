@extends('layout.admin', ['title' => 'Создание новой страницы'])

@section('content')
    <h1>Создание новой страницы</h1>
    <form method="post" action="{{ route('admin.pages.store') }}">
        @include('admin.pages.part.form')
    </form>
@endsection
