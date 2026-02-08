<?php

namespace App\Swagger\Vendor\Product;
/**
 * @OA\Put(
 *     path="/api/{locale}/user/vendor/products/{product_slug}/update",
 *     tags={"Vendor - Product"},
 *     operationId="Update Product Data",
 *     summary="---Update Product Data---",
 *     description="Update Product Data",
 *
 *     @OA\Parameter(
 *         name="locale",
 *         in="path",
 *         required=true,
 *         description="Language code",
 *         @OA\Schema(type="string", example="en")
 *     ),
 *     @OA\Parameter(
 *         name="product_slug",
 *         in="path",
 *         required=true,
 *         description="the sluge of product",
 *         @OA\Schema(type="string", example="product-slug")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                 property="name",
 *                 type="object",
 *                 @OA\Property(property="en", type="string", example="طاجن لحمه"),
 *                 @OA\Property(property="ar", type="string", example="طاجن لحمه")
 *             ),
 *             @OA\Property(
 *                 property="description",
 *                 type="object",
 *                 @OA\Property(property="en", type="string", example="وصف طاجن لحمه"),
 *                 @OA\Property(property="ar", type="string", example="وصف طاجن لحمه")
 *             ),
 *             @OA\Property(property="image", type="string", example="image"),
 *             @OA\Property(property="price", type="desimal", example="50"),
 *             @OA\Property(property="calories", type="integer", example="55"),
 *             @OA\Property(property="category_id", type="integer", example="1"),
 *             @OA\Property(property="product_type_id", type="integer", example="1"),
 *             @OA\Property(
 *                 property="branches_ids",
 *                 type="array",
 *                 @OA\Items(type="integer", example=1)
 *             ),
 *             @OA\Property(
 *                 property="badges_ids",
 *                 type="array",
 *                 @OA\Items(type="integer", example=1)
 *             ),
 *             @OA\Property(
 *                 property="cooking_level_ids",
 *                 type="array",
 *                 @OA\Items(type="integer", example=1)
 *             ),
 *             @OA\Property(
 *                 property="allergens_ids",
 *                 type="array",
 *                 @OA\Items(type="integer", example=1)
 *             ),
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="update Product data successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="string", example="true"),
 *             @OA\Property(property="message", type="string", example="Product added successfully"),
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not Authenticated"
 *     )
 * )
 */

class UpdateSwagger {}
