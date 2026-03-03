<?php

namespace App\Http\Controllers\User\API\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\API\Vendor\MenuCategory\CreateRequest;
use App\Http\Requests\User\API\Vendor\MenuCategory\UpdateRequest;
use App\Http\Resources\ProductResource;
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
        $all_menu_categories = $this->vendor->menu_categories();

        if ($request->activation_status) {
            $all_menu_categories = $all_menu_categories
                ->where('activation_status', $request->activation_status);
        }
        if($request->category_type == "main_category")
        {
            $all_menu_categories=$all_menu_categories->whereNull('parent_category_id');
        }
        if($request->category_type == "sub_category")
        {
            $all_menu_categories=$all_menu_categories->whereNotNull('parent_category_id');
        }
        $depth = 2;
        if ($request->per_page != null) {

            $all_menu_categories = $all_menu_categories
                ->paginate($request->per_page);
            if ($all_menu_categories->isEmpty()) {
                return response()->json([
                    'success' => true,
                    'message' => 'No Menu Categories Found',
                    'data' => []
                ]);
            }
            return VendorMenuCategoryResource::collection($all_menu_categories)
                ->additional([
                    'success' => true,
                    'success' => true,
                    'message' => 'Get Menu Categories Successfully'
                ]);
        }
        else {
            $all_menu_categories = $all_menu_categories->get();
            if ($all_menu_categories->isEmpty()) {
                return response()->json([
                    'success' => true,
                    'message' => 'No Menu Categories Found',
                    'data' => []
                ]);
            }
            return response()->json([
                'success' => true,
                'message' => 'Get Menu Category Successfully',
                'data' => VendorMenuCategoryResource::collection(
                    collect($all_menu_categories)
                        ->map(fn($item) => new VendorMenuCategoryResource($item, $depth))
                )
            ]);
        }
    }
    public function create(CreateRequest $request)
    {
        $user = Auth::user();
        $new_vendor_menu_category = new Vendor__MenuCategory();
        $new_vendor_menu_category->created_by_id = $this->user->id;
        $new_vendor_menu_category->vendor_id = $this->vendor->id;
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

        foreach($request->array_branches_ids as $one_branch)
        {
            $check_category_exist = VendorBranch__VendorMenuCategory::where([
                ['branch_id',$one_branch],
                ['vendor_menu_category_id',$new_vendor_menu_category]
            ])->first();
            if(!$check_category_exist)
            {
                //add vendor_branch___vendor_menu_categories
                $new_branch_menu_category = new VendorBranch__VendorMenuCategory();
                $new_branch_menu_category->created_by_id = $this->user->id;
                $new_branch_menu_category->branch_id = $one_branch;
                $new_branch_menu_category->vendor_menu_category_id = $new_vendor_menu_category->id;
                $new_branch_menu_category->activation_status = $request->activation_status;
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
    public function single($locale,$category_slug)
    {
        $category = Vendor__MenuCategory::where('slug',$category_slug)->first();
        if(!$category)
        {
            return response()->json([
                'success' =>false,
                'message' => 'This Category Not Exist'
            ],404);
        }
        return response()->json([
            'success' =>true,
            'message' => 'Get Category Successfully',
            'data' => new VendorMenuCategoryResource($category)
        ],200);
    }
    public function update($locale,$category_slug,UpdateRequest $request)
    {
        $category = Vendor__MenuCategory::where('slug',$category_slug)->first();
        $category->parent_category_id = $request->parent_category_id;
        $category->name = $request->name;
        if(request()->hasFile('image'))
        {
            $file=$request->image;
            $name = $file->getClientOriginalName();
            $extension = pathinfo($name)['extension'];
            $fileName = 'vendor_menu_category_' . Str::random(5) . '.' . $extension;

            $file->storeAs('vendor/menu_category/images',$fileName,'public');
            $category->image = 'vendor/menu_category/images/' . $fileName;
        }
        $category->activation_status = $request->activation_status;
        $category->sort = $request->sort;
        $category->save();

        if($request->array_branches_ids != null)
        {
            $data = [];
            foreach($request->array_branches_ids as $one_branch_id)
            {
                $data[$one_branch_id]=[
                    'created_by_id' => Auth::user()->id,
                    'activation_status' => 'active'
                ];
            }
            $category->branches()->sync($data);
        }

        return response()->json([
            'success' =>true,
            'message'=>'Category Updated Successfully'
        ],200);
    }
    public function getSubCategories($locale,$category_slug)
    {
        $main_category = Vendor__MenuCategory::where('slug',$category_slug)->first();
        if($main_category == null)
        {
            return response()->json([
                'success' =>false,
                'message' =>'This Main Category Not Found'
            ],404);
        }
        else
        {
            $sub_categories = $main_category->sub_categories;
            if($sub_categories->isEmpty())
            {
                return response()->json([
                    'success' =>true,
                    'message' =>'ther are no sub categories in this main category',
                    'data' =>$sub_categories
                ],200);
            }
            else
            {
                return response()->json([
                    'success' =>true,
                    'message' =>'Get Sub Categories Successfully',
                    'data' => VendorMenuCategoryResource::collection($sub_categories)
                ],200);
            }
        }
    }
    public function getProducts($locale,$category_slug)
    {
        $category = Vendor__MenuCategory::where('slug',$category_slug)->first();
        if($category == null)
        {
            return response()->json([
                'success' =>true,
                'messages' => 'This Category Not Exist',
            ],404);
        }
        if($category->products()->exists())
        {
            $products = $category->products;
            return response()->json([
                'success' =>true,
                'messages' => 'Get Products In Category Successfully',
                'data'=>ProductResource::collection($products)
            ],200);
        }
        else
        {
            return response()->json([
                'success' =>true,
                'messages' => 'There are no Products in Category',
            ],200);
        }

    }

    public function toggleActivation($locale,$category_slug)
    {
        $category = Vendor__MenuCategory::where('slug',$category_slug)->first();
        if($category == null)
        {
            return response()->json([
                'status' =>false,
                'message' => 'this Category not exist'
            ]);
        }
        if($category->activation_status == "active")
        {
            $category->activation_status = "inactive";
        }
        else
        {
            $category->activation_status = "active";
        }
        $category->save();
        return response()->json([
            'success' => true,
            'message' => 'Change category Activation Succefully',
        ], 200);
    }
}
