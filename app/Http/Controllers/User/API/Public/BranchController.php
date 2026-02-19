<?php

namespace App\Http\Controllers\User\API\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
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
        $branch = VendorBranche::where('slug',$branch_slug)->first();
        if($branch)
        {
            if($branch->activation_status == "active")
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
                    'message' =>'Branch not active',
                ],404);
            }
        }
        else
        {
            return response()->json([
                'success' =>true,
                'message' =>'Branch not found',
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
        $features = $branch->features;
        $activation_features = collect();
        foreach($features as $one_feature)
        {
            if($one_feature->activation_status == "active")
            {
                if($one_feature->pivot->activation_status == "active")
                {
                    $activation_features->push($one_feature);
                }
            }
        }
        $items = $activation_features->whereIn('code', ['main_category', 'subcategory']);
        if($items->count() == 2)
        {
            $categories = $branch->categories->where('activation_status','active')->where('parent_category_id','!=',null);
            return response()->json([
                'success' =>true,
                'message' =>'get products successfully',
                'data' => VendorMenuCategoryResource::collection($categories)
            ],200);
        }
        elseif($items->count() == 1)
        {
            if($items->first()->code == "main_category")
            {
                $categories = collect();
                $main_categories = $branch->categories->where('activation_status','active')->where('parent_category_id',null);
                foreach($main_categories as $one_category)
                {
                    if($one_category->sub_categories->isNotEmpty())
                    {
                        foreach($one_category->sub_categories as $one_sub)
                        {
                            $categories->push($one_sub);
                        }
                    }
                    $categories->push($one_category);
                }
                if($categories->isEmpty())
                {
                    return response()->json([
                        'success' =>false,
                        'message' =>'There Are no Main categories',
                    ],404);
                }
                else
                {
                    return response()->json([
                        'success' =>true,
                        'message' =>'get products successfully',
                        'data' => VendorMenuCategoryResource::collection($categories)
                    ],200);
                }
            }
            else
            {
                $categories = $branch->categories->where('activation_status','active')->where('parent_category_id','!=',null);
                if($categories->isEmpty())
                {
                    return response()->json([
                        'success' =>false,
                        'message' =>'There Are no Sub categories',
                    ],404);
                }
                else
                {
                    return response()->json([
                        'success' =>true,
                        'message' =>'get products successfully',
                        'data' => VendorMenuCategoryResource::collection($categories)
                    ],200);
                }

            }
        }
        else
        {
            $categories = $branch->categories->where('activation_status','active');
            $products = collect();
            foreach($categories as $one_category)
            {
                foreach($one_category->products as $one_product)
                {
                    $products->push($one_product);
                }
            }
            if($products->isEmpty())
            {
                return response()->json([
                    'success' =>false,
                    'message' =>'There Are No Products',
                ],404);
            }
            return response()->json([
                'success' =>true,
                'message' =>'get products successfully',
                'data' => ProductResource::collection($products)
            ],200);
        }
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
