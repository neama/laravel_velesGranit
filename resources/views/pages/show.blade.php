@extends('layout.site')
@section('content')
    <div class="card">
        <div class="card-body">
            {!! $pages->content  !!}
        </div>
    </div>
    @include('layout.part.modalFormForCall')
    @include('layout.part.description')
@endsection
