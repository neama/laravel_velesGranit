<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid menu-container">
        <!-- Кнопка «Гамбургер» -->
        <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbar-larashop" aria-controls="navbar-larashop"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon" style="filter: grayscale(1) invert(1); border: 1px solid; border-radius: 10px;"></span>
        </button>

        <!-- Основная часть меню (может содержать ссылки, формы и прочее) -->
        <div class="collapse navbar-collapse" id="navbar-larashop">
            <!-- Этот блок расположен слева -->
            <ul class="navbar-nav mr-auto">
                @include('layout.part.rootsCatalogMenu')
                @include('layout.part.pages')
            </ul>
        </div>
        <!-- Корзина расположена справа -->

    </div>
</nav>

<style>

    .navbar.navbar-expand-lg.navbar-dark{
        border-radius: 10px;
    }

    #navbar-larashop{
        border-radius: 10px;
    }
    button:focus{
        outline: 0px;
    }
    .container-fluid.menu-container {
        background-color: white;
        padding: 5px 5px 5px;
        border-radius: 10px;
        width: auto;
    }

    #navbar-larashop {
        background-color: white;
    }

    .navbar-dark .navbar-nav .nav-link {
        color: black; /* Белый цвет текста */
        font-size: calc(0.5rem + 0.5vw);
    }

    .navbar-nav.ml-auto {
        background-color: black;
    }

    .navbar-dark .navbar-nav .nav-link:hover {
        color: gray; /* Серый цвет текста при наведении */
    }

    .navbar-dark .form-inline .form-control {
        background-color: black; /* Черный фон поля ввода */
        color: white; /* Белый цвет текста ввода */
        border-color: lightgray; /* Светло-серая рамка поля ввода */
    }

    .navbar-dark .form-inline .btn-outline-light {
        color: white; /* Белый цвет текста кнопки */
        border-color: white; /* Белая рамка кнопки */
    }

    .navbar-dark .form-inline .btn-outline-light:hover {
        color: gray; /* Серый цвет текста кнопки при наведении */
    }

    /* Увеличенный шрифт для корзины */
    .navbar-dark .navbar-nav .basket-link {
        font-size: 1.25rem; /* Увеличенный размер шрифта */
    }

    @media (max-width: 991.98px) {
        .navbar-dark .navbar-nav .basket-link {
            font-size: 1.5rem; /* Еще больший размер шрифта для мобильных устройств */
        }
    }

    @media (min-width: 992px) {
        .navbar-expand-lg .navbar-nav .nav-link-menu {
            padding-right: 0.5rem;
            padding-left: 0.5rem;
        }
    }

</style>
