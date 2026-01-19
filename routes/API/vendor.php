<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\API\Vendor\Authentication\AuthController as Vendor_AuthController ;
use App\Http\Controllers\User\API\Vendor\BranchController as Vendor_BranchController;
use App\Http\Controllers\User\API\Vendor\LangController as Vendor_LangController;
use App\Http\Controllers\User\API\Vendor\MenuCategorycontroller as Vendor_MenuCategorycontroller;
use App\Http\Controllers\User\API\Vendor\ProductController as Vendor_ProductController;

Route::prefix('vendor')->name('vendor.')->group(function(){
    //Authentication Routes
    Route::prefix('auth')->name('auth.')->group(function(){
        //register routes
        Route::post('register',[Vendor_AuthController::class,'register'])->name('register');
        Route::post('verify-otp-register',[Vendor_AuthController::class,'verifyOtpRegister'])->name('verify_otp_register');

        //login routes
        Route::post('login',[Vendor_AuthController::class,'login'])->name('login');

        //forget & reset password Routes
        Route::post('forget-password',[Vendor_AuthController::class,'forgetPassword'])->name('forget_password');
        Route::post('verify-otp-forget-password',[Vendor_AuthController::class,'verifyOtpForgetPassword'])->name('verify_otp_forget_password');
        Route::post('reset-password',[Vendor_AuthController::class,'resetPassword'])->name('reset_password');
    });
    Route::middleware('auth:sanctum')->group(function () {
        // token : 82|p5wV6kKVgE2KQFtuxXU7BZBjy7XMzFMlLEbcd4sed24bf75b
        Route::post('logout',[Vendor_AuthController::class,'logout'])->name('logout');
        Route::prefix('home')->name('home')->group(function(){

        });
        Route::prefix('langs')->name('lang')->group(function(){
            Route::get('/',[Vendor_LangController::class,'index'])->name('index'); //Done Doc
            Route::post('select-langs',[Vendor_LangController::class,'selectLangs'])->name('create'); //Done Doc
        });
        //branches Routes
        Route::prefix('branches')->name('branch.')->group(function(){
            Route::get('/',[Vendor_BranchController::class,'index'])->name('index');
            Route::post('create',[Vendor_BranchController::class,'create'])->name('create');
            Route::get('/filter',[Vendor_BranchController::class,'filter'])->name('filter');
            Route::get('{slug}',[Vendor_BranchController::class,'single'])->name('single');
            Route::put('{slug}',[Vendor_BranchController::class,'update'])->name('update');
        });
        //menu categories
        Route::prefix('menu-categories')->name('menu_category.')->group(function(){
            Route::get('/',[Vendor_MenuCategorycontroller::class,'index'])->name('index');
            Route::post('create',[Vendor_MenuCategorycontroller::class,'create'])->name('create');
        });
        //Product Routes
        Route::prefix('products')->name('Product.')->group(function(){
            Route::post('create',[Vendor_ProductController::class,'create'])->name('create');
        });
    });
});
