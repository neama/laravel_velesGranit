<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class HostServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $host = Request::getHost();
        Session::put('hostname', $host);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
