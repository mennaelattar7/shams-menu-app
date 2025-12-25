<?php

namespace App\Http\Middleware\custom_middleware\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Closure;

class CheckAuth
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
            return $next($request);
        }
        else
        {
            return Redirect::route('user.home.index',['locale'=>app()->getLocale()]);
        }
    }
}
