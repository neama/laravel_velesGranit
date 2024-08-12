<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use Illuminate\Http\Request;

class AdditionalController extends Controller
{
    public function __construct() {


        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function createSym()
    {
        $target = base_path('storage/app/public');
        $link = public_path('storage');

        echo "Creating symbolic link from $target to $link\n";

        if (file_exists($target)) {
            echo "Target exists.\n";
        } else {
            echo "Target does not exist.\n";
        }

        if (symlink($target, $link)) {
            echo "The symbolic link has been created successfully.";
        } else {
            echo "Failed to create the symbolic link.";
            $error = error_get_last();
            echo "Error message: " . $error['message'];
        }
    }


    public function index(Request $request){
        return view('admin.additional.index');
    }
    public function category(Request $request){
        return view('admin.additional.category');
    }
    public function updateCategory(Request $request)
    {
        $base = $request->query('host_name');
        $newValue = $request->query('redirect_value');

        $categories = Category::where('host', $base)->get();

        foreach ($categories as $category) {
            // Создание копии категории
            $newCategory = $category->replicate();

            // Изменение значения 'host'
            $newCategory->host = $newValue; // Установите новое значение для 'host'

            // Сохранение новой категории
            $newCategory->save();
        }

        $pages = Page::where('host', $base)->get();

        foreach ($pages as $page) {
            // Создание копии категории
            $newPage = $page->replicate();

            // Изменение значения 'host'
            $newPage->host = $newValue; // Установите новое значение для 'host'

            // Сохранение новой категории
            $newPage->save();
        }


        $products = Product::where('host', $base)->get();

        foreach ($products as $product) {
            $copyAdditionalOption = $product->getOptions();
            // Создание копии категории
            $newProduct = $product->replicate();

            // Изменение значения 'host'
            $newProduct->host = $newValue; // Установите новое значение для 'host'

            // Сохранение новой категории
            $newProduct->save();
            $newProductId = $newProduct->id;
            foreach ($copyAdditionalOption as $option){
                if(!empty($option->id)){
                    $newOption = $option->replicate();
                    $newOption->product_id =$newProductId;
                    $newOption->save();
                }

            }
        }
        return view('admin.additional.index');
    }
    public function categoryRemove()
    {
        return view('admin.additional.categoryRemove');
    }
    public function removeCategoryForHost(Request $request)
    {
        $base = $request->query('host_name');
        Category::where('host', $base)->delete();
        Page::where('host', $base)->delete();
        $products = Product::where('host', $base)->get();
        foreach ($products as $product){
            $additionalOption = $product->getOptions();
        foreach ($additionalOption as $option){
            if(!empty($option->id)){
                $option->delete();
            }
        }

        }
        return view('admin.additional.index');
    }
    public function populateKeyWordsCategoryProducts(Request $request)
    {
        $categoryList = Category::all();
        foreach ($categoryList as $category){
            if(in_array($category->lang,['ru','ro'])){
                $categoryKeyList = [];
                $categoryKeyList[] = $category->name;
                if($category->lang == 'ru'){
                    $categoryKeyList[] = "похороны";
                    $categoryKeyList[] = "ритуал";
                    $categoryKeyList[] = "товары";
                    $categoryKeyList[] = "купить";
                    $categoryKeyList[] = "молдова";
                    $categoryKeyList[] = "кишинев";
                }else{
                    $categoryKeyList[] = "înmormântare";
                    $categoryKeyList[] = "ritual";
                    $categoryKeyList[] = "bunuri";
                    $categoryKeyList[] = "cumpără";
                    $categoryKeyList[] = "moldova";
                    $categoryKeyList[] = "сhișinău";

                }
                $category->keywords = implode(',',$categoryKeyList);
                $category->save();
            }
        }
        $productList = Product::all();
        foreach ($productList as $product){
            if(in_array($product->lang,['ru','ro'])){
                $categoryKeyList = [];
                $categoryKeyList = explode(' ',$product->name);
                if($product->lang == 'ru'){
                    $categoryKeyList[] = "похороны";
                    $categoryKeyList[] = "ритуал";
                    $categoryKeyList[] = "товары";
                    $categoryKeyList[] = "купить";
                    $categoryKeyList[] = "молдова";
                    $categoryKeyList[] = "кишинев";
                }else{
                    $categoryKeyList[] = "înmormântare";
                    $categoryKeyList[] = "ritual";
                    $categoryKeyList[] = "bunuri";
                    $categoryKeyList[] = "cumpără";
                    $categoryKeyList[] = "moldova";
                    $categoryKeyList[] = "сhișinău";

                }
                $product->keywords = implode(',',$categoryKeyList);
                $product->save();
            }
        }
        return view('admin.additional.index');
    }

    public function showGallery(){
        $allFiles = glob('./images/*.jpg');
        echo '<pre>';
      // print_r($allFiles);
        foreach ($allFiles as $file) {
            echo $file. "<img src='".str_replace('./','/',$file)."' width='100px;'height='100px;'><br>";
        }
        die;

    }

}
