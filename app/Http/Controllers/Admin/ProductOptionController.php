<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ProductOption;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::all();
        $category_id = $request->input('category_id');
        $product_id = $request->input('product_id');
        if ($product_id) {
            $productsOption  = ProductOption::where('product_id', $product_id)->get();
        } else {
            $productsOption = ProductOption::all();
        }

        return view('admin.product-option.index', compact('productsOption', 'categories', 'category_id','products','product_id'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $productKey = $request->input('product');

        $products = Product::all();
        return view('admin.product-option.create', compact('products','productKey'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);

        $productOption = ProductOption::create($data);

        return redirect()
            ->route('admin.product-option.index', ['productOption' => $productOption->id,'product_id'=>$data['product_id']])
            ->with('success', 'Новый товар успешно создан');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductOption $productOption) {
        return view('admin.product-option.show', compact('productOption'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Удаляет товар каталога из базы данных
     *
     * @param  \App\Models\ProductOption  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $productOption = ProductOption::find($id);
        $productOption->delete();
        return redirect()
            ->route('admin.product-option.index')
            ->with('success', 'дополнительный параметр уделен');
    }
}
