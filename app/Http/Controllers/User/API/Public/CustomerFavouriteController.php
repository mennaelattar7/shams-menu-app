<?php

namespace App\Http\Controllers\User\API\Public;

use App\Http\Controllers\Controller;
use App\Models\Customer__Favourite;
use App\Models\Product;
use App\Models\VendorBranche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerFavouriteController extends Controller
{
    public function addToFavourite($locale,$branch_slug,$product_slug)
    {
        $branch = VendorBranche::where('slug',$branch_slug)->first();
        $product = Product::where('slug',$product_slug)->first();
        //check if product exist in favourit list
        $check_favourite = Customer__Favourite::where([
            ['customer_id',Auth::user()->customer->id],
            ['product_id',$product->id],
            ['branch_id' ,$branch->id]
        ])->first();
        if($check_favourite)
        {
            return response()->json([
                'success' =>true,
                'message'=>'this product already exist in Favourite List'
            ],200);
        }
        else
        {
            $new_product_fav = new Customer__Favourite();
            $new_product_fav->customer_id = Auth::user()->customer->id;
            $new_product_fav->product_id = $product->id;
            $new_product_fav->branch_id = $branch->id;
            $new_product_fav->save();
            return response()->json([
                'success' =>true,
                'message'=>'Product Added In Favourite List'
            ],200);
        }
    }
}
