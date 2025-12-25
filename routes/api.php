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

Route::group([
	'prefix'=>'{locale}',
	'where'=>['locale'=>'[a-zA-Z]{2}'],
	'middleware' => ['setlocale'],
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
        Route::prefix('auth')->name('auth')->group(function(){
            Route::post('register',[AuthController::class,'register']);
            Route::post('login',[AuthController::class,'login']);
            Route::post('verify-otp-register', [AuthController::class, 'verifyOtpRegister']);
            Route::post('resend-otp-register', [AuthController::class, 'resendOtpRegister']);
        });









        // token -> 6|Ffjt4ZWv351t8Wf13auwnu5yjtNT4afSz9w7TMmT9decbf69
/**
 * @OA\Get(
 *     path="/api/profile",
 *     operationId="getProfile",
 *     tags={"User"},
 *     summary="Get authenticated user profile",
 *     description="Returns the currently authenticated user using Sanctum token",
 *     security={{"sanctum":{}}},
 *
 *     @OA\Response(
 *         response=200,
 *         description="Successful response",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="name", type="string", example="Menna"),
 *             @OA\Property(property="email", type="string", example="menna@test.com"),
 *             @OA\Property(property="created_at", type="string", example="2025-01-01 10:00:00")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Unauthenticated"
 *     )
 * )
 */
        Route::middleware('auth:sanctum')->group(function () {

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



