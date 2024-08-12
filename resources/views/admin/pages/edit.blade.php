@extends('layout.admin', ['title' => 'Редактирование страницы'])

@section('content')
    <h1>Редактирование страницы</h1>
    <form method="post" action="{{ route('admin.pages.update', ['page' => $page->id]) }}">
        @method('PUT')
        @include('admin.pages.part.form')
    </form>
@endsection
