<?php
use Illuminate\Support\Facades\Route;

Route::prefix('warehouse-dashboard')->name('warehouse_dashboard.')->group(function(){
    Route::group(['namespace' => 'Warehouse_Dashboard'], function () {
        //-----------------------Start Home Routes--------------------------
        Route::prefix('home')->name('home.')->group(function () {
            Route::get('/', array(
                'as' => 'index',
                'uses' => 'HomeController@index'
            ));
        });
    });
});
