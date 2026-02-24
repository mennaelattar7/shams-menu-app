<?php

namespace App\Http\Middleware\custom_middleware\API\Vendor__MenuTheme;

use Closure;
use Illuminate\Support\Facades\Auth;

class GetVendorTheme
{
    public function handle($request, Closure $next)
    {
        if(Auth::guard('api')->check())
        {
           if(Auth::guard('api')->user()->can('12_get_vendor_theme_vendor___menu_theme','api'))
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
