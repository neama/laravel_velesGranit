@php

    $lastElement = array_pop($breadCrumbs);
    $breadCrumbsString = implode('/', $breadCrumbs);
@endphp

<span style="color: black;">
    {{ $breadCrumbsString }}
    @if($breadCrumbsString) / @endif
    <h1 style="display: inline; font-size:1rem;">{{ $lastElement }}</h1>
</span>
