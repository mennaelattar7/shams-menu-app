<?php

namespace App\Http\Middleware\custom_middleware\Dashboard\Role;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Closure;

class restore
{
    public function handle($request, Closure $next)
    {
        if(Auth::check())
        {
           if(Auth::user()->can('2_restore_role'))
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
