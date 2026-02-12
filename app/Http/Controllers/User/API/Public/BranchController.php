<?php

namespace App\Http\Controllers\User\API\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\ShamsFeatureResource;
use App\Http\Resources\VendorBranch__TableResource;
use App\Http\Resources\VendorBranchResource;
use App\Http\Resources\VendorMenuCategoryResource;
use App\Models\Vendor__MenuCategory;
use App\Models\VendorBranche;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function getBranchData($locale,$branch_slug)
    {
        //check branch exist
        $branch = VendorBranche::where('slug',$branch_slug)->where('activation_status','active')->first();
        if($branch)
        {
            return response()->json([
                'success' =>true,
                'message' =>'get Branch Data Succesfully',
                'data' => new VendorBranchResource($branch)
            ],200);
        }
        else
        {
            return response()->json([
                'success' =>true,
                'message' =>'Branch not found or inactive',
            ],404);
        }

    }
    public function getBranchTables($locale,$branch_slug)
    {
        $branch = VendorBranche::where('slug',$branch_slug)->where('activation_status','active')->first();
        if($branch)
        {
            $branch_tables = $branch->tables;
            return response()->json([
                'success' =>true,
                'message' =>'get Branch Tables',
                'data' =>  VendorBranch__TableResource::collection($branch_tables)
            ],200);
        }
        else
        {
            return response()->json([
                'success' =>true,
                'message' =>'Branch not found or inactive',
            ],404);
        }
    }

    public function getProducts($locale,$branch_slug)
    {
        $branch = VendorBranche::where('slug',$branch_slug)->first();
        if(!$branch)
        {
            return response()->json([
                'success' =>true,
                'message' =>'Branch not found or inactive',
            ],404);
        }
        $categories = $branch->categories->where('activation_status','active');
        return response()->json([
            'success' =>true,
            'message' =>'get products successfully',
            'data' => VendorMenuCategoryResource::collection($categories)
        ],200);
    }

    public function getFeatures($locale,$branch_slug)
    {
        $branch = VendorBranche::where('slug',$branch_slug)->first();
        if(!$branch)
        {
            return response()->json([
                'success' =>true,
                'message' =>'Branch not found or inactive',
            ],404);
        }
        $features = $branch->features->where('activation_status','active');
        return response()->json([
            'success' =>true,
            'message' =>'get Features successfully',
            'data' => ShamsFeatureResource::collection($features)
        ],200);
    }
}
