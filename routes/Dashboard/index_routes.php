<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\HomeController;

Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::group(['namespace' => 'App\Http\Controllers\Dashboard'], function () {
        //Start Authentication Routes
        Route::group(['namespace' => 'Authentication'], function () {

            //Start Login Function
            Route::get('/login', array(
                        'as' => 'auth.login',
                        'uses' => 'AuthController@getLogin'
            ));
            Route::post('/login', array(
                        'as' => 'auth.login',
                        'uses' => 'AuthController@postLogin'
            ));

            //Start Change Password Function
            Route::get('/change-password', array(
                        'as' => 'auth.change_password',
                        'uses' => 'AuthController@getChangePassword'
            ));
            Route::post('/change-password', array(
                        'as' => 'auth.change_password',
                        'uses' => 'AuthController@postChangePassword'
            ));


            //Logout Function
            Route::get('/logout', array(
                        'as' => 'auth.logout',
                        'uses' => 'AuthController@getLogout'
            ));
        });
        Route::group(['middleware' => ['dashboardCheckAuth']],function(){
            //----------------------Start Error Pages Routes -------------------
            Route::get('/not-permission', array(
                        'as' => 'error_pages.not_permissions',
                        'uses' => 'ErrorPageController@notPermission'
            ));
            Route::get('/page-notfount', array(
                        'as' => 'error_pages.not_found',
                        'uses' => 'ErrorPageController@notFound'
            ));
            Route::get('admin/notifications', [HomeController::class, 'getNotifications'])
            ->name('admin.notifications');

            Route::get('/home', array(
                        'as' => 'home.index',
                        'uses' => 'HomeController@index'
            ));

            //______________ Start Main Dashboard Routes_________________
            require __DIR__ . '/Includes/main_dashboard_routes.php';
            //______________ Start Evaluations Dashboard_________________
            require __DIR__ . '/Includes/evaluations_dashboard_routes.php';
            //______________ Start External website Dashboard_________________
            require __DIR__ . '/Includes/external_website_dashboard_routes.php';
            //______________ Start Projects Dashboard_________________
            require __DIR__ . '/Includes/projects_dashboard_routes.php';
            //______________ Start maintenance_dashboard_________________
            require __DIR__ . '/Includes/maintenance_dashboard_routes.php';
            //______________ Start marketing_dashboard_________________
            require __DIR__ . '/Includes/marketing_dashboard_routes.php';
            //______________ Start Store Dashboard_________________
            require __DIR__ . '/Includes/store_dashboard_routes.php';
            //______________ Start Duct Factory Dashboard_________________
            require __DIR__ . '/Includes/duct_factory_dashboard_routes.php';
            //______________ Start Warehouse Dashboard_________________
            require __DIR__ . '/Includes/warehouse_dashboard_routes.php';
            //______________ Start HR Dashboard_________________
            require __DIR__ . '/Includes/hr_dashboard_routes.php';
            //______________ Start Customer Service Dashboard_________________
            require __DIR__ . '/Includes/customer_service_dashboard_routes.php';
        });
    });
});
