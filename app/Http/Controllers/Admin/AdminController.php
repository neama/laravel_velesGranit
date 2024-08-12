<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {


        $this->middleware('auth');
        $this->middleware('admin');

        /*Log::info('Registered middlewares for AdminController:', [
            'middlewares' => $this->getMiddleware()
        ]);
        */
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request) {
        return view('admin.index');
    }

    public function index(Request $request){
        return view('admin.index');
    }



}
