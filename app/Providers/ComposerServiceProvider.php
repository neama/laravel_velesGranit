<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Basket;
use App\Models\Gallery;

use App\Models\Page;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;

class ComposerServiceProvider extends ServiceProvider {
    /**
     * Register services.
     *
     * @return void
     */
    public function register() {
        // .....
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {


        View::composer('layout.part.breadCrumb', function($view)  {
            $breadCrumbs = $this->getAllBreadCrumbs();
            $view->with(['breadCrumbs'=>$breadCrumbs]);
        });
        View::composer('layout.part.roots', function($view)  {
            $breadCrumbs = $this->getAllBreadCrumbs();
           $view->with(['items' => Category::roots(),'breadCrumb'=>$breadCrumbs]);
        });
         View::composer('layout.part.brands', function($view) {
             $view->with(['items' => Brand::popular()]);
         });
        View::composer('layout.site', function($view) {
            $view->with(['positions' => Basket::getAmountWithOption()]);
        });
        View::composer('layout.part.pages', function($view) {
            $view->with(['pages' => Page::roots()]);
        });
        View::composer('layout.part.footerMenu', function($view) {
            $view->with(['pages' => Page::roots()]);
        });
        View::composer('layout.part.rootcat', function($view) {
            $view->with(['items' => Category::roots()]);
        });
        View::composer('layout.part.rootsCatalogMenu', function($view) {
            $view->with(['items' => Category::roots()]);
        });
        View::composer('layout.part.currentPage', function($view) {
            $view->with(['currentPage' => $this->getCurrentPage()]);
        });
        View::composer('layout.part.fourCategoryMain', function($view) {
            $view->with(['monuments' => Category::monuments()]);
        });
        View::composer('layout.part.catalogDescriptionMain', function($view) {
            $view->with(['monuments' => Category::roots()]);
        });
        /*View::composer('layout.part.galleryMain', function($view) {
            $view->with(['files' => Gallery::randImage()]);
        });*/
        View::composer('layout.part.galleryMain', function($view) {
            $view->with(['files' => Gallery::randImageFromDb()]);
        });
    }

    private function getCurrentPage(){
        $routeName = Route::currentRouteName();
        if($routeName == 'catalog.product'){

            $params = Route::current()?->parameters();
            $slug = $params['slug'];
            $product =  Product::where('slug', $slug)->where('host',Session::get('hostname'))->get();
            return $product[0]->category()->get()[0]->name;


        }
        $allList = $this->getAllBreadCrumbs();
        if(count($allList)==0)return __('home');
        return end($allList);
    }


    private function getAllBreadCrumbs(): array
    {
        Log::info('test');
        $breadCrumbs = [];
        $getAllPoints = true;
        $startPoint = '';
        $routeName = Route::currentRouteName();
        $params = Route::current()?->parameters();
        if(isset($params['locale'])){
            unset($params['locale']);
        }


        if($routeName == 'catalog.index'){
            $breadCrumbs[] = __('catalog');

        }
        if($routeName == 'basket.index'){
            $breadCrumbs[] = __('basket');

        }
        if($routeName == 'home'){
            $breadCrumbs[] = __('home');

        }
        if($routeName == 'index'){
            $breadCrumbs[] = __('home');

        }
        if($routeName == 'catalog.search'){
            $breadCrumbs[] = __('search');
        }
        if($routeName == 'gallery.preview'){
            $breadCrumbs[] = __('gallery');
        }

        if(empty($params)) {
            return $breadCrumbs;
        }
        Log::info('test2222'.print_r($breadCrumbs,true).'   '.(int)$getAllPoints.'  '.$routeName);
        while($getAllPoints){

            $slug = $params['slug'];


            if($routeName == 'gallery.show.id'){
                $startPoint = __('gallery');
                $getGallery   = Gallery::where('slug', $slug)->get();
                if(count($getGallery)==0){
                    return $breadCrumbs;
                }else{
                    $breadCrumbs[] = $getGallery[0]->name;
                    $getAllPoints = false;
                    $parentId = 0;
                }

            }
            if($routeName == 'page.show'){
                $startPoint = __('Page');

                $getPage   = Page::where('slug', $slug)->get();
                if(count($getPage)==0){
                    return $breadCrumbs;
                }else{
                    $breadCrumbs[] = $getPage[0]->name;
                    $getAllPoints = false;
                    $parentId = $getPage[0]->parent_id;
                }
            }

            if($routeName == 'catalog.product'){
                $startPoint = 'catalog';
                $getProduct   = Product::where('slug', $slug)->where('host',Session::get('hostname'))
                    ->get();
                if(count($getProduct)==0){

                }else{
                    $breadCrumbs[] = $getProduct[0]->name;
                    $routeName = '';
                    $parentId = $getProduct[0]->category_id;
                }
            }

            if($routeName == 'catalog.category'){
                $startPoint = 'catalog';
                $getCategory   = Category::where('slug', $slug)->where('host',Session::get('hostname'))->get();
                $routeName = '';
                if(count($getCategory)==0){
                    return $breadCrumbs;
                }else{
                    $breadCrumbs[] = $getCategory[0]->name;
                    $parentId = $getCategory[0]->parent_id;
                    if($parentId==0){
                        $getAllPoints = false;
                    }
                }
            }

            if($routeName == '' && $getAllPoints && $parentId!=0 ){
                $getCategory   = Category::where('id', $parentId)->get();
                if(count($getCategory)==0){
                    return $breadCrumbs;
                }else {
                    $breadCrumbs[] = $getCategory[0]->name;
                    $parentId = $getCategory[0]->parent_id;
                    if ($parentId == 0) {
                        $getAllPoints = false;
                    }
                }
            }
        }
        $breadCrumbs[] = __($startPoint);
        Log::info('test11111111111111'.print_r($breadCrumbs,true));
       return array_reverse($breadCrumbs);
    }
}
