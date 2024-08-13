<div class="row">
    <div class="col-md-12 header-container">
        <div class="col-md-2 logo-container">
            <a class="navbar-brand" href="{{ route('home', ['locale' => app()->getLocale()]) }}">
                <img src="{{ asset('storage/images/logo_light.png') }}" alt="Logo" class="img-fluid">
            </a>
        </div>
        <div class="col-md-7 search-container">
            <form action="{{ route('catalog.search', ['locale' => app()->getLocale()]) }}" class="form-inline my-2 my-lg-0 d-flex w-100">
                <input class="form-control mr-sm-2 text-black border-light flex-grow-1" type="search" name="query" placeholder="{{__('search the catalog')}}" aria-label="Search" style="flex: 1;">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit" style="border: none; background: none;">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
        <div class="col-md-2 social-media-container d-flex justify-content-md-end justify-content-center">
            <div class="social-media">
                <a class="nav-link_header" href="https://www.facebook.com/profile.php?id=100068355936491&amp;ref=page_internal" target="_blank">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a class="nav-link_header" href="https://www.instagram.com/vgritual/" target="_blank">
                    <i class="fab fa-instagram"></i>
                </a>
                <a class="nav-link_header" href="https://ok.ru/serghei.nimerovskii" target="_blank">
                    <i class="fab fa-odnoklassniki"></i>
                </a>
                <a class="nav-link_header" href="https://vk.com/id739290919" target="_blank">
                    <i class="fab fa-vk"></i>
                </a>
                <a class="nav-link_header font_1rem" href="tel:+37378210021" target="_blank">
                    <div class="text-center">
                        <i class="fa fa-phone"></i>
                        <span> +37378210021</span>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-md-1 d-flex justify-content-end">
            <div class="basket-header-container">
                <ul class="nav">
                    <li class="nav-item" id="top-basket">
                        <a class="nav-link_header basket-link @if ($positions) text-success @endif" href="{{ route('basket.index', ['locale' => app()->getLocale()]) }}">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> {{ __('Корзина') }}
                            <span id="basketQuant">@if ($positions) ({{ $positions }}) @endif</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<style>
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
</style>
