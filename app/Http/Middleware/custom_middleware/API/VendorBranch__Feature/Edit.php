<?php

namespace App\Http\Middleware\custom_middleware\API\VendorBranch__Feature;

use Closure;
use Illuminate\Support\Facades\Auth;

class Edit
{
    public function handle($request, Closure $next)
    {
        if(Auth::guard('api')->check())
        {
           if(Auth::guard('api')->user()->can('8_edit_vendor_branch___feature','api'))
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
