<?php

namespace App\Http\Middleware\custom_middleware\Dashboard\Role;

use Illuminate\Support\Facades\AuthService;
use Illuminate\Support\Facades\Redirect;
use Closure;
use Illuminate\Support\Facades\Auth;

class show
{
    public function handle($request, Closure $next)
    {
        if(Auth::check())
        {
           if(Auth::user()->can('2_single_role'))
           {
                return $next($request);
           }
           else
           {
                return Redirect::route('dashboard.error_pages.not_permissions',['locale'=>app()->getLocale()]);
           }
        }
        else
        {
            return Redirect::route('dashboard.auth.login',['locale'=>app()->getLocale()]);
        }
    }
}
