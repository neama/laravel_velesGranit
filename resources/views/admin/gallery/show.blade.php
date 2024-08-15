@extends('layout.admin', ['title' => 'Просмотр картинки'])

@section('content')

    <h1>Просмотр картинки в галерее</h1>
    <div class="row">
        <div class="col-md-6">
            <p><strong>Название:</strong> {{ $image[0]->name }}</p>
            <p><strong>ЧПУ (англ):</strong> {{ $image[0]->slug }}</p>

        </div>
        <div class="col-md-6">
            @php
                if ($image[0]->base_image) {
                    $url = url('storage/gallery/' . $image[0]->base_image);
                } else {
                    $url = url('storage/catalog/product/image/default.jpg');
                }
            @endphp
            <img src="{{ $url }}" alt="" class="img-fluid">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p><strong>Описание</strong></p>
            @isset($image[0]->description)
                <p>{{ $image[0]->description }}</p>
            @else
                <p>Описание отсутствует</p>
            @endisset
            <a href="{{ route('admin.galleries.edit', ['slug' => $image[0]->slug]) }}"
               class="btn btn-success">
                Редактировать товар
            </a>
            <form method="post" class="d-inline" onsubmit="return confirm('Удалить этот товар?')"
                  action="{{ route('admin.product.destroy', ['product' => $image[0]->id]) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    Удалить товар
                </button>
            </form>
        </div>
    </div>
        </div>
    </div>
@endsection
