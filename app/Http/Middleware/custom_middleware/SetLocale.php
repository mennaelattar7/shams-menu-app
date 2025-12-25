<?php

namespace App\Http\Middleware\custom_middleware;

use Closure;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        if ($request->route('locale')) {
            app()->setLocale($request->route('locale'));
        }
        return $next($request);
    }
}
