<div class="container">
    <div class="row justify-content-center">
        <div class="custom-font_main_cat">
            {{__('gallery')}}
        </div>
    </div>

    <div class="col-md-12">
        <div class="row d-flex justify-content-center">

            @foreach ($files as $file)
                <div class="col-md-3 mb-3">
                    <div class="card">
                        @php($url = url('storage/gallery/' . $file->base_image))
                        <a href="{{ route('gallery.preview', ['locale' => app()->getLocale()]) }}" class="btn btn-info" title="{{__('gallery')}}">
                            <img src="{{ $url }}" class="card-img-top" alt="{{ $file->description }}">
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Мобильная версия: все элементы в одной строке -->
</div>

