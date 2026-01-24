<?php

namespace App\Http\Controllers\User\API\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\VendorMenuCategoryResource;
use App\Models\VendorBranche;
use Illuminate\Http\Request;

class MenuCategoryController extends Controller
{
    public function getMenuCategories($locale,$branch_slug)
    {
        //check branch exist
        $branch = VendorBranche::where('slug',$branch_slug)->where('activation_status','active')->first();

        if($branch)
        {
            $all_menu_categories = $branch->vendor->menu_categories->where('activation_status','active')->sortBy('sort');
            if($all_menu_categories->isNotEmpty())
            {
                return response()->json([
                    'success' =>true,
                    'message' =>'get Active Menu category of branch Succesfully',
                    'data' =>  VendorMenuCategoryResource::collection($all_menu_categories)
                ],200);
            }
            else
            {
                return response()->json([
                    'success' =>true,
                    'message' =>'There are no categories for this vendor',
                ],200);
            }
        }
        else
        {
            return response()->json([
                'success' =>true,
                'message' =>'Branch not found or inactive',
            ],404);
        }
    }
}
