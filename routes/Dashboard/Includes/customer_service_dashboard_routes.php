<?php
use Illuminate\Support\Facades\Route;

Route::prefix('customer-service-dashboard')->name('customer_service_dashboard.')->group(function(){
    Route::group(['namespace' => 'Customer_Service_Dashboard'], function () {
        //-----------------------Start Home Routes--------------------------
        Route::prefix('home')->name('home.')->group(function () {
            Route::get('/', array(
                'as' => 'index',
                'uses' => 'HomeController@index'
            ));
        });

        //------------------------Start customer_request_evaluations Routes----------------------
        Route::prefix('customer_request_evaluations')->name('customer_request_evaluation.')->group(function () {
            Route::get('/', array(
                'as' => 'index',
                'uses' => 'CustomerRequestEvaluationController@index'
            ))->middleware('dashboardCustomerRequestEvaluationIndex');

            Route::get('/show/{customer_request_evaluation}', array(
                        'as' => 'show',
                        'uses' => 'CustomerRequestEvaluationController@show'
            ))->middleware('dashboardCustomerRequestEvaluationShow');
        });
    });
});
