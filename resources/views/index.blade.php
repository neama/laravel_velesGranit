@extends('layout.site')

@php
@endphp
@section('content')
    <div class="row">
        @include('layout.part.modalFormForCall')
        @include('layout.part.fourCategoryMain')
        @include('layout.part.catalogDescriptionMain')
        @include('layout.part.galleryMain')
        @include('layout.part.maps')
        @include('layout.part.description')
    </div>
@endsection

