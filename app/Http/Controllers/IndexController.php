<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */

    public function index(Request $request)
    {

        $roots = Category::where('parent_id', 0)
            ->where('host',Session::get('hostname'))
            ->where('lang',App::getLocale())->get();
        return view('index', compact('roots'));
    }
}
