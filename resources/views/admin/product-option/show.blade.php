@extends('layout.admin', ['title' => 'Просмотр товара'])

@section('content')
    <h1>Просмотр опции товара</h1>
    <div class="row">
        <div class="col-md-6">
            <p><strong>Название:</strong> {{ $product->option_name }}</p>


        </div>

    </div>
    <div class="row">
        <div class="col-12">



        </div>
    </div>
@endsection
