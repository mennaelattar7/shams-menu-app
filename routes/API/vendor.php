<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\API\Vendor\Authentication\AuthController ;
use App\Http\Controllers\User\API\Vendor\BranchController;
use App\Http\Controllers\User\API\Vendor\HomeController;
use App\Http\Controllers\User\API\Vendor\LangController;
use App\Http\Controllers\User\API\Vendor\MenuCategorycontroller;
use App\Http\Controllers\User\API\Vendor\ProductController ;
use App\Http\Controllers\User\API\Vendor\VendorController;
use App\Http\Middleware\custom_middleware\API\Branch\Create as BranchCreate;
use App\Http\Middleware\custom_middleware\API\Branch\Index as BranchIndex;
use App\Http\Middleware\custom_middleware\API\MenuCategory\Create as MenuCategoryCreate;
use App\Http\Middleware\custom_middleware\API\MenuCategory\Index as MenuCategoryIndex;
use App\Http\Middleware\custom_middleware\API\Product\MostViewed;
use App\Http\Middleware\custom_middleware\API\Vendor\GetvendorData;

Route::prefix('vendor')->name('vendor.')->group(function(){
    //Authentication Routes
    Route::prefix('auth')->name('auth.')->group(function(){
        //register routes
        Route::post('register',[AuthController::class,'register'])->name('register');
        Route::post('verify-otp-register',[AuthController::class,'verifyOtpRegister'])->name('verify_otp_register');

        //login routes
        Route::post('login',[AuthController::class,'login'])->name('login');

        //forget & reset password Routes
        Route::post('forget-password',[AuthController::class,'forgetPassword'])->name('forget_password');
        Route::post('verify-otp-forget-password',[AuthController::class,'verifyOtpForgetPassword'])->name('verify_otp_forget_password');
        Route::post('reset-password',[AuthController::class,'resetPassword'])->name('reset_password');

        Route::middleware('auth:sanctum')->group(function () {
            Route::post('logout',[AuthController::class,'logout'])->name('logout');
        });
    });
    Route::middleware('auth:sanctum')->group(function () {
        // token : 87|3ox1wItqdyLVOmtHmMPcLXaW3yEqbIFS95XbrjQv8a545142

        Route::prefix('home')->name('home.')->group(function(){
            Route::get('most-viewed-products',[HomeController::class,'mostViewedProducts'])
                 ->name('most_viewed_product')
                 ->middleware(MostViewed::class); ///final Done
        });
        Route::prefix('langs')->name('lang')->group(function(){
            Route::get('/',[LangController::class,'index'])->name('index');
            Route::post('select-langs',[LangController::class,'selectLangs'])->name('create');
        });
        //branches Routes
        Route::prefix('branches')->name('branch.')->group(function(){
            Route::get('/{activation_status?}{city_id?}/{district_id?}/{branch_name?}',[BranchController::class,'index'])
                 ->name('index')
                 ->middleware(BranchIndex::class); ///Final Done

            Route::post('create',[BranchController::class,'create'])
                  ->name('create')
                  ->middleware(BranchCreate::class); ///Final Done

            Route::get('{slug}',[BranchController::class,'single'])->name('single');
            Route::put('{slug}',[BranchController::class,'update'])->name('update');
        });
        //menu categories
        Route::prefix('menu-categories')->name('menu_category.')->group(function(){
            Route::get('/{activation_status?}',[MenuCategorycontroller::class,'index'])
                ->name('index')
                ->middleware(MenuCategoryIndex::class); //Final Done

            Route::post('create',[MenuCategorycontroller::class,'create'])
                 ->name('create')
                 ->middleware(MenuCategoryCreate::class); //Final Done
        });
        //Product Routes
        Route::prefix('products')->name('product.')->group(function(){
            Route::get('/',[ProductController::class,'index'])->name('index');
            Route::post('create',[ProductController::class,'create'])->name('create');
        });
        //Settings Routes
        Route::prefix('settings')->name('setting.')->group(function(){
            Route::get('/vendor-data',[VendorController::class,'getVendorData'])
                 ->name('vendor_data')
                 ->middleware(GetvendorData::class);
        });



    });
});
