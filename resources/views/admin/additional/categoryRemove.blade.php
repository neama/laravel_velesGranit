@extends('layout.admin', ['title' => 'Все бренды каталога'])

@section('content')
    <h1>Создать копиию категорий</h1>
    <form action="{{ route('admin.additional.removeCategoryForHost') }}" method="GET">
        @csrf
        <label for="host_name">Host Name:</label>
        <input type="text" id="host_name" name="host_name" required>


        <button type="submit">Submit</button>
    </form>
@endsection
