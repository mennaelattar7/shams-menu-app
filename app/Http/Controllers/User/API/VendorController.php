<?php

namespace App\Http\Controllers\User\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\VendorMenuCategoryResource;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function getVendorData()
    {

    }
    // /**
    //  * @OA\Get(
    //  *     path="/api/{locale}/user/vendors/{slug}/menu-categories",
    //  *     tags={"Vendor Data"},
    //  *     summary="Get All Menu Categories In one Vendor",
    //  *     description="Get All Menu Categories In one Vendor",
    //  *
    //  *     @OA\Parameter(
    //  *         name="locale",
    //  *         in="path",
    //  *         required=true,
    //  *         description="Language code",
    //  *         @OA\Schema(type="string", example="en")
    //  *     ),
    //  *     @OA\Parameter(
    //  *         name="slug",
    //  *         in="path",
    //  *         required=true,
    //  *         description="the slug of vendor",
    //  *         @OA\Schema(type="string", example="shams")
    //  *     ),
    //  *
    //  *     @OA\Response(
    //  *         response=200,
    //  *         description="Successful response",
    //  *         @OA\JsonContent(
    //  *             type="object",
    //  *             example={
    //  *                 "success": true,
    //  *                 "data": {
    //  *                         "id": 1,
    //  *                         "parent_category": null,
    //  *                         "name": "Breakfast",
    //  *                         "image": "image",
    //  *                         "sort": 1,
    //  *                         "status": "active",
    //  *                         "childreen": {
    //  *                             {
    //  *                                  "id": 1,
    //  *                                  "parent_category": "Breakfast",
    //  *                                  "name": "Cold appetizers",
    //  *                                  "image": "image",
    //  *                                  "sort": 1,
    //  *                                  "status": "active",
    //  *                             }
    //  *                         },
    //  *                 },
    //  *             },
    //  *             @OA\Property(
    //  *                 property="success",
    //  *                 type="boolean"
    //  *             ),
    //  *             @OA\Property(
    //  *                 property="data",
    //  *                 type="array",
    //  *                 @OA\Items(
    //  *                     @OA\Property(
    //  *                         property="id",
    //  *                         type="integer",
    //  *                         example=1
    //  *                     ),
    //  *                     @OA\Property(
    //  *                         property="parent_category",
    //  *                         type="string",
    //  *                         example="hhhh"
    //  *                     ),
    //  *                     @OA\Property(
    //  *                          property="name",
    //  *                          type="string",
    //  *                          example="Dokki branch"
    //  *                     ),
    //  *                     @OA\Property(
    //  *                         property="image",
    //  *                         type="string",
    //  *                         example="image"
    //  *                     ),
    //  *                     @OA\Property(
    //  *                         property="sort",
    //  *                         type="integer",
    //  *                         example="1"
    //  *                     ),
    //  *                     @OA\Property(
    //  *                         property="status",
    //  *                         type="string",
    //  *                         example="active"
    //  *                     ),
    //  *                     @OA\Property(
    //  *                         property="childreen",
    //  *                         type="array",
    //  *                         @OA\Items(
    //  *                             @OA\Property(
    //  *                                 property="id",
    //  *                                 type="integer",
    //  *                                 example=1
    //  *                             ),
    //  *                             @OA\Property(
    //  *                                 property="parent_category",
    //  *                                 type="string",
    //  *                                 example="hhhh"
    //  *                             ),
    //  *                             @OA\Property(
    //  *                                 property="name",
    //  *                                 type="string",
    //  *                                 example="Dokki branch"
    //  *                             ),
    //  *                             @OA\Property(
    //  *                                 property="image",
    //  *                                 type="string",
    //  *                                 example="image"
    //  *                             ),
    //  *                             @OA\Property(
    //  *                                 property="sort",
    //  *                                 type="integer",
    //  *                                 example="1"
    //  *                             ),
    //  *                             @OA\Property(
    //  *                                 property="status",
    //  *                                 type="string",
    //  *                                 example="active"
    //  *                             ),
    //  *                         )
    //  *                     ),
    //  *                 )
    //  *             )
    //  *         )
    //  *     ),
    //  * )
    //  */
    public function getVendorMenuCategories($locale,$slug)
    {
        $vendor = Vendor::where('slug',$slug)->first();
        $menu_categories = $vendor->menu_categories()
                                  ->where('status','active')
                                  ->whereNull('parent_category_id')
                                  ->with([
                                    'children_categories'=>function($q){
                                        $q->where('status','active')
                                           ->orderBy('sort');
                                    }
                                  ])
                                  ->orderBy('sort')->get();
        return response()->json([
            'success' => true,
            'message' => 'Categories retrieved successfully',
            'data' =>  VendorMenuCategoryResource::collection($menu_categories)
        ],200);
    }
}
