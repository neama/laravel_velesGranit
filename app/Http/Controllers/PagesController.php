<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class PagesController extends Controller
{

     public function __invoke($lang,$slug) {

         $pages = Page::where('slug', $slug) ->where('host',Session::get('hostname'))
             ->where('lang',App::getLocale())->firstOrFail();
        return view('pages.show', compact('pages'));
    }
    public function index($lang,$slug) {
        $pages = Page::where('slug', $slug) ->where('host',Session::get('hostname'))
            ->where('lang', App::getLocale() )->firstOrFail();
        return view('pages.show', compact('pages'));
    }
}
