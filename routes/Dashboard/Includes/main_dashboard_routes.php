<?php
use Illuminate\Support\Facades\Route;

Route::prefix('main-dashboard')->name('main_dashboard.')->group(function(){
    Route::group(['namespace' => 'Main_Dashboard'], function () {
        //Start Profile Function
        Route::get('/profile/{user}', array(
            'as' => 'profile.index',
            'uses' => 'ProfileController@profile'
        ));
        Route::post('/profile/complete-employee-data/{user}', array(
            'as' => 'profile.complete_employee_data',
            'uses' => 'ProfileController@completeEmployeeData'
        ));
        //-----------------------Start Home Routes--------------------------
        Route::prefix('home')->name('home.')->group(function () {
            Route::get('/', array(
                'as' => 'index',
                'uses' => 'HomeController@index'
            ));
        });
    });
});

Route::prefix('{context_url}')
        ->where(['context_url' => 'hr-dashboard|projects-dashboard|maintenance-dashboard'])
        ->name('main_dashboard.')
        ->group(function (){
        Route::group(['namespace' => 'Main_Dashboard'], function () {
            //------------------------Start departments Routes----------------------
            Route::prefix('departments')->name('department.')->group(function () {
                Route::get('/', array(
                    'as' => 'index',
                    'uses' => 'DepartmentController@index'
                ))->middleware('dashboardDepartmentIndex');

                Route::get('/archived', array(
                    'as' => 'archived',
                    'uses' => 'DepartmentController@archived'
                ))->middleware('dashboardDepartmentArchived');

                Route::get('/create', array(
                    'as' => 'create',
                    'uses' => 'DepartmentController@create'
                ))->middleware('dashboardDepartmentCreate');

                Route::post('/store', array(
                            'as' => 'store',
                            'uses' => 'DepartmentController@store'
                ))->middleware('dashboardDepartmentCreate');

                Route::get('/show/{department}', array(
                            'as' => 'show',
                            'uses' => 'DepartmentController@show'
                ))->middleware('dashboardDepartmentShow');

                Route::get('/edit/{department}', array(
                            'as' => 'edit',
                            'uses' => 'DepartmentController@edit'
                ))->middleware('dashboardDepartmentEdit');

                Route::put('/edit/{department}', array(
                            'as' => 'update',
                            'uses' => 'DepartmentController@update'
                ))->middleware('dashboardDepartmentEdit');

                Route::get('/delete/{department}', array(
                    'as' => 'delete',
                    'uses' => 'DepartmentController@destroy'
                ))->middleware('dashboardDepartmentDelete');

                Route::get('/restore/{department}', array(
                    'as' => 'restore',
                    'uses' => 'DepartmentController@restore'
                ))->middleware('dashboardDepartmentRestore');

                Route::get('/delete-permanently/{department}', array(
                    'as' => 'delete_permanently',
                    'uses' => 'DepartmentController@destroyPermanently'
                ))->middleware('dashboardDepartmentDeletePermanently');
            });

            //------------------------Start positions Routes----------------------
            Route::prefix('positions')->name('position.')->group(function () {
                Route::get('/', array(
                    'as' => 'index',
                    'uses' => 'PositionController@index'
                ))->middleware('dashboardPositionIndex');

                Route::get('/archived', array(
                    'as' => 'archived',
                    'uses' => 'PositionController@archived'
                ))->middleware('dashboardPositionArchived');

                Route::get('/create', array(
                    'as' => 'create',
                    'uses' => 'PositionController@create'
                ))->middleware('dashboardPositionCreate');

                Route::post('/store', array(
                            'as' => 'store',
                            'uses' => 'PositionController@store'
                ))->middleware('dashboardPositionCreate');

                Route::get('/show/{position}', array(
                            'as' => 'show',
                            'uses' => 'PositionController@show'
                ))->middleware('dashboardPositionShow');

                Route::get('/edit/{position}', array(
                            'as' => 'edit',
                            'uses' => 'PositionController@edit'
                ))->middleware('dashboardPositionEdit');

                Route::put('/edit/{position}', array(
                            'as' => 'update',
                            'uses' => 'PositionController@update'
                ))->middleware('dashboardPositionEdit');

                Route::get('/delete/{position}', array(
                    'as' => 'delete',
                    'uses' => 'PositionController@destroy'
                ))->middleware('dashboardPositionDelete');

                Route::get('/restore/{position}', array(
                    'as' => 'restore',
                    'uses' => 'PositionController@restore'
                ))->middleware('dashboardPositionRestore');

                Route::get('/delete-permanently/{position}', array(
                    'as' => 'delete_permanently',
                    'uses' => 'PositionController@destroyPermanently'
                ))->middleware('dashboardPositionDeletePermanently');
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

Route::prefix('{context_url}')
        ->where(['context_url' => 'store-dashboard|external-website-dashboard'])
        ->name('main_dashboard.')
        ->group(function (){
        Route::group(['namespace' => 'Main_Dashboard'], function () {
            //------------------------Start product_brands Routes----------------------
            Route::prefix('product_brands')->name('product_brand.')->group(function () {
                Route::get('/', array(
                    'as' => 'index',
                    'uses' => 'ProductBrandController@index'
                ))->middleware('dashboardProductBrandIndex');

                Route::get('/archived', array(
                    'as' => 'archived',
                    'uses' => 'ProductBrandController@archived'
                ))->middleware('dashboardProductBrandArchived');

                Route::get('/create', array(
                    'as' => 'create',
                    'uses' => 'ProductBrandController@create'
                ))->middleware('dashboardProductBrandCreate');

                Route::post('/store', array(
                            'as' => 'store',
                            'uses' => 'ProductBrandController@store'
                ))->middleware('dashboardProductBrandCreate');

                Route::get('/show/{product_brand}', array(
                            'as' => 'show',
                            'uses' => 'ProductBrandController@show'
                ))->middleware('dashboardProductBrandShow');

                Route::get('/edit/{product_brand}', array(
                            'as' => 'edit',
                            'uses' => 'ProductBrandController@edit'
                ))->middleware('dashboardProductBrandEdit');

                Route::put('/edit/{product_brand}', array(
                            'as' => 'update',
                            'uses' => 'ProductBrandController@update'
                ))->middleware('dashboardProductBrandEdit');

                Route::get('/delete/{product_brand}', array(
                    'as' => 'delete',
                    'uses' => 'ProductBrandController@destroy'
                ))->middleware('dashboardProductBrandDelete');

                Route::get('/restore/{product_brand}', array(
                    'as' => 'restore',
                    'uses' => 'ProductBrandController@restore'
                ))->middleware('dashboardProductBrandRestore');

                Route::get('/delete-permanently/{product_brand}', array(
                    'as' => 'delete_permanently',
                    'uses' => 'ProductBrandController@destroyPermanently'
                ))->middleware('dashboardProductBrandDeletePermanently');
            });
            //------------------------Start product_categories Routes----------------------
            Route::prefix('product_categories')->name('product_category.')->group(function () {
                Route::get('/', array(
                    'as' => 'index',
                    'uses' => 'ProductCategoryController@index'
                ))->middleware('dashboardProductCategoryIndex');

                Route::get('/archived', array(
                    'as' => 'archived',
                    'uses' => 'ProductCategoryController@archived'
                ))->middleware('dashboardProductCategoryArchived');

                Route::get('/create', array(
                    'as' => 'create',
                    'uses' => 'ProductCategoryController@create'
                ))->middleware('dashboardProductCategoryCreate');

                Route::post('/store', array(
                            'as' => 'store',
                            'uses' => 'ProductCategoryController@store'
                ))->middleware('dashboardProductCategoryCreate');

                Route::get('/show/{product_category}', array(
                            'as' => 'show',
                            'uses' => 'ProductCategoryController@show'
                ))->middleware('dashboardProductCategoryShow');

                Route::get('/edit/{product_category}', array(
                            'as' => 'edit',
                            'uses' => 'ProductCategoryController@edit'
                ))->middleware('dashboardProductCategoryEdit');

                Route::put('/edit/{product_category}', array(
                            'as' => 'update',
                            'uses' => 'ProductCategoryController@update'
                ))->middleware('dashboardProductCategoryEdit');

                Route::get('/delete/{product_category}', array(
                    'as' => 'delete',
                    'uses' => 'ProductCategoryController@destroy'
                ))->middleware('dashboardProductCategoryDelete');

                Route::get('/restore/{product_category}', array(
                    'as' => 'restore',
                    'uses' => 'ProductCategoryController@restore'
                ))->middleware('dashboardProductCategoryRestore');

                Route::get('/delete-permanently/{product_category}', array(
                    'as' => 'delete_permanently',
                    'uses' => 'ProductCategoryController@destroyPermanently'
                ))->middleware('dashboardProductCategoryDeletePermanently');
            });
        });
});
Route::prefix('{context_url}')
        ->where(['context_url' => 'hr-dashboard|projects-dashboard|external-website-dashboard|customer-service-dashboard|maintenance-dashboard'])
        ->name('main_dashboard.')
        ->group(function (){
        Route::group(['namespace' => 'Main_Dashboard'], function () {
            //------------------------Start employees Routes----------------------
            Route::prefix('employees')->name('employee.')->group(function () {
                Route::get('/', array(
                    'as' => 'index',
                    'uses' => 'EmployeeController@index'
                ))->middleware('dashboardEmployeeIndex');

                Route::get('/archived', array(
                    'as' => 'archived',
                    'uses' => 'EmployeeController@archived'
                ))->middleware('dashboardEmployeeArchived');

                Route::get('/create', array(
                    'as' => 'create',
                    'uses' => 'EmployeeController@create'
                ))->middleware('dashboardEmployeeCreate');

                Route::post('/store', array(
                            'as' => 'store',
                            'uses' => 'EmployeeController@store'
                ))->middleware('dashboardEmployeeCreate');

                Route::get('/show/{employee}', array(
                            'as' => 'show',
                            'uses' => 'EmployeeController@show'
                ))->middleware('dashboardEmployeeShow');

                Route::get('/edit/{employee}', array(
                            'as' => 'edit',
                            'uses' => 'EmployeeController@edit'
                ))->middleware('dashboardEmployeeEdit');

                Route::put('/edit/{employee}', array(
                            'as' => 'update',
                            'uses' => 'EmployeeController@update'
                ))->middleware('dashboardEmployeeEdit');

                Route::get('/assign-logistic-specialization/{employee}', array(
                            'as' => 'assign_logistic_specialization',
                            'uses' => 'EmployeeController@edit'
                ))->middleware('dashboardEmployeeAssignLogisticSpecialization');

                Route::put('/assign-logistic-specialization/{employee}', array(
                            'as' => 'assign_logistic_specialization',
                            'uses' => 'EmployeeController@update'
                ))->middleware('dashboardEmployeeAssignLogisticSpecialization');

                Route::get('/delete/{employee}', array(
                    'as' => 'delete',
                    'uses' => 'EmployeeController@destroy'
                ))->middleware('dashboardEmployeeDelete');

                Route::get('/restore/{employee}', array(
                    'as' => 'restore',
                    'uses' => 'EmployeeController@restore'
                ))->middleware('dashboardEmployeeRestore');

                Route::get('/delete-permanently/{employee}', array(
                    'as' => 'delete_permanently',
                    'uses' => 'EmployeeController@destroyPermanently'
                ))->middleware('dashboardEmployeeDeletePermanently');

                Route::get('/review_account/{employee}', array(
                    'as' => 'review_account',
                    'uses' => 'EmployeeController@reviewAccount'
                ))->middleware('dashboardEmployeeReviewAccount');

            });
        });
});

Route::prefix('{context_url}')
        ->where(['context_url' => 'external-website-dashboard|customer-service-dashboard'])
        ->name('main_dashboard.')
        ->group(function (){
        Route::group(['namespace' => 'Main_Dashboard'], function () {
            //------------------------Start contact_us_messages Routes----------------------
            Route::prefix('contact_us_messages')->name('contact_us_message.')->group(function () {
                Route::get('/', array(
                    'as' => 'index',
                    'uses' => 'ContactUsMessageController@index'
                ))->middleware('dashboardContactUsMessageIndex');

                Route::get('/show/{contact_us_message}', array(
                            'as' => 'show',
                            'uses' => 'ContactUsMessageController@show'
                ))->middleware('dashboardContactUsMessageShow');
            });
        });
});

Route::prefix('{context_url}')
        ->where(['context_url' => 'hr-dashboard|external-website-dashboard|customer-service-dashboard'])
        ->name('main_dashboard.')
        ->group(function (){
        Route::group(['namespace' => 'Main_Dashboard'], function () {
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
        });
});

Route::prefix('{context_url}')
        ->where(['context_url' => 'external-website-dashboard|projects-dashboard'])
        ->name('main_dashboard.')
        ->group(function (){
        Route::group(['namespace' => 'Main_Dashboard'], function () {
            //------------------------Start projects Routes----------------------
            Route::prefix('projects')->name('project.')->group(function () {
                Route::get('/', array(
                    'as' => 'index',
                    'uses' => 'ProjectController@index'
                ))->middleware('dashboardProjectIndex');

                Route::get('/archived', array(
                    'as' => 'archived',
                    'uses' => 'ProjectController@archived'
                ))->middleware('dashboardProjectArchived');

                Route::get('/create', array(
                    'as' => 'create',
                    'uses' => 'ProjectController@create'
                ))->middleware('dashboardProjectCreate');

                Route::post('/store', array(
                            'as' => 'store',
                            'uses' => 'ProjectController@store'
                ))->middleware('dashboardProjectCreate');

                Route::get('/show/{project}', array(
                            'as' => 'show',
                            'uses' => 'ProjectController@show'
                ))->middleware('dashboardProjectShow');

                Route::get('/edit/{project}', array(
                            'as' => 'edit',
                            'uses' => 'ProjectController@edit'
                ))->middleware('dashboardProjectEdit');

                Route::put('/edit/{project}', array(
                            'as' => 'update',
                            'uses' => 'ProjectController@update'
                ))->middleware('dashboardProjectEdit');

                Route::get('/delete/{project}', array(
                    'as' => 'delete',
                    'uses' => 'ProjectController@destroy'
                ))->middleware('dashboardProjectDelete');

                Route::get('/restore/{project}', array(
                    'as' => 'restore',
                    'uses' => 'ProjectController@restore'
                ))->middleware('dashboardProjectRestore');

                Route::get('/delete-permanently/{project}', array(
                    'as' => 'delete_permanently',
                    'uses' => 'ProjectController@destroyPermanently'
                ))->middleware('dashboardProjectDeletePermanently');

                //------------------------All Ajax Requests------------------
                Route::post('/new_project_feature/ajax', array(
                    'as' => 'new_project_feature.ajax',
                    'uses' => 'ProjectController@ajaxNewProjectFeature'
                ));
            });

            //------------------------Start project_features Routes----------------------
            Route::prefix('project_features')->name('project_feature.')->group(function () {
                Route::get('/', array(
                    'as' => 'index',
                    'uses' => 'ProjectFeatureController@index'
                ))->middleware('dashboardProjectFeatureIndex');

                Route::get('/archived', array(
                    'as' => 'archived',
                    'uses' => 'ProjectFeatureController@archived'
                ))->middleware('dashboardProjectFeatureArchived');

                Route::get('/create', array(
                    'as' => 'create',
                    'uses' => 'ProjectFeatureController@create'
                ))->middleware('dashboardProjectFeatureCreate');

                Route::post('/store', array(
                            'as' => 'store',
                            'uses' => 'ProjectFeatureController@store'
                ))->middleware('dashboardProjectFeatureCreate');

                Route::get('/show/{project_feature}', array(
                            'as' => 'show',
                            'uses' => 'ProjectFeatureController@show'
                ))->middleware('dashboardProjectFeatureShow');

                Route::get('/edit/{project_feature}', array(
                            'as' => 'edit',
                            'uses' => 'ProjectFeatureController@edit'
                ))->middleware('dashboardProjectFeatureEdit');

                Route::put('/edit/{project_feature}', array(
                            'as' => 'update',
                            'uses' => 'ProjectFeatureController@update'
                ))->middleware('dashboardProjectFeatureEdit');

                Route::get('/delete/{project_feature}', array(
                    'as' => 'delete',
                    'uses' => 'ProjectFeatureController@destroy'
                ))->middleware('dashboardProjectFeatureDelete');

                Route::get('/restore/{project_feature}', array(
                    'as' => 'restore',
                    'uses' => 'ProjectFeatureController@restore'
                ))->middleware('dashboardProjectFeatureRestore');

                Route::get('/delete-permanently/{project_feature}', array(
                    'as' => 'delete_permanently',
                    'uses' => 'ProjectFeatureController@destroyPermanently'
                ))->middleware('dashboardProjectFeatureDeletePermanently');
            });
        });
});
