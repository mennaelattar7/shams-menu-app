<?php

namespace App\Http\Middleware\custom_middleware\API;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AppAPIKey
{
    public function handle($request, Closure $next)
    {
        $apiKey = $request->header('X-API-KEY');
        if (!$apiKey || $apiKey !== config('app.api_key')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized app'
            ], 401);
        }

        return $next($request);
    }
}
