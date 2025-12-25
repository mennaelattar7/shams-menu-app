<?php
use Illuminate\Support\Facades\Route;

Route::prefix('store-dashboard')->name('store_dashboard.')->group(function(){
    Route::group(['namespace' => 'Store_Dashboard'], function () {
        //-----------------------Start Home Routes--------------------------
        Route::prefix('home')->name('home.')->group(function () {
            Route::get('/', array(
                'as' => 'index',
                'uses' => 'HomeController@index'
            ));
        });
        //------------------------Start store_home_sliders Routes----------------------
        Route::prefix('store___home_sliders')->name('store___home_slider.')->group(function () {
            Route::get('/', array(
                'as' => 'index',
                'uses' => 'HomeSliderController@index'
            ))->middleware('dashboardHomeSliderIndex');

            Route::get('/archived', array(
                'as' => 'archived',
                'uses' => 'HomeSliderController@archived'
            ))->middleware('dashboardHomeSliderArchived');

            Route::get('/create', array(
                'as' => 'create',
                'uses' => 'HomeSliderController@create'
            ))->middleware('dashboardHomeSliderCreate');

            Route::post('/store', array(
                        'as' => 'store',
                        'uses' => 'HomeSliderController@store'
            ))->middleware('dashboardHomeSliderCreate');

            Route::get('/show/{store___home_slider}', array(
                        'as' => 'show',
                        'uses' => 'HomeSliderController@show'
            ))->middleware('dashboardHomeSliderShow');

            Route::get('/edit/{store___home_slider}', array(
                        'as' => 'edit',
                        'uses' => 'HomeSliderController@edit'
            ))->middleware('dashboardHomeSliderEdit');

            Route::put('/edit/{store___home_slider}', array(
                        'as' => 'update',
                        'uses' => 'HomeSliderController@update'
            ))->middleware('dashboardHomeSliderEdit');

            Route::get('/delete/{store___home_slider}', array(
                'as' => 'delete',
                'uses' => 'HomeSliderController@destroy'
            ))->middleware('dashboardHomeSliderDelete');

            Route::get('/restore/{store___home_slider}', array(
                'as' => 'restore',
                'uses' => 'HomeSliderController@restore'
            ))->middleware('dashboardHomeSliderRestore');

            Route::get('/delete-permanently/{store___home_slider}', array(
                'as' => 'delete_permanently',
                'uses' => 'HomeSliderController@destroyPermanently'
            ))->middleware('dashboardHomeSliderDeletePermanently');
        });

        //------------------------Start warranty_types Routes----------------------
        Route::prefix('warranty_types')->name('warranty_type.')->group(function () {
            Route::get('/', array(
                'as' => 'index',
                'uses' => 'WarrantyTypeController@index'
            ))->middleware('dashboardWarrantyTypeIndex');

            Route::get('/archived', array(
                'as' => 'archived',
                'uses' => 'WarrantyTypeController@archived'
            ))->middleware('dashboardWarrantyTypeArchived');

            Route::get('/create', array(
                'as' => 'create',
                'uses' => 'WarrantyTypeController@create'
            ))->middleware('dashboardWarrantyTypeCreate');

            Route::post('/store', array(
                        'as' => 'store',
                        'uses' => 'WarrantyTypeController@store'
            ))->middleware('dashboardWarrantyTypeCreate');

            Route::get('/show/{warranty_type}', array(
                        'as' => 'show',
                        'uses' => 'WarrantyTypeController@show'
            ))->middleware('dashboardWarrantyTypeShow');

            Route::get('/edit/{warranty_type}', array(
                        'as' => 'edit',
                        'uses' => 'WarrantyTypeController@edit'
            ))->middleware('dashboardWarrantyTypeEdit');

            Route::put('/edit/{warranty_type}', array(
                        'as' => 'update',
                        'uses' => 'WarrantyTypeController@update'
            ))->middleware('dashboardWarrantyTypeEdit');

            Route::get('/delete/{warranty_type}', array(
                'as' => 'delete',
                'uses' => 'WarrantyTypeController@destroy'
            ))->middleware('dashboardWarrantyTypeDelete');

            Route::get('/restore/{warranty_type}', array(
                'as' => 'restore',
                'uses' => 'WarrantyTypeController@restore'
            ))->middleware('dashboardWarrantyTypeRestore');

            Route::get('/delete-permanently/{warranty_type}', array(
                'as' => 'delete_permanently',
                'uses' => 'WarrantyTypeController@destroyPermanently'
            ))->middleware('dashboardWarrantyTypeDeletePermanently');
        });

        //------------------------Start features Routes----------------------
        Route::prefix('features')->name('feature.')->group(function () {
            Route::get('/', array(
                'as' => 'index',
                'uses' => 'FeatureController@index'
            ))->middleware('dashboardFeatureIndex');

            Route::get('/archived', array(
                'as' => 'archived',
                'uses' => 'FeatureController@archived'
            ))->middleware('dashboardFeatureArchived');

            Route::get('/create', array(
                'as' => 'create',
                'uses' => 'FeatureController@create'
            ))->middleware('dashboardFeatureCreate');

            Route::post('/store', array(
                        'as' => 'store',
                        'uses' => 'FeatureController@store'
            ))->middleware('dashboardFeatureCreate');

            Route::get('/show/{feature}', array(
                        'as' => 'show',
                        'uses' => 'FeatureController@show'
            ))->middleware('dashboardFeatureShow');

            Route::get('/edit/{feature}', array(
                        'as' => 'edit',
                        'uses' => 'FeatureController@edit'
            ))->middleware('dashboardFeatureEdit');

            Route::put('/edit/{feature}', array(
                        'as' => 'update',
                        'uses' => 'FeatureController@update'
            ))->middleware('dashboardFeatureEdit');

            Route::get('/delete/{feature}', array(
                'as' => 'delete',
                'uses' => 'FeatureController@destroy'
            ))->middleware('dashboardFeatureDelete');

            Route::get('/restore/{feature}', array(
                'as' => 'restore',
                'uses' => 'FeatureController@restore'
            ))->middleware('dashboardFeatureRestore');

            Route::get('/delete-permanently/{feature}', array(
                'as' => 'delete_permanently',
                'uses' => 'FeatureController@destroyPermanently'
            ))->middleware('dashboardFeatureDeletePermanently');
        });

        //------------------------Start products Routes----------------------
        Route::prefix('products')->name('product.')->group(function () {
            Route::get('/', array(
                'as' => 'index',
                'uses' => 'ProductController@index'
            ))->middleware('dashboardProductIndex');

            Route::get('/archived', array(
                'as' => 'archived',
                'uses' => 'ProductController@archived'
            ))->middleware('dashboardProductArchived');

            Route::get('/create', array(
                'as' => 'create',
                'uses' => 'ProductController@create'
            ))->middleware('dashboardProductCreate');

            Route::post('/store', array(
                        'as' => 'store',
                        'uses' => 'ProductController@store'
            ))->middleware('dashboardProductCreate');

            Route::get('/show/{product}', array(
                        'as' => 'show',
                        'uses' => 'ProductController@show'
            ))->middleware('dashboardProductShow');

            Route::get('/edit/{product}', array(
                        'as' => 'edit',
                        'uses' => 'ProductController@edit'
            ))->middleware('dashboardProductEdit');

            Route::put('/edit/{product}', array(
                        'as' => 'update',
                        'uses' => 'ProductController@update'
            ))->middleware('dashboardProductEdit');

            Route::get('/delete/{product}', array(
                'as' => 'delete',
                'uses' => 'ProductController@destroy'
            ))->middleware('dashboardProductDelete');

            Route::get('/restore/{product}', array(
                'as' => 'restore',
                'uses' => 'ProductController@restore'
            ))->middleware('dashboardFeatureRestore');

            Route::get('/delete-permanently/{product}', array(
                'as' => 'delete_permanently',
                'uses' => 'FeatureController@destroyPermanently'
            ))->middleware('dashboardFeatureDeletePermanently');
        });

        //------------------------Start product_variants Routes----------------------
        Route::prefix('product_variants')->name('product_variant.')->group(function () {
            Route::get('/', array(
                'as' => 'index',
                'uses' => 'ProductVariantController@index'
            ))->middleware('dashboardProductVariantIndex');

            Route::get('/archived', array(
                'as' => 'archived',
                'uses' => 'ProductVariantController@archived'
            ))->middleware('dashboardProductVariantArchived');

            Route::get('/create', array(
                'as' => 'create',
                'uses' => 'ProductVariantController@create'
            ))->middleware('dashboardProductVariantCreate');

            Route::post('/store', array(
                        'as' => 'store',
                        'uses' => 'ProductVariantController@store'
            ))->middleware('dashboardProductVariantCreate');

            Route::get('/show/{product_variant}', array(
                        'as' => 'show',
                        'uses' => 'ProductVariantController@show'
            ))->middleware('dashboardProductVariantShow');

            Route::get('/edit/{product_variant}', array(
                        'as' => 'edit',
                        'uses' => 'ProductVariantController@edit'
            ))->middleware('dashboardProductVariantEdit');

            Route::put('/edit/{product_variant}', array(
                        'as' => 'update',
                        'uses' => 'ProductVariantController@update'
            ))->middleware('dashboardProductVariantEdit');

            Route::get('/delete/{product_variant}', array(
                'as' => 'delete',
                'uses' => 'ProductVariantController@destroy'
            ))->middleware('dashboardProductVariantDelete');

            Route::get('/restore/{product_variant}', array(
                'as' => 'restore',
                'uses' => 'ProductVariantController@restore'
            ))->middleware('dashboardProductVariantRestore');

            Route::get('/delete-permanently/{product_variant}', array(
                'as' => 'delete_permanently',
                'uses' => 'ProductVariantController@destroyPermanently'
            ))->middleware('dashboardProductVariantDeletePermanently');

            //---------------------Ajax
            Route::post('/upload-image/ajax', array(
                        'as' => 'upload_image.ajax',
                        'uses' => 'ProductVariantController@ajaxUploadImage'
                    ));
        });

        //------------------------Start product_variant__medias Routes----------------------
        Route::prefix('product_variant__media')->name('product_variant__media.')->group(function () {
            Route::get('/', array(
                'as' => 'index',
                'uses' => 'ProductVariant_MediaController@index'
            ))->middleware('dashboardProductVariant_MediaIndex');

            Route::get('/archived', array(
                'as' => 'archived',
                'uses' => 'ProductVariant_MediaController@archived'
            ))->middleware('dashboardProductVariant_MediaArchived');

            Route::get('/create', array(
                'as' => 'create',
                'uses' => 'ProductVariant_MediaController@create'
            ))->middleware('dashboardProductVariant_MediaCreate');

            Route::post('/store', array(
                        'as' => 'store',
                        'uses' => 'ProductVariant_MediaController@store'
            ))->middleware('dashboardProductVariant_MediaCreate');

            Route::get('/show/{product_variant__media}', array(
                        'as' => 'show',
                        'uses' => 'ProductVariant_MediaController@show'
            ))->middleware('dashboardProductVariant_MediaShow');

            Route::get('/edit/{product_variant__media}', array(
                        'as' => 'edit',
                        'uses' => 'ProductVariant_MediaController@edit'
            ))->middleware('dashboardProductVariant_MediaEdit');

            Route::put('/edit/{product_variant__media}', array(
                        'as' => 'update',
                        'uses' => 'ProductVariant_MediaController@update'
            ))->middleware('dashboardProductVariant_MediaEdit');

            Route::get('/delete/{product_variant__media}', array(
                'as' => 'delete',
                'uses' => 'ProductVariant_MediaController@destroy'
            ))->middleware('dashboardProductVariant_MediaDelete');

            Route::get('/restore/{product_variant__media}', array(
                'as' => 'restore',
                'uses' => 'ProductVariant_MediaController@restore'
            ))->middleware('dashboardProductVariant_MediaRestore');

            Route::get('/delete-permanently/{product_variant__media}', array(
                'as' => 'delete_permanently',
                'uses' => 'ProductVariant_MediaController@destroyPermanently'
            ))->middleware('dashboardProductVariant_MediaDeletePermanently');
        });
    });
});
