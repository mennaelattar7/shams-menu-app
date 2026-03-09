<?php

namespace App\Http\Controllers\User\API\Vendor\Reports\ProductViews;

use App\Http\Controllers\Controller;
use App\Http\Controllers\User\API\Vendor\BaseController;
use App\Models\Product__Tracking;
use App\Models\VendorBranche;
use Illuminate\Http\Request;

class ProductTrackingController extends BaseController
{
    public function statistics($locale, $branch_slug)
    {
        $vendor = $this->vendor;
        $branch = VendorBranche::where('slug',$branch_slug)->first();
        if($branch->vendor->id == $vendor->id)
        {
            $all_products = $branch->products()->with('views')->get();
            $all_views = $all_products->pluck('views')->flatten();

            //Products viewed
            $all_products_ids = $branch->products->pluck('id')->toArray();
            $all_products_viewed = Product__Tracking::whereIn('product_id',$all_products_ids)->get()->unique('product_id');


            if(!$all_views)
            {
                return response()->json([
                    'success' =>true,
                    'message' =>'There are No Views',
                    'data' => []
                ],200);
            }

            return response()->json([
                'success' =>true,
                'message' =>'get all Visits in this branch successfully',
                'data' => [
                    'views_count' =>$all_views->count(),
                    'all_products_viewed_count' =>$all_products_viewed->count()
                ]
            ],200);
        }
        else
        {
            return response()->json([
                'success' =>false,
                'message' =>'this Branch not found in this vendor'
            ],404);
        }
    }
}
