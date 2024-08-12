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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
          crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    @php
    //<script src="//code.jivo.ru/widget/idtlcDD46J" async></script>
    @endphp
    <script src="{{ asset('js/site.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Germania+One&display=swap" rel="stylesheet">
    <style>
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
</html>
