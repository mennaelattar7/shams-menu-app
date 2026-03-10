<?php

namespace App\Http\Controllers\User\API\Vendor\Reports\ProductReviews;

use App\Http\Controllers\Controller;
use App\Http\Controllers\User\API\Vendor\BaseController;
use App\Http\Resources\Vendor__ReviewResource;
use App\Models\VendorBranche;
use Illuminate\Http\Request;

class ProductReviewController extends BaseController
{
    public function statistics($locale, $branch_slug)
    {
        $vendor = $this->vendor;
        $branch = VendorBranche::where('slug',$branch_slug)->first();
        if($branch->vendor->id == $vendor->id)
        {
            $average_rating = $branch->reviews->avg('rating');
            $reviews_count = $branch->reviews->count();

            if(!$reviews_count)
            {
                return response()->json([
                    'success' =>true,
                    'message' =>'There are No Reviews',
                    'data' => []
                ],200);
            }

            return response()->json([
                'success' =>true,
                'message' =>'get all Reviews on this branch successfully',
                'data' => [
                    'average_rating' =>$average_rating,
                    'reviews_count' =>$reviews_count
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

    public function index($locale, $branch_slug)
    {
        $vendor = $this->vendor;
        $branch = VendorBranche::where('slug',$branch_slug)->first();
        if($branch->vendor->id == $vendor->id)
        {
            $all_reviews = $branch->reviews()->get();

            if(!$all_reviews)
            {
                return response()->json([
                    'success' =>true,
                    'message' =>'There Are No Reviews',
                    'data' => []
                ],200);
            }
            return response()->json([
                'success' =>true,
                'message' =>'get all Reviews',
                'data' => Vendor__ReviewResource::collection($all_reviews)
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
