<?php

use App\Http\Controllers\User\API\Auth\AuthController ;
use App\Http\Controllers\User\API\ProductController;
use App\Http\Controllers\User\API\VendorController;
use App\Http\Controllers\User\API\VendorMenuCategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Notes :
//token : "7|dOp5sLtxdPkWUW117htvKKFf9u2O1Tx2goCfosmq5595c5b8",

//tohandel exception of token not exist
Route::get('/login', function () {})->name('login');

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
        require __DIR__.'/API/public.php';
    });
});




Route::prefix('vendors')->name('vendors.')->group(function(){
    Route::post('create',array(
        'as' => 'create',
        'uses' =>'VendorController@create'
    ));
});


