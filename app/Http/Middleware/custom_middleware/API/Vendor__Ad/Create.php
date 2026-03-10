<?php

namespace App\Http\Middleware\custom_middleware\API\Vendor__Ad;

use Closure;
use Illuminate\Support\Facades\Auth;

class Create
{
    public function handle($request, Closure $next)
    {
        if(Auth::guard('api')->check())
        {
           if(Auth::guard('api')->user()->can('13_create_vendor___ad','api'))
           {
                return $next($request);
           }
           else
           {
                return response()->json([
                    'success' =>false,
                    'message' => 'This User has no Permission'
                ],403);
           }
        }
        else
        {
            return response()->json([
                'success' =>false,
                'message' => 'This User Not Authenticated'
            ],401);
        }
    }
}
