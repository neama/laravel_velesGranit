<div class="container">
    <div class="row justify-content-center">
        <div class="custom-font_main_cat">
            {{__('Monuments')}}
        </div>
    </div>
    <!-- Первая строка: первые 4 элемента для больших экранов -->
    <div class="row1 d-none d-md-flex">
        @foreach($monuments->take(4) as $monument)
            <div class="col-md-3_l col-sm-6 mb-4">
                <div class="catalog-block">
                    <div class="block-title">
                        <strong>{{$monument->name}}</strong>
                    </div>
                    <div class="block_thumb">
                        @php($url = url('storage/catalog/category/source/' . $monument->image))
                        <img src="{{$url}}" alt="{{$monument->name}}">
                    </div>
                    <div class="block__bottom">
                        <a href="{{ route('catalog.category', ['slug' => $monument->slug,'locale' => app()->getLocale()]) }}" class="btn btn-primary mx-auto d-block">
                            {{ $monument->name }}
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Вторая строка: оставшиеся элементы для больших экранов -->
    <div class="row1 d-none d-md-flex centered-row">
        @foreach($monuments->slice(4) as $monument)
            <div class="col-md-3_l col-sm-6 mb-4">
                <div class="catalog-block">
                    <div class="block-title">
                        <strong>{{$monument->name}}</strong>
                    </div>
                    <div class="block_thumb">
                        @php($url = url('storage/catalog/category/source/' . $monument->image))
                            <img src="{{$url}}" alt="{{$monument->name}}">
                    </div>
                    <div class="block__bottom">
                        <a href="{{ route('catalog.category', ['slug' => $monument->slug,'locale' => app()->getLocale()]) }}" class="btn btn-primary mx-auto d-block">
                            {{ $monument->name }}
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Мобильная версия: все элементы в одной строке -->
    <div class="row1 d-md-none">
        @foreach($monuments as $monument)
            <div class="col-12 mb-2">
                <a href="{{ route('catalog.category', ['slug' => $monument->slug,'locale' => app()->getLocale()]) }}" class="btn btn-dark mx-auto d-block">
                            {{ $monument->name }}
                        </a>


            </div>
        @endforeach
    </div>
</div>
<style>

    .custom-font_main_cat {
        font-family: 'Arial', sans-serif; /* Замените 'Arial' на нужный вам шрифт */
        font-size: 2rem; /* Установите нужный размер шрифта */
        font-style: italic; /* Добавляет курсивное начертание */
        border-radius: 10px;
        border-top: 1px solid;
    }
    .catalog-block {
        background-color: #fff; /* Белый фон */
        border: 1px solid #ddd;
        padding: 15px;
        border-radius: 5px;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .block-title {
        font-size: 1rem;
        margin-bottom: 5px;
    }

    .block_thumb img {
        max-width: 100%;
        height: auto;
    }

    .block__bottom {
        margin-top: 10px;
    }

    .btn-link {
        text-decoration: none;
        color: #007bff;
    }

    .row1 {
        display: flex;
        flex-wrap: wrap;
    }

    .col-md-3_l {
        flex: 1 0 24%; /* Устанавливаем ширину колонок в 24%, чтобы поместить 4 элемента в строку на больших экранах */
        max-width: 24%;
    }

    .row1.centered-row {
        justify-content: center;
    }

    @media (max-width: 768px) {
        .row1.d-md-flex {
            display: none; /* Скрыть для мобильных устройств */
        }
    }

</style>
