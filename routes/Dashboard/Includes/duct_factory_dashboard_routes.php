<?php
use Illuminate\Support\Facades\Route;

Route::prefix('duct-factory-dashboard')->name('duct_factory_dashboard.')->group(function(){
    Route::group(['namespace' => 'Duct_Factory_Dashboard'], function () {
        //-----------------------Start Home Routes--------------------------
        Route::prefix('home')->name('home.')->group(function () {
            Route::get('/', array(
                'as' => 'index',
                'uses' => 'HomeController@index'
            ));
        });
    });
});
