<?php

namespace App\Http\Controllers\User\API\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Customer__Favourite;
use App\Models\Product;
use App\Models\VendorBranche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerFavouriteController extends Controller
{
    public function toggleFavourite($locale,$branch_slug,Request $request)
    {
        $branch = VendorBranche::where('slug',$branch_slug)->first();
        if(!$branch)
        {
            return response()->json([
                'success' =>false,
                'message' =>'Branch not found',
            ],404);
        }
        $product = Product::where('slug',$request->product_slug)->first();
        if(!$product)
        {
            return response()->json([
                'success' =>false,
                'message' =>'This Product not exist',
            ],404);
        }
        $customer = Auth::user()->customer;
        //check product favourite
        $check_product = Customer__Favourite::where([
            ['customer_id',$customer->id],
            ['product_id',$product->id]
        ])->first();
        if($check_product)
        {
            //remove product from fav list
            $check_product->delete();
            return response()->json([
                'success' =>true,
                'message' =>'Product Removed from Favourite List',
                'status' =>'removed'
            ],200);
        }
        else
        {
            //add product to fav List
            $new_fav_product = new Customer__Favourite();
            $new_fav_product->customer_id = $customer->id;
            $new_fav_product->product_id = $product->id;
            $new_fav_product->branch_id = $branch->id;
            $new_fav_product->save();
            return response()->json([
                'success' =>true,
                'message'=>'Product Added In Favourite List',
                'status' =>'added'
            ],200);
        }
    }
    public function getFavouriteProducts($locale,$branch_slug)
    {
        $branch = VendorBranche::where('slug',$branch_slug)->first();
        if($branch == null)
        {
            return response()->json([
                'success' =>false,
                'message'=>'This Branch not exist'
            ],404);
        }
        $customer = Auth::user()->customer;
        $all_favourite_products = Customer__Favourite::where([
            ['branch_id',$branch->id],
            ['customer_id',$customer->id],
        ])->get();
        $products = Product::whereIn('id',$all_favourite_products->pluck('product_id')->toArray())->get();
        if($all_favourite_products->isEmpty())
        {
            return response()->json([
                'success' =>true,
                'message'=>'Favourite List is empty',
                'data' => []
            ],200);
        }
        return response()->json([
            'success' =>true,
            'message' => 'Favourite Products get Successfully',
            'data' => ProductResource::collection($products)
        ],200);
    }
}
