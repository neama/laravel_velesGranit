<div class="row">
    <div class="col-md-12 flex-grow-1">
        <div class="row h-100 d-flex justify-content-center align-items-center">
            <div class="col-md-12">
                <div class="owl-carousel owl-theme" id="slider">
                    @foreach ($roots as $root)
                        @if (!empty($root->image))
                            @php($url = url('storage/catalog/category/source/' . $root->image))
                            <a href="{{ route('catalog.category', ['slug' => $root->slug, 'locale' => app()->getLocale()]) }}"
                               class="btn btn-link mx-auto d-block">
                                <div class="slide" style="background-image: url({{$url}});"></div>
                                <div class="slide-text">{{$root->name}}</div>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .slide {
        background-size: cover;
        background-position: center;
        width: 100%; /* Занимает всю ширину родителя */
        height: 60vh; /* Высота слайда относительно высоты окна просмотра */
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .slide-text {
        text-shadow: 1px 1px 0 #a0aec0, -1px -1px 0 #a0aec0, 1px -1px 0 #a0aec0, -1px 1px 0 #a0aec0;
        text-align: center;
        font-size: calc(2.5rem + 0.5vw);
        color: white; /* Цвет текста */
        font-weight: bold; /* Жирное начертание */
        position: absolute;
        bottom: 10px;
        width: 100%;
        z-index: 1;
    }

    .responsive-text {
        font-size: calc(1rem + 0.5vw); /* Размер шрифта зависит от ширины окна */
    }

    /* Адаптивное поведение для слайдера */
    @media (max-width: 768px) {
        .slide {
            height: 30vh; /* Уменьшите высоту слайда на мобильных устройствах */
        }

        .slide-text {
            font-size: 1rem; /* Меньший размер шрифта на мобильных устройствах */
        }
    }
</style>


    <script>
        $(document).ready(function(){
            $('#slider').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                items: 1, // Отображать один слайд за раз
                autoplay: true,
                autoplayTimeout: 4000,
                autoplayHoverPause: true,
                smartSpeed: 3000,
                responsive: {
                    0: {
                        items: 1 // 1 слайд на маленьких экранах
                    },
                    600: {
                        items: 1 // 1 слайд на средних экранах
                    },
                    1000: {
                        items: 1 // 1 слайд на больших экранах
                    }
                }
            });
        });
    </script>

