<?php

namespace App\Http\Controllers\User\API\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\API\Vendor\MenuCategory\CreateRequest;
use App\Http\Resources\VendorMenuCategoryResource;
use App\Models\Vendor__MenuCategory;
use App\Models\VendorBranch__VendorMenuCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MenuCategorycontroller extends BaseController
{
    public function index(Request $request)
    {
        if($request->per_page != null)
        {
            $all_menu_categories= $this->vendor->menu_categories()->paginate($request->per_page);
            return VendorMenuCategoryResource::collection($all_menu_categories)
            ->additional([
                'success' => true,
                'message' => 'Get Menu Categories Successfully'
            ])
            ->response()
            ->setStatusCode(200);
        }
        else
        {
            $all_menu_categories = $this->vendor->menu_categories;
            return response()->json([
                'success' => true,
                'message' => 'Get Menu CategorySuccefully',
                'data' => VendorMenuCategoryResource::collection($all_menu_categories)
            ], 200);
        }
    }
    public function create(CreateRequest $request)
    {
        $user = Auth::user();
        $new_vendor_menu_category = new Vendor__MenuCategory();
        $new_vendor_menu_category->created_by_id = $user->id;
        $new_vendor_menu_category->vendor_id = $user->vendor_representative->vendor->id;
        $new_vendor_menu_category->parent_category_id = $request->parent_category_id;
        $new_vendor_menu_category->name = $request->name;
        $new_vendor_menu_category->activation_status = $request->activation_status;
        $new_vendor_menu_category->sort = $request->sort;
        if(request()->hasFile('image'))
        {
            $file=$request->image;
            $name = $file->getClientOriginalName();
            $extension = pathinfo($name)['extension'];
            $fileName = 'vendor_menu_category_' . Str::random(5) . '.' . $extension;

            $file->storeAs('vendor/menu_category/images',$fileName,'public');
            $new_vendor_menu_category->image = 'vendor/menu_category/images/' . $fileName;
        }
        $new_vendor_menu_category->save();
        $branchesIds = explode(',', $request->array_branches_ids);
        $branchesIds = array_map('intval', $branchesIds);

        foreach($branchesIds as $one_branch)
        {
            $check_category_exist = VendorBranch__VendorMenuCategory::where([
                ['branch_id',$one_branch],
                ['vendor_menu_category_id',$new_vendor_menu_category]
            ])->first();
            if(!$check_category_exist)
            {
                //add vendor_branch___vendor_menu_categories
                $new_branch_menu_category = new VendorBranch__VendorMenuCategory();
                $new_branch_menu_category->created_by_id = $user->id;
                $new_branch_menu_category->branch_id = $one_branch;
                $new_branch_menu_category->vendor_menu_category_id = $new_vendor_menu_category->id;
                $new_branch_menu_category->status = $request->activation_status;
                $new_branch_menu_category->save();
            }
        }
        //check if this category in branch

        if ($new_vendor_menu_category->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Category added successfully'
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => 'Something went wrong'
        ], 500);
    }
}
