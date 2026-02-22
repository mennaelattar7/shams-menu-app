<?php


use App\Http\Controllers\User\API\Vendor\MenuThemeController;
use App\Http\Controllers\User\API\Vendor\OfferController;
use App\Http\Controllers\User\API\Vendor\PermissionController;
use App\Http\Middleware\custom_middleware\API\Vendor\UpdatevendorData;
use App\Http\Middleware\custom_middleware\API\Vendor\UpdateVendorRatings;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\API\Vendor\Authentication\AuthController ;
use App\Http\Controllers\User\API\Vendor\BranchController;
use App\Http\Controllers\User\API\Vendor\EmployeePositionController;
use App\Http\Controllers\User\API\Vendor\HomeController;
use App\Http\Controllers\User\API\Vendor\LangController;
use App\Http\Controllers\User\API\Vendor\MenuCategorycontroller;
use App\Http\Controllers\User\API\Vendor\MenuDesignSettingController;
use App\Http\Controllers\User\API\Vendor\ProductController ;
use App\Http\Controllers\User\API\Vendor\TableRequestController;
use App\Http\Controllers\User\API\Vendor\UserController;
use App\Http\Controllers\User\API\Vendor\VendorController;

use App\Http\Middleware\custom_middleware\API\Branch\Create as BranchCreate;
use App\Http\Middleware\custom_middleware\API\Branch\Edit as BranchEdit;
use App\Http\Middleware\custom_middleware\API\Branch\Single as BranchSingle;
use App\Http\Middleware\custom_middleware\API\Branch\Index as BranchIndex;
use App\Http\Middleware\custom_middleware\API\Branch\GetBranchFeatures as BranchGetBranchFeatures;
use App\Http\Middleware\custom_middleware\API\Branch\GetCategories as BranchGetCategories;
use App\Http\Middleware\custom_middleware\API\Branch\GetProducts as BranchGetProducts;
use App\Http\Middleware\custom_middleware\API\Branch\GetTableRequest as BranchGetTableRequest;
use App\Http\Middleware\custom_middleware\API\Branch\ToggleActivation as BranchToggleActivation;

use App\Http\Middleware\custom_middleware\API\MenuCategory\Create as MenuCategoryCreate;
use App\Http\Middleware\custom_middleware\API\MenuCategory\Index as MenuCategoryIndex;
use App\Http\Middleware\custom_middleware\API\MenuCategory\Single as MenuCategorySingle;
use App\Http\Middleware\custom_middleware\API\MenuCategory\Edit as MenuCategoryEdit;
use App\Http\Middleware\custom_middleware\API\MenuCategory\ToggleActivation as MenuCategoryToggleActivation;

use App\Http\Middleware\custom_middleware\API\Product\Index as ProductIndex;
use App\Http\Middleware\custom_middleware\API\Product\Create as ProductCreate;
use App\Http\Middleware\custom_middleware\API\Product\Single as ProductSingle;
use App\Http\Middleware\custom_middleware\API\Product\DeletePermanently as ProductDeletePermanently;
use App\Http\Middleware\custom_middleware\API\Product\Edit as ProductEdit;
use App\Http\Middleware\custom_middleware\API\Product\ToggleAvailability as ProductToggleAvailability;
use App\Http\Middleware\custom_middleware\API\Product\ToggleActivation as ProductToggleActivation;
use App\Http\Middleware\custom_middleware\API\Product\MostViewed;

use App\Http\Middleware\custom_middleware\API\VendorBranch__Feature\Edit as VendorBranch__FeatureEdit;

use App\Http\Middleware\custom_middleware\API\Vendor\GetvendorData;
use App\Http\Middleware\custom_middleware\API\Vendor\UpdatevendorSocialMedia;

use App\Http\Middleware\custom_middleware\API\TableRequest\Respond as TableRequestRespond;
use App\Http\Middleware\custom_middleware\API\TableRequest\Single as TableRequestSingle;

use App\Http\Middleware\custom_middleware\API\VendorBranch__Offer\Create as VendorBranch__OfferCreate;
use App\Http\Middleware\custom_middleware\API\VendorBranch__Offer\Index as VendorBranch__OfferIndex;
use App\Http\Middleware\custom_middleware\API\VendorBranch__Offer\Single as VendorBranch__OfferSingle;

use App\Http\Middleware\custom_middleware\API\Vendor__EmployeePosition\Create as Vendor__EmployeePositionCreate;
use App\Http\Middleware\custom_middleware\API\Vendor__EmployeePosition\Index as Vendor__EmployeePositionIndex;

use App\Http\Middleware\custom_middleware\API\Vendor__MenuTheme\Edit as Vendor__MenuThemeEdit;


use App\Http\Middleware\custom_middleware\API\User\Create as UserCreate;
use App\Http\Middleware\custom_middleware\API\User\Index as UserIndex;


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
        // token : 124|oBVpITzn5xkseXeBx0NKDs1JpRAWxUlwbreYPZt4c50f154b
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
                 ->middleware(BranchIndex::class);

            Route::post('create',[BranchController::class,'create'])
                  ->name('create')
                  ->middleware(BranchCreate::class);

            Route::post('/categories/by-branches/{category_type?}',[BranchController::class,'getCategoriesByBranches'])
                ->name('categories.by_branches')
                ->middleware(BranchGetCategories::class);

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

                Route::get('/categories/{category_type?}',[BranchController::class,'getCategories'])
                      ->name('categories')
                      ->middleware(BranchGetCategories::class);

                Route::get('/products/{availability_status?}',[BranchController::class,'getProducts'])
                      ->name('products')
                      ->middleware(BranchGetProducts::class);

                Route::get('/table_requests',[BranchController::class,'getTableRequests'])
                      ->name('table_requests')
                      ->middleware(BranchGetTableRequest::class);

            });
        });
        //menu categories
        Route::prefix('menu-categories')->name('menu_category.')->group(function(){
            Route::get('/',[MenuCategorycontroller::class,'index'])
                ->name('index')
                ->middleware(MenuCategoryIndex::class);

            Route::post('create',[MenuCategorycontroller::class,'create'])
                 ->name('create')
                 ->middleware(MenuCategoryCreate::class);

            Route::prefix('/{category_slug}')->group(function(){
                Route::get('/',[MenuCategorycontroller::class,'single'])
                    ->name('single')
                    ->middleware(MenuCategorySingle::class);

                Route::post('/update',[MenuCategorycontroller::class,'update'])
                    ->name('update')
                    ->middleware(MenuCategoryEdit::class);

                Route::post('/toggle-activation',[MenuCategorycontroller::class,'toggleActivation'])
                        ->name('toggle_activation')
                        ->middleware(MenuCategoryToggleActivation::class);

                Route::get('/sub-categories',[MenuCategorycontroller::class,'getSubCategories'])
                    ->name('sub_categories')
                    ->middleware(MenuCategoryIndex::class);

                Route::get('/products',[MenuCategorycontroller::class,'getProducts'])
                    ->name('products')
                    ->middleware(MenuCategoryIndex::class);
            });
        });
        //Product Routes
        Route::prefix('products')->name('product.')->group(function(){
            Route::get('/',[ProductController::class,'index'])
                 ->name('index')
                 ->middleware(ProductIndex::class);

            Route::post('create',[ProductController::class,'create'])
                  ->name('create')
                  ->middleware(ProductCreate::class);

            Route::prefix('/{product_slug}')->group(function(){
                Route::get('/',[ProductController::class,'single'])
                    ->name('single')
                    ->middleware(ProductSingle::class);

                Route::post('/update',[ProductController::class,'update'])
                      ->name('update')
                      ->middleware(ProductEdit::class);

                Route::get('/delete-permanently',[ProductController::class,'deletePermanently'])
                    ->name('delete_permanently')
                    ->middleware(ProductDeletePermanently::class);

                Route::post('/toggle-availability/{branch_slug}',[ProductController::class,'toggleAvailability'])
                        ->name('toggle_availability')
                        ->middleware(ProductToggleAvailability::class);

                Route::post('/toggle-activation',[ProductController::class,'toggleActivation'])
                        ->name('toggle_activation')
                        ->middleware(ProductToggleActivation::class);

            });
        });
        //Table Request Routes
        Route::prefix('table-requests')->name('table_request.')->group(function(){
            Route::prefix('/{request_id}')->group(function(){
                Route::post('/respond',[TableRequestController::class,'respond'])
                    ->name('respond')
                    ->middleware(TableRequestRespond::class);

                Route::get('/',[TableRequestController::class,'single'])
                    ->name('single')
                    ->middleware(TableRequestSingle::class);

            });
        });

        //Offer Routes
        Route::prefix('offers')->name('offer.')->group(function(){
            Route::post('create',[OfferController::class,'create'])
                  ->name('create')
                  ->middleware(VendorBranch__OfferCreate::class);

            Route::get('/',[OfferController::class,'index'])
                  ->name('index')
                  ->middleware(VendorBranch__OfferIndex::class);

            Route::prefix('/{offer_slug}')->group(function(){
                Route::get('/',[OfferController::class,'single'])
                    ->name('single')
                    ->middleware(VendorBranch__OfferSingle::class);
            });
        });

        Route::prefix('employee_positions')->name('employee_position.')->group(function(){
            Route::post('create',[EmployeePositionController::class,'create'])
                  ->name('create')
                  ->middleware(Vendor__EmployeePositionCreate::class);

            Route::get('/',[EmployeePositionController::class,'index'])
                  ->name('index')
                  ->middleware(Vendor__EmployeePositionIndex::class);

        });

        Route::prefix('permissions')->name('permission.')->group(function(){
            Route::get('/',[PermissionController::class,'index'])
                  ->name('index');
        });

        Route::prefix('users')->name('user.')->group(function(){
            Route::get('/',[UserController::class,'index'])
                  ->name('index')
                  ->middleware(UserIndex::class);

            Route::post('create',[UserController::class,'create'])
                  ->name('create')
                  ->middleware(UserCreate::class); //new
        });

        Route::prefix('menu_themes')->name('user.')->group(function(){
            Route::post('/{vendor_slug}/update',[MenuThemeController::class,'update'])
                  ->name('update')
                  ->middleware(Vendor__MenuThemeEdit::class);
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
