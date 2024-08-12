<div class="row mb-2 d-flex align-items-center">
    <div class="col-6">
        @include('layout.part.breadCrumb')
    </div>

    <div class="col-1 d-flex justify-content-end ml-auto">
        @foreach (config('app.locales') as $lang)
            <a href="{{ route('switchLang', ['lang' => $lang]) }}" class="btn btn-link {{ app()->getLocale() == $lang ? 'font-weight-bold' : '' }}" style="color: {{ app()->getLocale() == $lang ? 'black' : 'grey' }};">
                {{ strtoupper($lang) }}
            </a>
        @endforeach
    </div>
</div>
