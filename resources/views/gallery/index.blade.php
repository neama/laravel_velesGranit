@extends('layout.site')
@section('description', 'Gallery')

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
            <div class="row d-flex justify-content-center">
                @foreach ($files as $file)

                    @php($url = url('storage/gallery/' . $file->base_image))
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <a href="{{ route('gallery.show.id', ['slug' => $file->slug,'locale' => app()->getLocale()]) }}" class="btn btn-info"  title="{{__('open')}}">
                                <img src="{{$url}}" class="card-img-top" alt="{{ $file->description }}">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $files->links('vendor.pagination.bootstrap-4') }}
        </div>
    @include('layout.part.description')
@endsection
