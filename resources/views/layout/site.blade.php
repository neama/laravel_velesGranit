<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Monumente funerare Chisinau si Moldova cu livrare de la producator')</title>
    <meta name="description" content="@yield('description', 'Achiziționarea unui monument funerar din granit este ușoară de la producătorul vgritual.md, la noi puteți comanda toate tipurile de servicii funerare!')">
    <meta name="keywords" content="@yield('keywords', 'monumente, sicrie, coroane de flori, garduri, cruci, servicii funerare, înnobilare de morminte,')">
    <link rel="canonical" href="{{ url()->current() }}" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
          crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    @php
    //<script src="//code.jivo.ru/widget/idtlcDD46J" async></script>
    @endphp
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Germania+One&display=swap" rel="stylesheet">
    <style>
        a.nav-link:hover {
            color: lightcoral; /* Цвет при наведении */
        }
        .nav-tabs .nav-link {
            font-size: 1.25rem; /* Увеличение шрифта вкладок */
            color: black; /* Черный цвет текста вкладок */
        }
        .nav-tabs .nav-link.active {
            color: gray; /* Черный цвет текста активной вкладки */
        }
        .tab-content p {
            font-size: 1.25rem; /* Увеличение шрифта текста внутри вкладок */
            color: black; /* Черный цвет текста внутри вкладок */
        }
        .padding-content{
            padding-top: 2%;
            padding-bottom: 2%;
        }
        body{
            background-color: white;
        }
        footer{
            background-color: #c6c7ca;
        }
        .breadCrumbAndLang-container{
            /*   background-color: #000; /* Новый цвет фона */
            border-radius: 10px;
            border-bottom: 3px solid;
        }
        .footer-container{
            padding-top: 5px;
            border-radius: 10px;
            border-top: 1px solid;
            background-color: black;
        }
        .header-container {
            background-color: #000000; /* Новый цвет фона */
            border-radius: 10px;
            border-top: 1px solid;
        }
        .container-fluid {
            /* background-image: url('/img/back.webp'); */
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }

        .navbar-nav .nav-link {
            color: #000; /* Черный цвет текста */
            font-size: 1rem; /* Размер шрифта по умолчанию */
        }

        .navbar-light .navbar-nav .nav-link{
            color: #000; /* Черный цвет текста */
            font-size: 1.5rem; /* Размер шрифта по умолчанию */
        }
        /* Стили для ссылок при наведении */
        .navbar-nav .nav-link:hover {
            color: #333; /* Цвет при наведении */
        }

        /* Стили для ссылок при активном состоянии */
        .navbar-nav .nav-link.active {
            color: #555; /* Цвет для активного состояния */
        }

        /* Уменьшение размера шрифта для меньших экранов */
        @media (max-width: 1200px) {
            .navbar-nav .nav-link {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 992px) {
            .navbar-nav .nav-link {
                font-size: 1rem;
            }
        }

        @media (max-width: 768px) {
            .navbar-nav .nav-link {
                font-size: 0.7rem;
            }
        }

        @media (max-width: 576px) {
            .navbar-nav .nav-link {
                font-size: 0.6rem;
            }
        }
        .footer-container.container-fluid{
            background-color: black;
        }
        .header-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
        }

        .logo-container {
            display: flex;
            align-items: center;
        }

        .search-container {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .social-media-container {
            display: flex;
            justify-content: flex-end;
        }

        .social-media {
            display: flex;
            gap: 10px;
            align-items: center;
            font-size: x-small;
        }

        .basket-header-container {
            display: flex;
            justify-content: flex-end;
        }

        a.nav-link_header, a.basket-link {
            color: white;
            text-decoration: none;
        }

        a.nav-link_header:hover, a.basket-link:hover {
            color: lightcoral;
        }
        .font_1rem{
            font-size: 0.9rem;

        }
        @media (max-width: 1050px) {
            .social-media-container .social-media a.nav-link_header:not(.font_1rem) {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                align-items: center;
            }

            .logo-container {
                margin-bottom: 10px;
            }

            .search-container {
                width: 100%;
                margin-bottom: 10px;
            }

            .social-media-container {
                width: 100%;
                justify-content: center;
                margin-bottom: 10px;
            }

            .basket-header-container {
                width: 100%;
                justify-content: center;
            }
        }
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }

        .phoneIconCall {
            color: red; /* Устанавливаем цвет иконки */
            font-size: 1.5rem; /* Устанавливаем размер иконки */
            animation: bounce 2s infinite; /* Применяем анимацию bounce */
        }

        #openModalPhoneCall {
            position: fixed; /* Фиксированное позиционирование */
            bottom: 20px; /* Расположить кнопку на расстоянии 20px от нижнего края */
            right: 20px; /* Расположить кнопку на расстоянии 20px от правого края */
            border-radius: 10px; /* Закругленные углы кнопки */
            box-shadow: 0 4px 8px rgba(0,0,0,0.2); /* Тень для кнопки */
            padding: 10px 15px; /* Отступы внутри кнопки */
            display: flex; /* Используем flexbox для выравнивания содержимого */
            align-items: center; /* Вертикальное выравнивание содержимого */
            gap: 10px; /* Расстояние между иконкой и текстом */
            z-index: 1050; /* Убедитесь, что кнопка поверх всех элементов */
        }

        #openModalPhoneCall:hover {
            background-color: #0056b3; /* Цвет фона при наведении */
            color: #fff; /* Цвет текста при наведении */
        }

        .modal {
            z-index: 1045; /* Убедитесь, что модальное окно ниже кнопки, но поверх всех других элементов */
        }

        .modal-dialog {
            z-index: 1050; /* Убедитесь, что диалоговое окно модального окна поверх остальных элементов */
        }
    </style>
</head>
<body>
<div class="container-fluid">
    @include('layout.part.headerFull')

    <div class="row">
        <div class="col-md-12">
            @include('layout.part.header')
        </div>
    </div>
    <x-bread-crumb-and-lang />



    <div class="row">
        <div class="col-md-12 padding-content">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible mt-4" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Закрыть">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ $message }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible mt-0" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Закрыть">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield('content')
        </div>
    </div>
</div>

@include('layout.part.footer')

<?php /*@jivochat ?>
<script>
    $(document).ready(function () {
        $('.navbar-nav a').on('click', function () {
            if ($('.navbar-toggler').is(':visible')) {
                $('.navbar-collapse').collapse('hide');
            }
        });
    });
</script>*/?>
@stack('scripts')
</body>
<script src="{{ asset('js/site.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
</html>
