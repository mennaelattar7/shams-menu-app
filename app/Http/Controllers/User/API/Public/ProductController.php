<?php

namespace App\Http\Controllers\User\API\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Product__Tracking;
use App\Models\Vendor__MenuCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class ProductController extends Controller
{
    public function single($locale,$branch_slug,$product_slug,Request $request)
    {

        //check if product exist
        $product = Product::where('slug',$product_slug)->first();
        if(!$product)
        {
            return response()->json([
                'success' =>false,
                'message' => 'this product not found'
            ],404);
        }
        else
        {
            //check product status
            if($product->activation_status == "inactive")
            {
                return response()->json([
                    'success' => true,
                    'message' => 'this product inactive',
                ],200);

            }
            $visitorId = $request->header('visitor_id');
            $new_product_tracking = new Product__Tracking();
            $new_product_tracking->product_id = $product->id;
            $new_product_tracking->customer_id = Auth::check()?Auth::user()->id:null;
            $new_product_tracking->uuid = $visitorId;
            $new_product_tracking->save();

            return response()->json([
                'success' => true,
                'message' => 'Get Prodct Successfuly',
                'data' => new ProductResource($product)
            ],200);
        }
    }

    public function getProducts($locale,$category_slug)
    {
        //get category
        $menu_category = Vendor__MenuCategory::where('slug',$category_slug)->first();
        if($menu_category)
        {
            $products = $menu_category->products->where('activation_status','active');
            if($products->isNotEmpty())
            {
                return response()->json([
                    'success' =>true,
                    'message' =>'get Active and Avilabilty products of branch Succesfully',
                    'data' =>  ProductResource::collection($products)
                ],200);
            }
            else
            {
                return response()->json([
                    'success' =>true,
                    'message' =>'There are no Product for this category',
                ],200);
            }
        }
        else
        {
            return response()->json([
                'success' =>true,
                'message' =>'Product not found or inactive',
            ],404);
        }
    }
}
