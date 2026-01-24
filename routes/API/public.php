<?php

use App\Http\Controllers\User\API\Public\BranchController;
use App\Http\Controllers\User\API\Public\ProductController;
use App\Http\Controllers\User\API\Public\VendorController;
use Illuminate\Support\Facades\Route;

Route::prefix('public')->name('public.')->group(function(){
    //get branch data
    Route::prefix('branches')->name('branch.')->group(function(){
        Route::get('/{branch_slug}',[BranchController::class,'getBranchData'])->name('get_branch_data');
        Route::get('/{branch_slug}/vendor-data',[VendorController::class,'getVendorData'])->name('get_vendor_data');
    });




    Route::prefix('products')->name('product.')->group(function(){
        Route::get('/{branch_slug}',[ProductController::class,'single'])->name('single');
    });
    Route::middleware('auth:sanctum')->group(function () {
        Route::prefix('home')->name('home')->group(function(){

        });

    });
});
