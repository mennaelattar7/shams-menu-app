<?php
use App\Http\Controllers\User\API\Meta\CityController;
use App\Http\Controllers\User\API\Meta\CurrencyController;
use App\Http\Controllers\User\API\Meta\DistrictController;
use App\Http\Controllers\User\API\Meta\LangController;
use App\Http\Controllers\User\API\Meta\ProductBadgeController as Meta_ProductBadgeController;
use App\Http\Controllers\User\API\Meta\ProductCookingLevelController as Meta_ProductCookingLevelController;
use App\Http\Controllers\User\API\Meta\ProductAllergenController as Meta_ProductAllergenController;
use App\Http\Controllers\User\API\Meta\ProductTypeController;
use App\Http\Controllers\User\API\Meta\ShamsFeatureController;
use App\Http\Controllers\User\API\Meta\SocialMediaIconController;
use App\Http\Controllers\User\API\Meta\VendorTypeController;

use Illuminate\Support\Facades\Route;

    Route::prefix('meta')->name('meta.')->group(function(){
        Route::prefix('cities')->name('city.')->group(function(){
            Route::get('/',[CityController::class, 'index'])->name('index'); //Done Doc
            Route::get('/filter-districts/{city_id}',[CityController::class, 'filterDistrict'])->name('filter'); //Done Doc
        });
        Route::get('districts',[DistrictController::class, 'index'])->name('district.index'); // Done Doc
        Route::get('langs',[LangController::class, 'index'])->name('lang.index.'); // Done Doc
        Route::get('currencies',[CurrencyController::class, 'index'])->name('currency.index.');

        Route::get('social-media-icons',[SocialMediaIconController::class, 'index'])->name('social_media_icon.index.');
        Route::get('vendor-types',[VendorTypeController::class, 'allItems'])->name('vendor_type.index.');
        Route::get('shams-features',[ShamsFeatureController::class, 'allItems'])->name('shams_feature.index.');
        Route::get('product-types',[ProductTypeController::class, 'allItems'])->name('product_type.index.');

        Route::prefix('product-badges')->name('product_badge.')->group(function(){
            Route::get('/',[Meta_ProductBadgeController::class,'index'])->name('index');
        });

        Route::prefix('product-allergens')->name('product_allergen.')->group(function(){
            Route::get('/',[Meta_ProductAllergenController::class,'index'])->name('index');
        });

        Route::prefix('product-cooking-levels')->name('product_cooking_level.')->group(function(){
            Route::get('/',[Meta_ProductCookingLevelController::class,'index'])->name('index');
        });

        Route::prefix('permissions')->name('permission.')->group(function(){
            Route::get('/',[Meta_ProductCookingLevelController::class,'index'])->name('index');
        });
    });
