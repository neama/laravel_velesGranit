<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class AdminMiddleware {
    public function handle($request, Closure $next, $guard = null) {
        // если это не администратор — показываем 404 Not Found

     //   Log::info('AdminMiddleware');
        if ( ! auth()->user()->admin) {
            abort(404);
        }
        return $next($request);
    }
}
