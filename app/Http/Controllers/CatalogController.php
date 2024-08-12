<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class CatalogController extends Controller
{
    public function index() {
        $products =  Product::where('host',Session::get('hostname'))
            ->where('lang',App::getLocale()) ->paginate(10);
      $roots = Category::where('parent_id', 0)
          ->where('host',Session::get('hostname'))
          ->where('lang',App::getLocale())->get();
        return view('catalog.index', compact('roots','products'));
    }

    public function category(Request $request, $lang, $slug) {

        $filter = $request->query('filter');

        $category = Category::where('slug', $slug)->firstOrFail();
        $product = new Product;

        $query = null;

        if (count($category->children) > 0) {
            $query = $category->getProductsForCategoryes($category->id);
        } else {
            $query = $category->getProducts($category->id);
        }

        // Применение фильтра для сортировки
        if ($filter == 'max') {
            $query = $query->orderBy('price', 'desc');
        } elseif ($filter == 'low') {
            $query = $query->orderBy('price', 'asc');
        }

        $products = $query->paginate(10)->withQueryString();

        return view('catalog.category', compact('category', 'products'));
    }

    public function brand($lang, $slug) {
        $brand = Brand::where('slug', $slug)->firstOrFail();
        $products = $brand->getProducts(Session::get('hostname'));
        return view('catalog.brand', compact('brand', 'products'));
    }

    public function product($lang, $slug) {
        $product = Product::where('slug', $slug)->firstOrFail();
        $category = $product->getCategory();
        $options = $product->getOptions();
        return view('catalog.product', compact('product', 'category', 'options'));
    }

    public function search(Request $request) {
        $search = $request->input('query');
        $query = Product::search($search);
        $products = $query->paginate(6)->withQueryString();
        return view('catalog.search', compact('products', 'search'));
    }
}
