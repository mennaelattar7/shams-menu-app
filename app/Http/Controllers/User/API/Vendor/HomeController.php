<?php

namespace App\Http\Controllers\User\API\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    public function mostViewedProducts()
    {
        $all_products = Product::withCount('views')->whereHas('category',function($q){
                $q->where('vendor_id',$this->vendor->id);
            })->orderByDesc('views_count')->take(3)->get();

        return response()->json([
            'success' =>true,
            'message' =>'get the most Viewed Products',
            'data' => ProductResource::collection($all_products)
        ],200);
    }
}
