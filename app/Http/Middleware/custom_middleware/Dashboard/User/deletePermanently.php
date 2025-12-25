<?php

namespace App\Http\Middleware\custom_middleware\Dashboard\User;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class deletePermanently
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
           if(Auth::user()->can('1_delete_permanently_user'))
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
