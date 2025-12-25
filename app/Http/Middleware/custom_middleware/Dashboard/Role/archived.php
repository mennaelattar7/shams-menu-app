<?php

namespace App\Http\Middleware\custom_middleware\Dashboard\Role;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class archived
{
    public function handle($request, Closure $next)
    {
        if(Auth::check())
        {
           if(Auth::user()->can('2_archived_role'))
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
