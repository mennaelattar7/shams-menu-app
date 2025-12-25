<?php
use Illuminate\Support\Facades\Route;

Route::prefix('external-website-dashboard')->name('external_website_dashboard.')->group(function(){
    Route::group(['namespace' => 'External_Website_Dashboard'], function () {
        //-----------------------Start Home Routes--------------------------
        Route::prefix('home')->name('home.')->group(function () {
            Route::get('/', array(
                'as' => 'index',
                'uses' => 'HomeController@index'
            ));
        });
        //------------------------Start why_kaza_points Routes----------------------
        Route::prefix('why_kaza_points')->name('why_kaza_point.')->group(function () {
            Route::get('/', array(
                'as' => 'index',
                'uses' => 'WhyKazaPointController@index'
            ))->middleware('dashboardWhyKazaPointIndex');

            Route::get('/archived', array(
                'as' => 'archived',
                'uses' => 'WhyKazaPointController@archived'
            ))->middleware('dashboardWhyKazaPointArchived');

            Route::get('/create', array(
                'as' => 'create',
                'uses' => 'WhyKazaPointController@create'
            ))->middleware('dashboardWhyKazaPointCreate');

            Route::post('/store', array(
                        'as' => 'store',
                        'uses' => 'WhyKazaPointController@store'
            ))->middleware('dashboardWhyKazaPointCreate');

            Route::get('/show/{why_kaza_point}', array(
                        'as' => 'show',
                        'uses' => 'WhyKazaPointController@show'
            ))->middleware('dashboardWhyKazaPointShow');

            Route::get('/edit/{why_kaza_point}', array(
                        'as' => 'edit',
                        'uses' => 'WhyKazaPointController@edit'
            ))->middleware('dashboardWhyKazaPointEdit');

            Route::put('/edit/{why_kaza_point}', array(
                        'as' => 'update',
                        'uses' => 'WhyKazaPointController@update'
            ))->middleware('dashboardWhyKazaPointEdit');

            Route::get('/delete/{why_kaza_point}', array(
                'as' => 'delete',
                'uses' => 'WhyKazaPointController@destroy'
            ))->middleware('dashboardWhyKazaPointDelete');

            Route::get('/restore/{why_kaza_point}', array(
                'as' => 'restore',
                'uses' => 'WhyKazaPointController@restore'
            ))->middleware('dashboardWhyKazaPointRestore');

            Route::get('/delete-permanently/{why_kaza_point}', array(
                'as' => 'delete_permanently',
                'uses' => 'WhyKazaPointController@destroyPermanently'
            ))->middleware('dashboardWhyKazaPointDeletePermanently');
        });
        //------------------------Start place_activities Routes----------------------
        Route::prefix('place_activities')->name('place_activity.')->group(function () {
            Route::get('/', array(
                'as' => 'index',
                'uses' => 'PlaceActivityController@index'
            ))->middleware('dashboardPlaceActivityIndex');

            Route::get('/archived', array(
                'as' => 'archived',
                'uses' => 'PlaceActivityController@archived'
            ))->middleware('dashboardPlaceActivityArchived');

            Route::get('/create', array(
                'as' => 'create',
                'uses' => 'PlaceActivityController@create'
            ))->middleware('dashboardPlaceActivityCreate');

            Route::post('/store', array(
                        'as' => 'store',
                        'uses' => 'PlaceActivityController@store'
            ))->middleware('dashboardPlaceActivityCreate');

            Route::get('/show/{place_activity}', array(
                        'as' => 'show',
                        'uses' => 'PlaceActivityController@show'
            ))->middleware('dashboardPlaceActivityShow');

            Route::get('/edit/{place_activity}', array(
                        'as' => 'edit',
                        'uses' => 'PlaceActivityController@edit'
            ))->middleware('dashboardPlaceActivityEdit');

            Route::put('/edit/{place_activity}', array(
                        'as' => 'update',
                        'uses' => 'PlaceActivityController@update'
            ))->middleware('dashboardPlaceActivityEdit');

            Route::get('/delete/{place_activity}', array(
                'as' => 'delete',
                'uses' => 'PlaceActivityController@destroy'
            ))->middleware('dashboardPlaceActivityDelete');

            Route::get('/restore/{place_activity}', array(
                'as' => 'restore',
                'uses' => 'PlaceActivityController@restore'
            ))->middleware('dashboardPlaceActivityRestore');

            Route::get('/delete-permanently/{place_activity}', array(
                'as' => 'delete_permanently',
                'uses' => 'PlaceActivityController@destroyPermanently'
            ))->middleware('dashboardPlaceActivityDeletePermanently');
        });
    });
});
