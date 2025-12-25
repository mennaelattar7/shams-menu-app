<?php
use Illuminate\Support\Facades\Route;

Route::prefix('hr-dashboard')->name('hr_dashboard.')->group(function(){
    Route::group(['namespace' => 'HR_Dashboard'], function () {
        //-----------------------Start Home Routes--------------------------
        Route::prefix('home')->name('home.')->group(function () {
            Route::get('/', array(
                'as' => 'index',
                'uses' => 'HomeController@index'
            ));
        });
    });
});
