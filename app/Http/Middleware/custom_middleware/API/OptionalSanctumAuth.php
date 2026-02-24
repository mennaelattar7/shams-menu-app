<?php

namespace App\Http\Middleware\custom_middleware\API;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OptionalSanctumAuth
{
    public function handle($request, Closure $next)
    {
        // نجرب نعمل authenticate باستخدام sanctum
        Auth::shouldUse('sanctum');

        return $next($request);
    }
}
