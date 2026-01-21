<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(ViewFactory $view): void
    {
        $view->composer('Dashboard.*', function($view){
            $count_users = User::count();
            $count_roles = Role::count();
            $count_permissions = Permission::count();
            $view->with('count_users',$count_users)
                 ->with('count_roles' ,$count_roles)
                 ->with('count_permissions',$count_permissions);
        });

    }
}
