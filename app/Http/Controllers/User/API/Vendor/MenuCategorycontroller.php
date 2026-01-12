<?php

namespace App\Http\Controllers\User\API\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\API\Vendor\MenuCategory\CreateRequest;
use App\Models\Vendor__MenuCategory;
use App\Models\VendorBranch__VendorMenuCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MenuCategorycontroller extends Controller
{
// /**
//  * @OA\Post(
//  *     path="/api/{locale}/user/vendor/menu_category/create",
//  *     tags={"Vendor Endpoints"},
//  *     summary="---Create Menu Category Endpoint---",
//  *     description="Create New Menu Category",
//  *
//  *     @OA\Parameter(
//  *         name="locale",
//  *         in="path",
//  *         required=true,
//  *         description="Language code",
//  *         @OA\Schema(type="string", example="en")
//  *     ),
//  *     @OA\RequestBody(
//  *         required=true,
//  *         @OA\JsonContent(
//  *             type="object",
//  *             @OA\Property(property="parent_category_id", type="integer", example="1"),
//  *             @OA\Property(
//  *                 property="name",
//  *                 type="object",
//  *                 @OA\Property(property="en", type="string", example="cat1"),
//  *                 @OA\Property(property="ar", type="string", example="cat1")
//  *             ),
//  *             @OA\Property(property="activation_status", type="string", example="active"),
//  *             @OA\Property(property="sort", type="integer", example="1"),
//  *             @OA\Property(property="image", type="string", example="image"),
//  *             @OA\Property(property="array_branches_ids", type="string", example="2,3,4"),
//  *         )
//  *     ),
//  *
//  *     @OA\Response(
//  *         response=200,
//  *         description="Get vendor data successfully",
//  *         @OA\JsonContent(
//  *             type="object",
//  *             @OA\Property(property="status", type="string", example="success"),
//  *             @OA\Property(property="message", type="string", example="success Login"),
//  *             @OA\Property(property="token", type="string", example="38|hmKx2mys6d2wKJw75x4qR3AVvoIuF69RwHMhk8EF7ab40fbb"),
//  *             @OA\Property(
//  *                 property="data",
//  *                 type="object",
//  *                 @OA\Property(property="user_id", type="integer", example=1),
//  *                 @OA\Property(property="user_name", type="string", example="Menna"),
//  *                 @OA\Property(property="user_slug", type="string", example="menna"),
//  *                 @OA\Property(property="user_email", type="string", example="menna_vendor_rep@test.com"),
//  *                 @OA\Property(property="user_country_dial_code_id", type="integer", example="242"),
//  *                 @OA\Property(property="user_phone_number", type="string", example="0501234567"),
//  *                 @OA\Property(property="user_account_type", type="string", example="vendor_representative"),
//  *                 @OA\Property(
//  *                      property="vendor_representative",
//  *                      type="object",
//  *                      @OA\Property(property="vendor_rep_id", type="integer", example=1),
//  *                      @OA\Property(property="vendor_rep_position", type="string", example="manager"),
//  *                 )
//  *             )
//  *         )
//  *     ),
//  *     @OA\Response(
//  *         response=404,
//  *         description="Not Authenticated"
//  *     )
//  * )
//  */
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
