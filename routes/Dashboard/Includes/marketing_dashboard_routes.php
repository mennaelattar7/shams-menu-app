<?php
use Illuminate\Support\Facades\Route;

Route::prefix('marketing-dashboard')->name('marketing_dashboard.')->group(function(){
    Route::group(['namespace' => 'Marketing_Dashboard'], function () {
        //-----------------------Start Home Routes--------------------------
        Route::prefix('home')->name('home.')->group(function () {
            Route::get('/', array(
                'as' => 'index',
                'uses' => 'HomeController@index'
            ));
        });
    });
});
