<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log; // Добавляем фасад Log

class LanguageController extends Controller
{
    public function switchLang(Request $request)
    {

        $lang = $request->input('lang');

        if (in_array($lang, config('app.locales'))) {
            App::setLocale($lang);
        }

        return Redirect::route('home',['locale'=>$lang]);
    }
}
