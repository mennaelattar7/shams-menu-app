<?php

use App\Http\Controllers\User\API\Auth\AuthController ;
use App\Http\Controllers\User\API\Meta\CityController;
use App\Http\Controllers\User\API\Meta\CountryController;
use App\Http\Controllers\User\API\Meta\DistrictController;
use App\Http\Controllers\User\API\Meta\LangController;
use App\Http\Controllers\User\API\Meta\ProductTypeController;
use App\Http\Controllers\User\API\Meta\ShamsFeatureController;
use App\Http\Controllers\User\API\Meta\SocialMediaIconController;
use App\Http\Controllers\User\API\Meta\VendorTypeController;
use App\Http\Controllers\User\API\ProductController;
use App\Http\Controllers\User\API\Vendor\Authentication\AuthController as VendorAuthController;
use App\Http\Controllers\User\API\Vendor\BranchController;
use App\Http\Controllers\User\API\Vendor\LangController as VendorLangController;
use App\Http\Controllers\User\API\Vendor\MenuCategorycontroller;
use App\Http\Controllers\User\API\Vendor\Vendorcontroller as VendorVendorcontroller;

use App\Http\Controllers\User\API\VendorController;
use App\Http\Controllers\User\API\VendorMenuCategoryController;
use App\Models\Lang;
use App\Models\Shams__ProductType;
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
        require __DIR__.'/API/meta.php';

        //vendor Routes
        require __DIR__.'/API/vendor.php';

        //customer
        require __DIR__.'/API/customer.php';


        // Route::prefix('branches')->name('branch.')->group(function(){
        //     Route::get('/{branch_id}',[VendorBranchController::class,'getBranchData'])->name('getBranchData.');
        // });
        // Route::prefix('vendors')->name('vendor.')->group(function(){
        //     Route::get('/{slug}',[VendorController::class,'getVendorData'])->name('getVendorData.');
        //     Route::get('/{slug}/menu-categories',[VendorController::class,'getVendorMenuCategories'])->name('VendorMenuCategories');
        //     Route::get('/{slug}/branches',[VendorController::class,'getVendorMenuCategories'])->name('VendorMenuCategories');
        // });
        // Route::prefix('categories')->name('category.')->group(function(){
        //     Route::get('/{slug}/products',[VendorMenuCategoryController::class,'products'])->name('products');
        // });
        // Route::prefix('products')->name('product.')->group(function(){
        //     Route::get('/{slug}',[ProductController::class,'product'])->name('products');
        // });
        // Route::prefix('auth')
        //       ->name('api.auth.')
        //       ->group(function(){
        //             //Register Routes
        //             Route::post('register',[AuthController::class,'register'])
        //                  ->name('register'); //Done
        //             Route::post('verify-otp-register', [AuthController::class, 'verifyOtpRegister'])
        //                  ->name('verifyOtpRegister'); //Done

        //             Route::post('login',[AuthController::class,'login'])
        //                  ->name('login');

        //             Route::post('resend-otp-register', [AuthController::class, 'resendOtpRegister'])
        //                  ->name('resendOtpRegister');
        // });

        // Route::middleware('auth:sanctum')->group(function () {
        //     Route::post('logout',[AuthController::class,'logout'])
        //         ->name('logout');
        //     Route::get('profile', function (Request $request) {
        //         return $request->user();
        //     });
        // });
    });
});




Route::prefix('vendors')->name('vendors.')->group(function(){
    Route::post('create',array(
        'as' => 'create',
        'uses' =>'VendorController@create'
    ));
});


