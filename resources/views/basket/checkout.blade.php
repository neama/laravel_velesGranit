@extends('layout.site')

@section('content')
    <h1 class="mb-4">{{__('Checkout')}}</h1>
    <form method="post" action="{{ route('basket.saveorder',['locale' => app()->getLocale()]) }}">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="{{__('First name, Last name')}}"
                   required maxlength="255" value="{{ old('name') ?? '' }}">
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="{{__('E-mail')}}"
                   required maxlength="255" value="{{ old('email') ?? '' }}">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="phone" placeholder="{{__('Phone number')}}"
                   required maxlength="255" value="{{ old('phone') ?? '' }}">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="address" placeholder="{{__('Delivery address')}}"
                   required maxlength="255" value="{{ old('address') ?? '' }}">
        </div>
        <div class="form-group">
            <textarea class="form-control" name="comment" placeholder="{{__('Comment')}}"
                      maxlength="255" rows="2">{{ old('comment') ?? '' }}</textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">{{__('Design')}}</button>
        </div>
    </form>
@endsection
