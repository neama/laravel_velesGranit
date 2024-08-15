<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdditionalController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductOptionController;
use App\Http\Controllers\Admin\GalleriesController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\PagesController;
use App\Http\Middleware\SetLocale;

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::middleware([SetLocale::class])->group(function () {
    Route::get('lang', [LanguageController::class, 'switchLang'])->name('switchLang');

    /*
 * Страницы «Доставка», «Контакты» и прочие
 */
    Route::get('/page/{slug:slug}', [PagesController::class,'index'])->name('page.show');

    Route::get('/sitemap.xml', [SitemapController::class,'index']);

    Route::group(['middleware' => 'setLocale'], function() {
        Route::get('{locale}/catalog/category/{slug}', [CatalogController::class, 'category'])->name('catalog.category');
        Route::get('{locale}/catalog/index', [CatalogController::class, 'index'])->name('catalog.index');
        Route::get('{locale}/', [IndexController::class, 'index'])->name('home');
        Route::get('{locale}/page/{slug:slug}', [PagesController::class,'index'])->name('page.show');

    });

   // Route::get('{locale}/catalog/category/{slug}', [CatalogController::class, 'category'])->name('catalog.category');
    Route::get('{locale}/catalog/brand/{slug}', [CatalogController::class, 'brand'])->name('catalog.brand');
    Route::get('{locale}/search', [CatalogController::class, 'search'])
        ->name('catalog.search');
    Route::get('{locale}/catalog/product/{slug}', [CatalogController::class, 'product'])->name('catalog.product');
    Route::get('{locale}/basket/index', [BasketController::class, 'index'])->name('basket.index');
    Route::get('{locale}/basket/checkout', [BasketController::class, 'checkout'])->name('basket.checkout');

    Route::get('{locale}/gallery/preview', [GalleryController::class, 'getPreviewGallery'])->name('gallery.preview');
    Route::get('{locale}/gallery/show/{slug}', [GalleryController::class, 'getPreviewGalleryId'])->name('gallery.show.id');


    Route::post('{locale}/basket/add/{id}', [BasketController::class, 'add'])
        ->where('id', '[0-9]+')
        ->name('basket.add');

    Route::post('{locale}/basket/plus/{id}',  [BasketController::class, 'plus'])
        ->where('id', '[0-9]+')
        ->name('basket.plus');
    Route::post('{locale}/basket/minus/{id}',  [BasketController::class, 'minus'])
        ->where('id', '[0-9]+')
        ->name('basket.minus');
    Route::post('{locale}/basket/saveorder', [BasketController::class, 'saveOrder'])->name('basket.saveorder');
    Route::get('{locale}basket/success', [BasketController::class, 'success'])
        ->name('basket.success');
    Route::get('{locale}/basket/get/{ticketBase64}', [BasketController::class, 'showOrderFromTelegramUrl'])
        ->name('basket.orderTelegram');
    Route::post('{locale}/basket/updateOrder/', [BasketController::class, 'updateOrderStatus'])
        ->name('basket.updateOrder');
    Route::post('{locale}/basket/callRequest/', [BasketController::class, 'callRequest'])
        ->name('basket.callRequest');
    Route::get('{locale}/basket/callRequestFromOtherHost/{params}', [BasketController::class, 'callRequestFromOtherHost'])
        ->name('basket.callRequestFromOtherHost');
    Route::get('{locale}/basket/callOrderFromOtherHost/{params}', [BasketController::class, 'callOrderFromOtherHost'])
        ->name('basket.callOrderFromOtherHost');
});


Auth::routes();

Route::name('user.')->prefix('user')->group(function () {
    Auth::routes();
});


/*Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', AdminController::class)->name('admin.index');
    // Добавьте другие маршруты для администратора здесь
});*/
/*Route::name('admin.')->prefix('admin')->group(function () {
    Route::get('index', AdminController::class)->name('admin.index');
});*/
Route::group([
    'as' => 'admin.', // имя маршрута, например admin.index
    'prefix' => 'admin', // префикс маршрута, например admin/index
   // 'namespace' => 'Admin', // пространство имен контроллера
    'middleware' => ['auth', 'admin'] // один или несколько посредников
], function () {
    // главная страница панели управления
    Route::get('index', [AdminController::class,'index'])->name('index');
    Route::get('additional', [AdditionalController::class,'index'])->name('additional.index');
    Route::get('additional/category', [AdditionalController::class,'category'])->name('additional.category');
    Route::get('additional/categoryRemove', [AdditionalController::class, 'categoryRemove'])->name('additional.categoryRemove');
    Route::get('additional/createSym', [AdditionalController::class, 'createSym'])->name('additional.createSym');
    Route::get('additional/updateCategory', [AdditionalController::class, 'updateCategory'])->name('additional.updateCategory');
    Route::get('additional/removeCategoryForHost', [AdditionalController::class, 'removeCategoryForHost'])->name('additional.removeCategoryForHost');
    Route::get('additional/populateKeyWordsCategoryProducts', [AdditionalController::class, 'populateKeyWordsCategoryProducts'])->name('additional.populateKeyWordsCategoryProducts');
    Route::get('additional/showGallery', [AdditionalController::class, 'showGallery'])->name('additional.showGallery');
    Route::get('additional/populateGallery', [AdditionalController::class, 'populateGallery'])->name('additional.populateGallery');
    Route::get('galleries/index', [GalleriesController::class,'index'])->name('galleries.index');
    Route::get('galleries/show/{slug}', [GalleriesController::class,'show'])->name('galleries.show');
    Route::get('galleries/edit/{slug}', [GalleriesController::class,'edit'])->name('galleries.edit');
    Route::get('galleries/destroy/{slug}', [GalleriesController::class,'show'])->name('galleries.destroy');
    Route::get('galleries/create/', [GalleriesController::class,'create'])->name('galleries.create');
    Route::post('galleries/store', [GalleriesController::class, 'store'])
        ->name('galleries.store');
    Route::put('galleries/update/{slug}', [GalleriesController::class, 'update'])
        ->name('galleries.update');
    Route::delete('galleries/destroy/{slug}', [GalleriesController::class, 'destroy'])
        ->name('galleries.destroy');

    // CRUD-операции над категориями каталога
    Route::resource('category', CategoryController::class);
    Route::resource('brand', BrandController::class);
    Route::resource('product', ProductController::class);

    Route::resource('product-option', ProductOptionController::class);
    Route::get('product/category/{category}', [ProductController::class,'category'])
        ->name('product.category');
    // просмотр и редактирование заказов
    Route::resource('order', OrderController::class, ['except' => [
        'create', 'store', 'destroy'
    ]]);
    Route::resource('pages', PageController::class);

});

Route::get('user/index', [AdminController::class,'index'])->name('user.index');

