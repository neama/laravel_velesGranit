@csrf
<div class="form-group">
    <input type="text" class="form-control" name="host" placeholder="Хост"
           required maxlength="100" value="{{ old('host') ?? $product->host ?? '' }}">
</div>
<div class="form-group">
    <input type="text" class="form-control" name="lang" placeholder="Язык"
           required maxlength="100" value="{{ old('lang') ?? $product->lang ?? '' }}">
</div>
<div class="form-group">
    <input type="text" class="form-control" name="name" placeholder="Наименование"
           required maxlength="100" value="{{ old('name') ?? $product->name ?? '' }}">
</div>
<div class="form-group">
    <input type="text" class="form-control" name="slug" placeholder="ЧПУ (на англ.)"
           required maxlength="100" value="{{ old('slug') ?? $product->slug ?? '' }}">
</div>
<div class="form-group">
<input type="text" class="form-control w-25 d-inline mr-4" placeholder="Цена"
       name="price" required value="{{ old('price') ?? $product->price ?? '' }}">
</div>
<div class="form-group">
    <input type="text" class="form-control" name="keywords" placeholder="keywords для SEO"
            maxlength="100" value="{{ old('keywords') ?? $category->keywords ?? '' }}">
</div>
<div class="form-group">
    @php
        $category_id = old('category_id') ?? $product->category_id ?? 0;
    @endphp
    <select name="category_id" class="form-control" title="Категория">
        <option value="0">Выберите</option>
        @if (count($items))
            @include('admin.product.part.branch', ['level' => -1, 'parent' => 0])
        @endif
    </select>
</div>
<div class="form-group">
    <textarea class="form-control" name="content" placeholder="Описание"
              rows="4">{{ old('content') ?? $product->content ?? '' }}</textarea>
</div>
<div class="form-group">
    <input type="file" class="form-control-file" name="image" accept="image/png, image/jpeg">
</div>
@isset($product->image)
    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" name="remove" id="remove">
        <label class="form-check-label" for="remove">
            Удалить загруженное изображение
        </label>
    </div>
@endisset
<div class="form-group">
    <button type="submit" class="btn btn-primary">Сохранить</button>
</div>
