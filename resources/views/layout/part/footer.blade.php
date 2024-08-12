<style>
    .footer-container.container-fluid{
        background-color: black;
    }
</style>
<footer class="footer-container">
    <div class="container">
        <div class="row justify-content-center">
            @include('layout.part.socialMedia')
            @include('layout.part.rootcat')
            @include('layout.part.footerMenu')
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-3 text-center text-info">
                <p>{{ date('Y') }} {{ request()->getHost()  }} {{ __('Все права защищены.') }} created by NeMoy!</p>
            </div>
        </div>

</footer>
