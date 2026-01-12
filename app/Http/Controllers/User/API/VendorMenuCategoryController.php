<?php

namespace App\Http\Controllers\User\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\VendorMenuCategoryResource;
use App\Models\Product;
use App\Models\Vendor__MenuCategory;
use Illuminate\Http\Request;

class VendorMenuCategoryController extends Controller
{
    // /**
    //  * @OA\Get(
    //  *     path="/api/{locale}/user/categories/{slug}/products",
    //  *     tags={"Menu-Categories"},
    //  *     summary="Products In one Menu-Category",
    //  *     description="Get All Products In one Menu-Category",
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
    //  *         description="the slug of Menu-Category",
    //  *         @OA\Schema(type="string", example="Cold-appetizers")
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
    //  *                          "id": 1,
    //  *                          "category": "Cold appetizers",
    //  *                          "product_type": "food",
    //  *                          "name": "Nigresco pasta",
    //  *                          "slug": "Nigresco pasta",
    //  *                          "description": "Super spicy grilled chicken jchgvjhvhvh",
    //  *                          "image": "image",
    //  *                          "status": "active",
    //  *                          "offer": {
    //  *                                  "id": 2,
    //  *                                  "name": "20% discount",
    //  *                                  "slug": "20%discount",
    //  *                                  "description": "20% discount",
    //  *                                  "discount_type": "percentage",
    //  *                                  "discount_value": 20,
    //  *                                  "start_date": "2026-01-05",
    //  *                                  "end_date": "2026-01-08"
    //  *                             },
    //  *                          "variants": {
    //  *                             {
    //  *                                  "id": 1,
    //  *                                  "name": "Small",
    //  *                                  "price": "250.00",
    //  *                                  "price_after_discount" :"200",
    //  *                                  "calories": 10,
    //  *                                  "status": "active"
    //  *                             }
    //  *                         },
    //  *                 },
    //  *             },
    //  *             @OA\Property(
    //  *                 property="success",
    //  *                 type="boolean"
    //  *             ),
    //  *             @OA\Property(
    //  *                 property="message",
    //  *                 type="string"
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
    //  *                         property="category",
    //  *                         type="string",
    //  *                         example="food"
    //  *                     ),
    //  *                     @OA\Property(
    //  *                          property="name",
    //  *                          type="string",
    //  *                          example="Nigresco pasta"
    //  *                     ),
    //  *                     @OA\Property(
    //  *                         property="description",
    //  *                         type="string",
    //  *                         example="Super spicy grilled chicken jchgvjhvhvh"
    //  *                     ),
    //  *                     @OA\Property(
    //  *                         property="image",
    //  *                         type="string",
    //  *                         example="image"
    //  *                     ),
    //  *                     @OA\Property(
    //  *                         property="price",
    //  *                         type="integer",
    //  *                         example="500"
    //  *                     ),
    //  *                     @OA\Property(
    //  *                         property="calories",
    //  *                         type="integer",
    //  *                         example="500"
    //  *                     ),
    //  *                     @OA\Property(
    //  *                         property="status",
    //  *                         type="string",
    //  *                         example="active"
    //  *                     ),
    //  *                     @OA\Property(
    //  *                         property="offer",
    //  *                         type="object",
    //  *                             @OA\Property(
    //  *                                 property="id",
    //  *                                 type="integer",
    //  *                                 example=1
    //  *                             ),
    //  *                             @OA\Property(
    //  *                                 property="name",
    //  *                                 type="string",
    //  *                                 example="20% discount"
    //  *                             ),
    //  *                             @OA\Property(
    //  *                                 property="slug",
    //  *                                 type="string",
    //  *                                 example="20%discount"
    //  *                             ),
    //  *                             @OA\Property(
    //  *                                 property="description",
    //  *                                 type="string",
    //  *                                 example="20% discount"
    //  *                             ),
    //  *                             @OA\Property(
    //  *                                 property="discount_type",
    //  *                                 type="string",
    //  *                                 example="percentage"
    //  *                             ),
    //  *                             @OA\Property(
    //  *                                 property="discount_value",
    //  *                                 type="integer",
    //  *                                 example="20"
    //  *                             ),
    //  *                             @OA\Property(
    //  *                                 property="start_date",
    //  *                                 type="string",
    //  *                                 example="20/5/2020"
    //  *                             ),
    //  *                             @OA\Property(
    //  *                                 property="end_date",
    //  *                                 type="string",
    //  *                                 example="21/5/2020"
    //  *                             ),
    //  *
    //  *                     ),
    //  *                     @OA\Property(
    //  *                         property="variants",
    //  *                         type="array",
    //  *                         @OA\Items(
    //  *                             @OA\Property(
    //  *                                 property="id",
    //  *                                 type="integer",
    //  *                                 example=1
    //  *                             ),
    //  *                             @OA\Property(
    //  *                                 property="name",
    //  *                                 type="string",
    //  *                                 example="Small"
    //  *                             ),
    //  *                             @OA\Property(
    //  *                                 property="price",
    //  *                                 type="integer",
    //  *                                 example="250.00"
    //  *                             ),
    //  *                             @OA\Property(
    //  *                                 property="price_after_discount",
    //  *                                 type="integer",
    //  *                                 example="200.00"
    //  *                             ),
    //  *                             @OA\Property(
    //  *                                 property="calories",
    //  *                                 type="integer",
    //  *                                 example="10"
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
    public function products($locale,$slug)
    {
        $menu_category = Vendor__MenuCategory::where('slug',$slug)->first();
        $products = $menu_category->products->where('status','active');
        return response()->json([
            'success' => true,
            'message' => 'Products retrieved successfully',
            'data' => ProductResource::collection($products)
        ],200);
    }
}
