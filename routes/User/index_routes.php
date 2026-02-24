<?php
use Illuminate\Support\Facades\Route;



Route::group(['namespace' => 'App\Http\Controllers\User'], function () {
    //-----------------------Start Authentication Routes--------------------------
    Route::group(['namespace' => 'Authentication'], function () {
        Route::name('auth.')->group(function () {
            //Registration Function
            Route::post('/register', array(
                        'as' => 'register.ajax',
                        'uses' => 'AuthController@postRegisterAjax'
            ));
            Route::group(['middleware' => 'checkAuth'],function(){
                Route::get('/verification-code', array(
                            'as' => 'verification_code',
                            'uses' => 'AuthController@getVerificationCode'
                ));
                Route::post('/verification-code', array(
                            'as' => 'verification_code',
                            'uses' => 'AuthController@postVerificationCode'
                ));
                Route::get('/change-password', array(
                            'as' => 'change_password',
                            'uses' => 'AuthController@getChangePassword'
                ));
            });
            // Login Function
            Route::post('/login', array(
                        'as' => 'login.ajax',
                        'uses' => 'AuthController@postLoginAjax'
            ));
            //Logout Function
            Route::get('/logout', array(
                        'as' => 'logout.ajax',
                        'uses' => 'AuthController@getLogoutAjax'
            ));
        });
    });
    Route::name('user.')->group(function () {
        Route::get('error-page', array(
            'as' => 'error_page.not_found_page',
            'uses' => 'ErrorPageController@notFoundPage'
        ));
        Route::get('home', array(
            'as' => 'home.index',
            'uses' => 'HomeController@index'
        ));
        Route::get('iso', array(
            'as' => 'iso.index',
            'uses' => 'GeneralPagesController@isoIndex'
        ));
        Route::get('terms-and-conditions', array(
            'as' => 'terms_and_conditions.index',
            'uses' => 'GeneralPagesController@termsAndConditionsIndex'
        ));
        Route::get('about-us', array(
            'as' => 'about_us.index',
            'uses' => 'GeneralPagesController@aboutUsIndex'
        ));
        Route::get('our-products-categories', array(
            'as' => 'our_products_categories.index',
            'uses' => 'GeneralPagesController@ourProductCategories'
        ));
        Route::prefix('store')->name('store.')->group(function(){
            Route::group(['namespace' => 'Store'], function () {
                Route::get('home', array(
                    'as' => 'home.index',
                    'uses' => 'HomeController@index'
                )); //done
                Route::prefix('products')->name('products.')->group(function(){
                    Route::get('/', array(
                        'as' => 'index',
                        'uses' => 'ProductController@index'
                    )); //done
                    Route::get('/compare', array(
                        'as' => 'compare',
                        'uses' => 'ProductController@compare'
                    )); //done
                    Route::get('/{product_variant}', array(
                        'as' => 'single_product',
                        'uses' => 'ProductController@singleProduct'
                    )); //done

                    Route::post('/quick_view/ajax', array(
                        'as' => 'quick_view.ajax',
                        'uses' => 'ProductController@quickViewAjax'
                    ));
                    Route::post('/add-to-cart/ajax', array(
                        'as' => 'add_to_cart.ajax',
                        'uses' => 'ProductController@addToCartAjax'
                    ));


                });
                Route::get('cart', array(
                    'as' => 'cart.index',
                    'uses' => 'CartController@index'
                ));
                Route::get('wishlist', array(
                    'as' => 'wishlist.index',
                    'uses' => 'WishlistController@index'
                ));
                Route::prefix('orders')->name('order.')->group(function(){
                    Route::get('/3/checkout', array(
                        'as' => 'checkout',
                        'uses' => 'OrderController@checkout'
                    ));
                    Route::get('/3/order-success', array(
                        'as' => 'success',
                        'uses' => 'OrderController@orderSuccess'
                    ));
                    Route::get('/3/order-tracking', array(
                        'as' => 'tracking',
                        'uses' => 'OrderController@orderTracking'
                    ));
                });
            });
        });

        Route::prefix('store2')->name('store2.')->group(function(){
            Route::group(['namespace' => 'Store2'], function () {
                Route::get('home', array(
                    'as' => 'home.index',
                    'uses' => 'HomeController@index'
                )); //done
                Route::prefix('product-categories')->name('product_categories.')->group(function(){
                    Route::get('/', array(
                        'as' => 'index',
                        'uses' => 'ProductCategoryController@index'
                    ));
                    Route::get('/{product_category}', array(
                        'as' => 'single_product_category',
                        'uses' => 'ProductCategoryController@singleProductCategory'
                    ));
                });
                Route::prefix('products')->name('products.')->group(function(){
                    Route::get('/', array(
                        'as' => 'index',
                        'uses' => 'ProductController@index'
                    )); //done
                    Route::post('/filter-products', array(
                        'as' => 'filter_products',
                        'uses' => 'ProductController@filterProducts'
                    ));
                    Route::get('/compare', array(
                        'as' => 'compare',
                        'uses' => 'ProductController@compare'
                    )); //done
                    Route::get('/{product_variant}', array(
                        'as' => 'single_product',
                        'uses' => 'ProductController@singleProduct'
                    )); //done

                    Route::post('/quick_view/ajax', array(
                        'as' => 'quick_view.ajax',
                        'uses' => 'ProductController@quickViewAjax'
                    ));
                    Route::post('/add-to-cart/ajax', array(
                        'as' => 'add_to_cart.ajax',
                        'uses' => 'ProductController@addToCartAjax'
                    ));
                    Route::post('/add-to-wishlist/ajax', array(
                        'as' => 'add_to_wishlist.ajax',
                        'uses' => 'ProductController@addToWishlistAjax'
                    ));
                    Route::post('/remove-from-cart/ajax', array(
                        'as' => 'remove_from_cart.ajax',
                        'uses' => 'ProductController@removeFromCartAjax'
                    ));

                });
                Route::get('cart', array(
                    'as' => 'cart.index',
                    'uses' => 'CartController@index'
                ));
                Route::get('wishlist', array(
                    'as' => 'wishlist.index',
                    'uses' => 'WishlistController@index'
                ));
                Route::prefix('orders')->name('order.')->group(function(){
                    Route::get('/checkout', array(
                        'as' => 'checkout',
                        'uses' => 'OrderController@checkout'
                    ));
                    Route::get('/3/order-success', array(
                        'as' => 'success',
                        'uses' => 'OrderController@orderSuccess'
                    ));
                    Route::get('/3/order-tracking', array(
                        'as' => 'tracking',
                        'uses' => 'OrderController@orderTracking'
                    ));
                    Route::post('/add-address/ajax', array(
                        'as' => 'add_address.ajax',
                        'uses' => 'OrderController@addAddressAjax'
                    ));
                });
            });
        });


        //------------------------All Ajax Requests------------------
        Route::post('/contact-us/ajax', array(
            'as' => 'contact_us.ajax',
            'uses' => 'ContactUsMessageController@ajaxContactUsMessagePost'
        ));
        Route::prefix('projects')->name('project.')->group(function () {
            Route::get('/', array(
                'as' => 'index',
                'uses' => 'ProjectController@index'
            ));
            Route::get('/{project}', array(
                'as' => 'single_project',
                'uses' => 'ProjectController@SingleProject'
            ));
            //------------------------All Ajax Requests------------------
            Route::post('/{project}/ajax', array(
                'as' => 'request_project.ajax',
                'uses' => 'ProjectController@ajaxRequestProject'
            ));
        });
        Route::group(['middleware' => 'userCheckAuth'],function(){
            //--------------------Customer Request-----------------------
            Route::prefix('customer-requests')->name('customer_request.')->group(function () {
                Route::get('/create', array(
                    'as' => 'create',
                    'uses' => 'CustomerRequestController@create'
                ));
                Route::post('/store', array(
                    'as' => 'store',
                    'uses' => 'CustomerRequestController@store'
                ));
                Route::get('/show/{customer_request}', array(
                    'as' => 'show',
                    'uses' => 'CustomerRequestController@show'
                ));
                Route::post('/approve-price-offer', array(
                    'as' => 'approve_price_offer',
                    'uses' => 'CustomerRequestController@approvePriceOffer'
                ));
                Route::post('/send-evaluation', array(
                    'as' => 'send_evaluation',
                    'uses' => 'CustomerRequestController@sendEvaluation'
                ));
            });
            Route::prefix('profile')->name('profile.')->group(function () {
                Route::get('/{slug}', array(
                    'as' => 'show',
                    'uses' => 'ProfileController@showProfile'
                ));
            });
            //--------------------price offer-----------------------
            Route::group(['namespace' => 'Maintenance'], function () {
                Route::prefix('price-offers')->name('price_offer.')->group(function () {
                    Route::get('/show/{price_offer}', array(
                        'as' => 'show',
                        'uses' => 'PriceOfferController@show'
                    ));
                });
            });
        });


        //------------------------All Ajax Requests------------------
        Route::get('/city/filter_districts/ajax', array(
            'as' => 'city.filter_districts.ajax',
            'uses' => 'CityController@ajaxCityFilterDistricts'
        ));
    });
});
