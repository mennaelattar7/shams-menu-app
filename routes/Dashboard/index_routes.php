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
            //------------------------Start vendors Routes----------------------
            Route::prefix('vendors')->name('vendor.')->group(function () {
                Route::get('/', array(
                    'as' => 'index',
                    'uses' => 'VendorController@index'
                ))->middleware('dashboardVendorIndex');

                Route::get('/archived', array(
                    'as' => 'archived',
                    'uses' => 'VendorController@archived'
                ))->middleware('dashboardVendorArchived');

                Route::get('/create', array(
                    'as' => 'create',
                    'uses' => 'VendorController@create'
                ))->middleware('dashboardVendorCreate');

                Route::post('/store', array(
                            'as' => 'store',
                            'uses' => 'VendorController@store'
                ))->middleware('dashboardVendorCreate');

                Route::get('/show/{vendor}', array(
                            'as' => 'show',
                            'uses' => 'VendorController@show'
                ))->middleware('dashboardVendorShow');

                Route::get('/edit/{vendor}', array(
                            'as' => 'edit',
                            'uses' => 'VendorController@edit'
                ))->middleware('dashboardVendorEdit');

                Route::put('/edit/{vendor}', array(
                            'as' => 'update',
                            'uses' => 'VendorController@update'
                ))->middleware('dashboardVendorEdit');

                Route::get('/delete/{vendor}', array(
                    'as' => 'delete',
                    'uses' => 'VendorController@destroy'
                ))->middleware('dashboardVendorDelete');

                Route::get('/restore/{vendor}', array(
                    'as' => 'restore',
                    'uses' => 'VendorController@restore'
                ))->middleware('dashboardVendorRestore');

                Route::get('/delete-permanently/{vendor}', array(
                    'as' => 'delete_permanently',
                    'uses' => 'VendorController@destroyPermanently'
                ))->middleware('dashboardVendorDeletePermanently');
            });
            //------------------------Start users Routes----------------------
            Route::prefix('users')->name('user.')->group(function () {
                Route::get('/', array(
                    'as' => 'index',
                    'uses' => 'UserController@index'
                ))->middleware('dashboardUserIndex');

                Route::get('/archived', array(
                    'as' => 'archived',
                    'uses' => 'UserController@archived'
                ))->middleware('dashboardUserArchived');

                Route::get('/create', array(
                    'as' => 'create',
                    'uses' => 'UserController@create'
                ))->middleware('dashboardUserCreate');

                Route::post('/store', array(
                            'as' => 'store',
                            'uses' => 'UserController@store'
                ))->middleware('dashboardUserCreate');

                Route::get('/show/{user}', array(
                            'as' => 'show',
                            'uses' => 'UserController@show'
                ))->middleware('dashboardUserShow');

                Route::get('/edit/{user}', array(
                            'as' => 'edit',
                            'uses' => 'UserController@edit'
                ))->middleware('dashboardUserEdit');

                Route::put('/edit/{user}', array(
                            'as' => 'update',
                            'uses' => 'UserController@update'
                ))->middleware('dashboardUserEdit');

                Route::get('/delete/{user}', array(
                    'as' => 'delete',
                    'uses' => 'UserController@destroy'
                ))->middleware('dashboardUserDelete');

                Route::get('/restore/{user}', array(
                    'as' => 'restore',
                    'uses' => 'UserController@restore'
                ))->middleware('dashboardUserRestore');

                Route::get('/delete-permanently/{user}', array(
                    'as' => 'delete_permanently',
                    'uses' => 'UserController@destroyPermanently'
                ))->middleware('dashboardUserDeletePermanently');
            });
            //------------------------Start Roles Routes----------------------
            Route::prefix('roles')->name('role.')->group(function () {
                Route::get('/', array(
                    'as' => 'index',
                    'uses' => 'RoleController@index'
                ))->middleware('dashboardRoleIndex');

                Route::get('/create', array(
                    'as' => 'create',
                    'uses' => 'RoleController@create'
                ))->middleware('dashboardRoleCreate');

                Route::post('/store', array(
                            'as' => 'store',
                            'uses' => 'RoleController@store'
                ))->middleware('dashboardRoleCreate');

                Route::get('/show/{role}', array(
                            'as' => 'show',
                            'uses' => 'RoleController@show'
                ))->middleware('dashboardRoleShow');

                Route::get('/edit/{role}', array(
                            'as' => 'edit',
                            'uses' => 'RoleController@edit'
                ))->middleware('dashboardRoleEdit');

                Route::put('/edit/{role}', array(
                            'as' => 'update',
                            'uses' => 'RoleController@update'
                ))->middleware('dashboardRoleEdit');

                Route::get('/delete/{role}', array(
                    'as' => 'delete',
                    'uses' => 'RoleController@destroy'
                ))->middleware('dashboardRoleDelete');

                Route::get('/restore/{role}', array(
                    'as' => 'restore',
                    'uses' => 'RoleController@restore'
                ))->middleware('dashboardRoleRestore');

                Route::get('/delete-permanently/{role}', array(
                    'as' => 'delete_permanently',
                    'uses' => 'RoleController@destroyPermanently'
                ))->middleware('dashboardRoleDeletePermanently');

                //------------------------Ajax Routes------------------
                Route::post('/new_role/ajax', array(
                    'as' => 'new_role.ajax',
                    'uses' => 'RoleController@ajaxNewRole'
                ));
            });
            //------------------------Start Permissions Routes----------------------
            Route::prefix('permissions')->name('permission.')->group(function () {
                Route::get('/', array(
                    'as' => 'index',
                    'uses' => 'PermissionController@index'
                ))->middleware('dashboardPermissionIndex');
                Route::get('/create', array(
                    'as' => 'create',
                    'uses' => 'PermissionController@create'
                ))->middleware('dashboardPermissionCreate');
                Route::post('/store', array(
                            'as' => 'store',
                            'uses' => 'PermissionController@store'
                ))->middleware('dashboardPermissionCreate');
                Route::get('/show/{permission}', array(
                            'as' => 'show',
                            'uses' => 'PermissionController@show'
                ))->middleware('dashboardPermissionShow');
                Route::get('/edit/{permission}', array(
                            'as' => 'edit',
                            'uses' => 'PermissionController@edit'
                ))->middleware('dashboardPermissionEdit');
                Route::put('/edit/{permission}', array(
                            'as' => 'update',
                            'uses' => 'PermissionController@update'
                ))->middleware('dashboardPermissionEdit');
                Route::get('/delete/{permission_id}', array(
                    'as' => 'delete',
                    'uses' => 'PermissionController@destroy'
                ))->middleware('dashboardPermissionDelete');
            });
        });
    });
});
