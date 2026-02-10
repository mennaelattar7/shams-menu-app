<?php

namespace App\Http\Middleware\custom_middleware\API\VendorBranch__Offer;

use Closure;
use Illuminate\Support\Facades\Auth;

class Single
{
    public function handle($request, Closure $next)
    {
        if(Auth::guard('api')->check())
        {
           if(Auth::guard('api')->user()->can('10_single_vendor_branch___offer','api'))
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
