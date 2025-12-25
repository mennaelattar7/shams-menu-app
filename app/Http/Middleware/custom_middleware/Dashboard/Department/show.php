<?php

namespace App\Http\Middleware\custom_middleware\Dashboard\Department;

use Illuminate\Support\Facades\AuthService;
use Illuminate\Support\Facades\Redirect;
use Closure;
use Illuminate\Support\Facades\Auth;

class show
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check())
        {
           if(Auth::user()->can('6_single_department'))
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
