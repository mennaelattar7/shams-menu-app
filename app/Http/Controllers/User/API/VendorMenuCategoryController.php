<?php

namespace App\Http\Controllers\User\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\VendorMenuCategoryResource;
use App\Models\Product;
use App\Models\Vendor__MenuCategory;
use Illuminate\Http\Request;

class VendorMenuCategoryController extends Controller
{
    //get all categories in one vendor
    public function getVendorMenuCategorData($locale,$slug)
    {
        $menu_category = Vendor__MenuCategory::where('slug',$slug)->first();
        return response()->json([
            'success' => true,
            'message' => 'Categories retrieved successfully',
            'data' => new VendorMenuCategoryResource($menu_category)
        ],200);
    }
    //products in one category
    public function products($locale,$slug)
    {
        $menu_category = Vendor__MenuCategory::where('slug',$slug)->first();
        $products = $menu_category->products->where('status','active');
        return response()->json([
            'success' => true,
            'message' => 'Products retrieved successfully',
            'data' => ProductResource::collection($products)
        ],200);
    }
}
