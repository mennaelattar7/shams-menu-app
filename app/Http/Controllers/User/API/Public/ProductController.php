<?php

namespace App\Http\Controllers\User\API\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Vendor__MenuCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class ProductController extends Controller
{
    public function single($locale,$slug)
    {
        //check if product exist
        $product = Product::where('slug',$slug)->first();
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
            //redis
            $viewsKey = "product:{$product->id}:views";
            $logsKey = "product:{$product->id}:view_logs";
            //incement inside hash
            Redis::hincrby($viewsKey,'total_views',1);

            if(Auth::check())
            {
                Redis::hincrby($viewsKey,'customer_views',1);
            }
            else
            {
                Redis::hincrby($viewsKey,'guest_views',1);
            }
            //logs
            $log = [
                'user_type' => Auth::check() ? 'customer' : 'guest',
                'user_id'   => Auth::id(),
                'ip'        => request()->ip(),
                'viewed_at' => now()->toDateTimeString(),
            ];
            Redis::rpush($logsKey, json_encode($log));

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
