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
        $branch = VendorBranche::where('slug',$branch_slug)->first();

        if($branch)
        {
            if($branch->activation_status == "active")
            {
                $all_menu_categories = $branch->categories()
                                      ->wherePivot('activation_status','active')
                                      ->where('vendor___menu_categories.activation_status', 'active')
                                      ->get();
                $new_menu_category_collection = collect();
                foreach($all_menu_categories as $one_category)
                {
                    $parent_category = $one_category->parent_category;
                    //check the parent of category is active
                    if($parent_category)
                    {
                        $isParentActiveInBranch = $parent_category->branches()
                                                                ->where('branch_id', $branch->id)
                                                                ->wherePivot('activation_status', 'active')
                                                                ->exists();
                        if($isParentActiveInBranch)
                        {
                            $new_menu_category_collection->push($one_category);
                        }
                    }
                    else
                    {
                        $new_menu_category_collection->push($one_category);
                    }
                }
                if($new_menu_category_collection->isNotEmpty())
                {
                    return response()->json([
                        'success' =>true,
                        'message' =>'get Active Menu category of branch Succesfully',
                        'data' =>  VendorMenuCategoryResource::collection($new_menu_category_collection)
                    ],200);
                }
                else
                {
                    return response()->json([
                        'success' =>true,
                        'message' =>'There are no categories for this vendor',
                        'data' =>[]
                    ],200);
                }
            }
            else
            {
                return response()->json([
                    'success' =>true,
                    'message' =>'Branch not Active',
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
}
