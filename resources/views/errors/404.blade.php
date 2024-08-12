@extends('layout.site', ['title' => 'Страница не найдена'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mt-4 mb-4">
                <div class="card-header">
                    <h1>{{ __('Page not found.') }}</h1>
                </div>
                <div class="card-body">
                    <img src="{{ asset('img/404.jpg') }}" alt="" class="img-fluid">
                </div>
                <div class="card-footer">
                    <p>{{__("This page does not exist")}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
