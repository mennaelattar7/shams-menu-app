<?php

use App\Http\Controllers\User\API\Auth\AuthController ;
use App\Http\Controllers\User\API\Meta\CityController;
use App\Http\Controllers\User\API\Meta\CountryController;
use App\Http\Controllers\User\API\Meta\LangController;
use App\Http\Controllers\User\API\Meta\ProductTypeController;
use App\Http\Controllers\User\API\Meta\ShamsFeatureController;
use App\Http\Controllers\User\API\Meta\SocialMediaIconController;
use App\Http\Controllers\User\API\Meta\VendorTypeController;
use App\Http\Controllers\User\API\ProductController;
use App\Http\Controllers\User\API\Vendor\Authentication\AuthController as VendorAuthController;
use App\Http\Controllers\User\API\Vendor\BranchController;
use App\Http\Controllers\User\API\Vendor\MenuCategorycontroller;
use App\Http\Controllers\User\API\Vendor\Vendorcontroller as VendorVendorcontroller;
use App\Http\Controllers\User\API\VendorBranchController;
use App\Http\Controllers\User\API\VendorController;
use App\Http\Controllers\User\API\VendorMenuCategoryController;
use App\Models\Product__Type;
use App\Models\SocialMediaIcon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Notes :
//token : "7|dOp5sLtxdPkWUW117htvKKFf9u2O1Tx2goCfosmq5595c5b8",

Route::group([
	'prefix'=>'{locale}',
	'where'=>['locale'=>'[a-zA-Z]{2}'],
	'middleware' => ['setlocale','api.key'],
],function(){
    Route::prefix('user')->name('user.api.')->group(function(){
        //vendor Routes
        Route::prefix('vendor')->name('vendor.')->group(function(){
            //Authentication Routes
            Route::prefix('auth')->name('auth.')->group(function(){
                Route::post('register',[VendorAuthController::class,'register'])->name('register');
                Route::post('verify-otp-register',[VendorAuthController::class,'verifyOtpRegister'])->name('verify_otp_register');
                Route::post('login',[VendorAuthController::class,'login'])->name('login');
            });
            Route::middleware('auth:sanctum')->group(function () {
                Route::post('logout',[VendorAuthController::class,'logout'])->name('logout');

                // Route::get('{slug}',[VendorVendorcontroller::class,'vendor_data'])->name('vendor_data');
                //Home Routes
                Route::prefix('home')->name('home')->group(function(){

                });
                //branches Routes
                Route::prefix('branches')->name('branch')->group(function(){
                    Route::post('create',[BranchController::class,'create'])->name('create');
                });
                Route::prefix('menu-categories')->name('menu_category')->group(function(){
                    Route::post('create',[MenuCategorycontroller::class,'create'])->name('create');
                    
                });
            });
        });





        Route::prefix('meta')->name('meta.')->group(function(){
            Route::get('cities',[CityController::class, 'index'])->name('city.index');
            Route::get('langs',[LangController::class, 'index'])->name('lang.index.');
            Route::get('social-media-icons',[SocialMediaIconController::class, 'index'])->name('social_media_icon.index.');
            Route::get('vendor-types',[VendorTypeController::class, 'allItems'])->name('vendor_type.index.');
            Route::get('shams-features',[ShamsFeatureController::class, 'allItems'])->name('shams_feature.index.');
            Route::get('dial-code-countries',[VendorTypeController::class, 'allItems'])->name('country.getDialCodeCountries.');
            Route::get('product-types',[ProductTypeController::class, 'allItems'])->name('product_type.index.');
        });
        Route::prefix('branches')->name('branch.')->group(function(){
            Route::get('/{branch_id}',[VendorBranchController::class,'getBranchData'])->name('getBranchData.');
        });
        Route::prefix('vendors')->name('vendor.')->group(function(){
            Route::get('/{slug}',[VendorController::class,'getVendorData'])->name('getVendorData.');
            Route::get('/{slug}/menu-categories',[VendorController::class,'getVendorMenuCategories'])->name('VendorMenuCategories');
            Route::get('/{slug}/branches',[VendorController::class,'getVendorMenuCategories'])->name('VendorMenuCategories');
        });
        Route::prefix('categories')->name('category.')->group(function(){
            Route::get('/{slug}/products',[VendorMenuCategoryController::class,'products'])->name('products');
        });
        Route::prefix('products')->name('product.')->group(function(){
            Route::get('/{slug}',[ProductController::class,'product'])->name('products');
        });
        Route::prefix('auth')
              ->name('api.auth.')
              ->group(function(){
                    //Register Routes
                    Route::post('register',[AuthController::class,'register'])
                         ->name('register'); //Done
                    Route::post('verify-otp-register', [AuthController::class, 'verifyOtpRegister'])
                         ->name('verifyOtpRegister'); //Done

                    Route::post('login',[AuthController::class,'login'])
                         ->name('login');

                    Route::post('resend-otp-register', [AuthController::class, 'resendOtpRegister'])
                         ->name('resendOtpRegister');
        });

        Route::middleware('auth:sanctum')->group(function () {
            Route::post('logout',[AuthController::class,'logout'])
                ->name('logout');
            Route::get('profile', function (Request $request) {
                return $request->user();
            });
        });
    });
});




Route::prefix('vendors')->name('vendors.')->group(function(){
    Route::post('create',array(
        'as' => 'create',
        'uses' =>'VendorController@create'
    ));
});


