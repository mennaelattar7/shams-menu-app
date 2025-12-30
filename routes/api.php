<?php

use App\Http\Controllers\User\API\Auth\AuthController ;
use App\Http\Controllers\User\API\Meta\LangController;
use App\Http\Controllers\User\API\Meta\ShamsFeatureController;
use App\Http\Controllers\User\API\Meta\SocialMediaIconController;
use App\Http\Controllers\User\API\Meta\VendorTypeController;
use App\Http\Controllers\User\API\VendorBranchController;
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
    Route::prefix('user')->name('user.')->group(function(){
        Route::prefix('meta')->name('meta.')->group(function(){
            Route::get('langs',[LangController::class, 'index'])->name('lang.index');
            Route::get('social-media-icons',[SocialMediaIconController::class, 'index'])->name('social_media_icon.index');
            Route::get('vendor-types',[VendorTypeController::class, 'allItems'])->name('vendor_type.index');
            Route::get('shams-features',[ShamsFeatureController::class, 'allItems'])->name('shams_feature.index');
            Route::get('dial-code-countries',[VendorTypeController::class, 'allItems'])->name('country.getDialCodeCountries');
        });
        Route::prefix('branches')->name('branch')->group(function(){
            Route::get('/{branch_id}',[VendorBranchController::class,'getBranchData'])->name('getBranchData');
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


// Route::post('/register',[AuthController::class,'register']);
// Route::post('/login',[AuthController::class,'login']);

// Route::middleware('auth:sanctum')->post('/logout',[AuthController::class,'logout']);


// Route::middleware('auth:sanctum')->get('/profile', function (Request $request) {
//     return $request->user();
// });



