@php $level++ @endphp
@foreach ($products as $product)
    <option value="{{ $product->id }}" @if ($product->id == $productKey) selected @endif>
        @if ($level) {!! str_repeat('&nbsp;&nbsp;&nbsp;', $level) !!}  @endif {{ $product->name }}
    </option>

@endforeach
