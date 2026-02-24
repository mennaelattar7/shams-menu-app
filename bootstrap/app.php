<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\AuthenticationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
        'setlocale' => \App\Http\Middleware\custom_middleware\SetLocale::class,
        'dashboardCheckAuth' => \App\Http\Middleware\custom_middleware\Dashboard\CheckAuth::class,
        // 👇 API KEY middleware
        'api.key' => \App\Http\Middleware\custom_middleware\API\AppAPIKey::class,


        //---------------------------Dashboard----------------------------------
         //User Middleware
        'dashboardUserArchived' => \App\Http\Middleware\custom_middleware\Dashboard\User\archived::class,
        'dashboardUserCreate' => \App\Http\Middleware\custom_middleware\Dashboard\User\create::class,
        'dashboardUserDelete' => \App\Http\Middleware\custom_middleware\Dashboard\User\delete::class,
        'dashboardUserDeletePermanently' => \App\Http\Middleware\custom_middleware\Dashboard\User\deletePermanently::class,
        'dashboardUserEdit' => \App\Http\Middleware\custom_middleware\Dashboard\User\edit::class,
        'dashboardUserIndex' => \App\Http\Middleware\custom_middleware\Dashboard\User\index::class,
        'dashboardUserRestore' => \App\Http\Middleware\custom_middleware\Dashboard\User\restore::class,
        'dashboardUserShow' => \App\Http\Middleware\custom_middleware\Dashboard\User\show::class,

        //Role Middleware
        'dashboardRoleArchived' => \App\Http\Middleware\custom_middleware\Dashboard\Role\archived::class,
        'dashboardRoleCreate' => \App\Http\Middleware\custom_middleware\Dashboard\Role\create::class,
        'dashboardRoleDelete' => \App\Http\Middleware\custom_middleware\Dashboard\Role\delete::class,
        'dashboardRoleDeletePermanently' => \App\Http\Middleware\custom_middleware\Dashboard\Role\deletePermanently::class,
        'dashboardRoleEdit' => \App\Http\Middleware\custom_middleware\Dashboard\Role\edit::class,
        'dashboardRoleIndex' => \App\Http\Middleware\custom_middleware\Dashboard\Role\index::class,
        'dashboardRoleRestore' => \App\Http\Middleware\custom_middleware\Dashboard\Role\restore::class,
        'dashboardRoleShow' => \App\Http\Middleware\custom_middleware\Dashboard\Role\show::class,

        //Permission Middleware
        'dashboardPermissionIndex' => \App\Http\Middleware\custom_middleware\Dashboard\Permission\index::class,
        'dashboardPermissionCreate' => \App\Http\Middleware\custom_middleware\Dashboard\Permission\create::class,
        'dashboardPermissionShow' => \App\Http\Middleware\custom_middleware\Dashboard\Permission\show::class,
        'dashboardPermissionEdit' => \App\Http\Middleware\custom_middleware\Dashboard\Permission\edit::class,
        'dashboardPermissionDelete' => \App\Http\Middleware\custom_middleware\Dashboard\Permission\delete::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {

        $exceptions->render(function (AuthenticationException $e, $request) {

            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Token is missing or invalid'
            ], 401);

        });

    })
    ->create();
