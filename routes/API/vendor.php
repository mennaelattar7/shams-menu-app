<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\API\Vendor\Authentication\AuthController ;
use App\Http\Controllers\User\API\Vendor\BranchController;
use App\Http\Controllers\User\API\Vendor\LangController;
use App\Http\Controllers\User\API\Vendor\MenuCategorycontroller;
use App\Http\Controllers\User\API\Vendor\ProductController ;

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
        // token : 82|p5wV6kKVgE2KQFtuxXU7BZBjy7XMzFMlLEbcd4sed24bf75b

        Route::prefix('home')->name('home')->group(function(){

        });
        Route::prefix('langs')->name('lang')->group(function(){
            Route::get('/',[LangController::class,'index'])->name('index'); //Done Doc
            Route::post('select-langs',[LangController::class,'selectLangs'])->name('create'); //Done Doc
        });
        //branches Routes
        Route::prefix('branches')->name('branch.')->group(function(){
            Route::get('/',[BranchController::class,'index'])->name('index');
            Route::post('create',[BranchController::class,'create'])->name('create');
            Route::get('/filter',[BranchController::class,'filter'])->name('filter');
            Route::get('{slug}',[BranchController::class,'single'])->name('single');
            Route::put('{slug}',[BranchController::class,'update'])->name('update');
        });
        //menu categories
        Route::prefix('menu-categories')->name('menu_category.')->group(function(){
            Route::get('/',[MenuCategorycontroller::class,'index'])->name('index');
            Route::post('create',[MenuCategorycontroller::class,'create'])->name('create');
        });
        //Product Routes
        Route::prefix('products')->name('product.')->group(function(){
            Route::get('/',[ProductController::class,'index'])->name('index');
            Route::post('create',[ProductController::class,'create'])->name('create');
        });
    });
});
