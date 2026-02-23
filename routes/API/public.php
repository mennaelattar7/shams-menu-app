<?php

use App\Http\Controllers\User\API\Public\Authentication\AuthController;
use App\Http\Controllers\User\API\Public\BranchController;
use App\Http\Controllers\User\API\Public\CustomerFavouriteController;
use App\Http\Controllers\User\API\Public\MenuCategoryController;
use App\Http\Controllers\User\API\Public\ProductController;
use App\Http\Controllers\User\API\Public\ReviewController;
use App\Http\Controllers\User\API\Public\TableRequestController;
use App\Http\Controllers\User\API\Public\VendorController;
use App\Http\Middleware\custom_middleware\API\OptionalSanctumAuth;
use Illuminate\Support\Facades\Route;

Route::prefix('public')->name('public.')->group(function(){

//customer Token 89|MdUUO2UBIoqYBl0gmUsYxQ3zGMndrHm5C1b4AxaN655afc86
    //Authentication Routes
    Route::prefix('auth')->name('auth.')->group(function(){
        //login routes
        Route::post('login',[AuthController::class,'login'])->name('login');
        Route::post('verify-otp',[AuthController::class,'verifyOtpLogin'])->name('verify_otp_login');

        Route::middleware('auth:sanctum')->group(function () {
            Route::post('logout',[AuthController::class,'logout'])->name('logout');
        });
    });

    //get branch data
    Route::prefix('branches')->name('branch.')->group(function(){
        Route::prefix('/{branch_slug}')->group(function(){
            Route::get('/',[BranchController::class,'getBranchData'])->name('get_branch_data');
            Route::get('/vendor-data',[VendorController::class,'getVendorData'])->name('get_vendor_data');
            Route::get('/menu-categories',[MenuCategoryController::class,'getMenuCategories'])->name('getMenuCategories');
            Route::get('/tables',[BranchController::class,'getBranchTables'])->name('get_branch_table');
            Route::get('/features',[BranchController::class,'getFeatures'])->name('get_features');
            Route::get('/menu_theme',[BranchController::class,'getMenuTheme'])->name('get_menu_theme');
            Route::get('/social_media',[BranchController::class,'getSocialMedia'])->name('get_social_media');
        });
    });

    //get categories data
    Route::prefix('menu-categories')->name('menu_category.')->group(function(){
        Route::get('/{category_slug}/products',[ProductController::class,'getProducts'])->name('get_products');
    });

    Route::prefix('products')->name('product.')->group(function(){
        Route::get('/{branch_slug}',[ProductController::class,'single'])->name('single');
    });

    //Route in Auth and No Auth
    Route::middleware(OptionalSanctumAuth::class)->group(function () {
        Route::prefix('table-requests')->name('table_request.')->group(function(){
            Route::post('/send-request',[TableRequestController::class,'sendRequest'])->name('send_request');
        });
        Route::prefix('branches')->name('branch.')->group(function(){
            Route::prefix('/{branch_slug}')->group(function(){
                Route::get('/products',[BranchController::class,'getProducts'])->name('get_products');

                Route::prefix('reviews')->name('review.')->group(function(){
                    Route::post('/add-review',[ReviewController::class,'addReview'])->name('add_review');
                });
            });
        });



    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::prefix('customers')->name('customer.')->group(function(){
            Route::post('/{branch_slug}/add-to-favourite',[CustomerFavouriteController::class,'addToFavourite'])
                 ->name('add_to_favourite');

            Route::get('/{branch_slug}/get-favourite-products',[CustomerFavouriteController::class,'getFavouriteProducts'])
                 ->name('get_favourite_products');
        });
    });
});
