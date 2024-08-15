@extends('layout.admin', ['title' => 'Редактирование картинки'])

@section('content')
    <h1>Редактирование картинки</h1>
    <form method="post" enctype="multipart/form-data"
          action="{{ route('admin.galleries.update', ['slug' => $image[0]->slug]) }}">
        @method('PUT')
        @include('admin.gallery.part.form')
    </form>
@endsection
