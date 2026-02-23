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
    public function addToFavourite($locale,$branch_slug,Request $request)
    {
        $branch = VendorBranche::where('slug',$branch_slug)->first();
        $products = $request->products_ids;
        $customer = Auth::user()->customer;
        $data = [];
        foreach($products as $one_product_id)
        {
            $data[$one_product_id]=[
                'branch_id' => $branch->id
            ];
        }
        $customer->favourites()->sync($data);
        return response()->json([
            'success' =>true,
            'message'=>'Product Added In Favourite List'
        ],200);
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
