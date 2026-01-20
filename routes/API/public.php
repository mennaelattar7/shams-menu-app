<?php

use App\Http\Controllers\User\API\Public\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('public')->name('public.')->group(function(){
    Route::prefix('products')->name('product.')->group(function(){
        Route::get('/{slug}',[ProductController::class,'product'])->name('products');
    });
    Route::middleware('auth:sanctum')->group(function () {
        Route::prefix('home')->name('home')->group(function(){

        });

    });
});
