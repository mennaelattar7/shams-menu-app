<?php


use App\Http\Middleware\custom_middleware\API\Vendor\UpdatevendorData;
use App\Http\Middleware\custom_middleware\API\Vendor\UpdateVendorRatings;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\API\Vendor\Authentication\AuthController ;
use App\Http\Controllers\User\API\Vendor\BranchController;
use App\Http\Controllers\User\API\Vendor\HomeController;
use App\Http\Controllers\User\API\Vendor\LangController;
use App\Http\Controllers\User\API\Vendor\MenuCategorycontroller;
use App\Http\Controllers\User\API\Vendor\ProductController ;
use App\Http\Controllers\User\API\Vendor\VendorController;
use App\Http\Middleware\custom_middleware\API\Branch\Create as BranchCreate;
use App\Http\Middleware\custom_middleware\API\Branch\Edit as BranchEdit;
use App\Http\Middleware\custom_middleware\API\Branch\Single as BranchSingle;
use App\Http\Middleware\custom_middleware\API\Branch\Index as BranchIndex;
use App\Http\Middleware\custom_middleware\API\MenuCategory\Create as MenuCategoryCreate;
use App\Http\Middleware\custom_middleware\API\MenuCategory\Index as MenuCategoryIndex;
use App\Http\Middleware\custom_middleware\API\Branch\GetBranchFeatures as BranchGetBranchFeatures;
use App\Http\Middleware\custom_middleware\API\Branch\ToggleActivation as BranchToggleActivation;
use App\Http\Middleware\custom_middleware\API\VendorBranch__Feature\Edit as VendorBranch__FeatureEdit;
use App\Http\Middleware\custom_middleware\API\Product\MostViewed;
use App\Http\Middleware\custom_middleware\API\Vendor\GetvendorData;
use App\Http\Middleware\custom_middleware\API\Vendor\UpdatevendorSocialMedia;

Route::prefix('vendor')->name('vendor.')->group(function(){
    //Authentication Routes
    Route::prefix('auth')->name('auth.')->group(function(){
        //register routes
        Route::post('register',[AuthController::class,'register'])->name('register'); //Done
        Route::post('verify-otp-register',[AuthController::class,'verifyOtpRegister'])->name('verify_otp_register'); //Done

        //login routes
        Route::post('login',[AuthController::class,'login'])->name('login'); //Done

        //forget & reset password Routes
        Route::post('forget-password',[AuthController::class,'forgetPassword'])->name('forget_password');
        Route::post('verify-otp-forget-password',[AuthController::class,'verifyOtpForgetPassword'])->name('verify_otp_forget_password');
        Route::post('reset-password',[AuthController::class,'resetPassword'])->name('reset_password');

        Route::middleware('auth:sanctum')->group(function () {
            Route::post('logout',[AuthController::class,'logout'])->name('logout');
        });
    });
    Route::middleware('auth:sanctum')->group(function () {
        // token : 102|iguWY9qWV9grcYKN4r3B1v5hJChbWnB3EmnNE8Ie007850a9



        Route::prefix('home')->name('home.')->group(function(){
            Route::get('most-viewed-products',[HomeController::class,'mostViewedProducts'])
                 ->name('most_viewed_product')
                 ->middleware(MostViewed::class);
        });
        Route::prefix('langs')->name('lang')->group(function(){
            Route::get('/',[LangController::class,'index'])->name('index');
            Route::post('select-langs',[LangController::class,'selectLangs'])->name('create');
        });
        //branches Routes
        Route::prefix('branches')->name('branch.')->group(function(){
            Route::get('/all/{activation_status?}/{city_id?}/{district_id?}/{branch_name?}',[BranchController::class,'index'])
                 ->name('index')
                 ->middleware(BranchIndex::class); ///Final Done

            Route::post('create',[BranchController::class,'create'])
                  ->name('create')
                  ->middleware(BranchCreate::class); ///Final Done

            Route::prefix('/{branch_slug}')->group(function(){
                Route::get('/branch-data',[BranchController::class,'getBranchData'])
                        ->name('branch_data')
                        ->middleware(BranchSingle::class); // Final Done
                Route::post('/toggle-activation',[BranchController::class,'toggleActivationBranch'])
                        ->name('toggle_activation')
                        ->middleware(BranchToggleActivation::class);

                Route::put('/update-branch-data',[BranchController::class,'updateBranchData'])
                      ->name('update_branch_data')
                      ->middleware(BranchEdit::class); // Final Done

                Route::get('/features',[BranchController::class,'getBranchFeatures'])
                        ->name('get_branch_features')
                        ->middleware(BranchGetBranchFeatures::class);
            });


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
            Route::get('/my-roles-permissions',[VendorController::class,'getRolesPremissions'])->name('get_roles_premissions');

            Route::prefix('vendor-data')->name('vendor_data.')->group(function(){
                Route::get('/',[VendorController::class,'getVendorData'])
                    ->name('get')
                    ->middleware(GetvendorData::class);

                Route::post('/update',[VendorController::class,'Update'])
                    ->name('update')
                    ->middleware(UpdatevendorData::class);

                Route::post('/update-social-media',[VendorController::class,'updateSocialMedia'])
                    ->name('social_media')
                    ->middleware(UpdatevendorSocialMedia::class);

                Route::post('/update-ratings',[VendorController::class,'updateRatings'])
                    ->name('update_rating')
                    ->middleware(UpdateVendorRatings::class);



                Route::post('/update-branch-feature-activation',[VendorController::class,'updateBranchFeatureActivation'])
                    ->name('update_branch_feature_activation')
                    ->middleware(VendorBranch__FeatureEdit::class);
            });
        });



    });
});
