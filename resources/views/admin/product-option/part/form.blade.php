@csrf
<div class="form-group">
<select name="product_id" class="form-control" title="Продукт">
    <option value="0">Выберите</option>
    @if (count($products))
        @include('admin.product-option.part.branch', ['level' => -1, 'parent' => 0])
    @endif
</select>
    </div>
<div class="form-group">
    <input type="text" class="form-control" name="option_name" placeholder="тип"
           required maxlength="100" value="{{ old('option_name') ?? $product->option_name ?? 'size' }}">
</div>
<div class="form-group">
    <input type="text" class="form-control" name="option_value" placeholder="Обозначение"
           required maxlength="100" value="{{ old('option_value') ?? $product->option_value ?? '' }}">
</div>

<div class="form-group">
    <input type="text" class="form-control" name="prise" placeholder="цена"
           required maxlength="100" value="{{ old('price') ?? $product->price ?? '' }}">
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">Сохранить</button>
</div>
