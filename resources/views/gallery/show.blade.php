@extends('layout.site')
@section('description', 'Gallery'. $record['current']->name)

@php
$url = url('storage/gallery/' . $record['current']->additional_image);
@endphp
@section('content')
    <style>
        .row.justify-content-center {
            justify-content: center;
        }

        @media (min-width: 576px) {
            .row.justify-content-center {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
            }
        }
    </style>
    <div class="row">
        @include('layout.part.modalFormForCall')
        <div class="col-md-12">
            <div class="row d-flex justify-content-center align-items-center">
                <!-- Левая кнопка со стрелкой < -->
                <div class="col-md-1 d-flex justify-content-center">
                    @if($record['previous']?->slug)
                    <a href="{{ route('gallery.show.id', ['slug' =>  $record['previous']->slug,'locale' => app()->getLocale()]) }}" class="btn btn-info"  title="{{__('open')}}">
                        <i class="fas fa-chevron-left"></i></a>
                    @else
                        <a href="{{ route('gallery.preview', ['locale' => app()->getLocale()]) }}" class="btn btn-info"  title="{{__('open')}}">
                            <i class="fas fa-chevron-left"></i></a>
                    @endif
                </div>

                <!-- Колонка с изображением -->
                <div class="col-md-5 mb-3">
                    <div class="card h-100">
                        <img src="{{$url}}" class="card-img-top" alt="{{ $record['current']->description }}">
                    </div>
                </div>

                <!-- Колонка с описанием -->
                <div class="col-md-2 mb-3">
                    <div class="card h-100 d-flex flex-column">
                        <div class="card-body d-flex align-items-center">
                            <p class="card-text">{{ $record['current']->description }}</p>
                        </div>
                    </div>
                </div>

                <!-- Правая кнопка со стрелкой > -->
                <div class="col-md-1 d-flex justify-content-center">
                    @if($record['next']?->slug)
                        <a href="{{ route('gallery.show.id', ['slug' =>  $record['next']->slug,'locale' => app()->getLocale()]) }}" class="btn btn-info"  title="{{__('open')}}">
                            <i class="fas fa-chevron-right"></i></a>
                    @else
                        <a href="{{ route('gallery.preview', ['locale' => app()->getLocale()]) }}" class="btn btn-info"  title="{{__('open')}}">
                            <i class="fas fa-chevron-right"></i></a>
                    @endif
                </div>
            </div>
        </div>

        </div>

    @include('layout.part.description')
@endsection

