<?php

namespace App\Swagger\Vendor\Product;
/**
 * @OA\Post(
 *     path="/api/{locale}/user/vendor/products/create",
 *     tags={"Vendor - Product"},
 *     operationId="Create Product",
 *     summary="---Create Product Endpoint---",
 *     description="Create New Product",
 *
 *     @OA\Parameter(
 *         name="locale",
 *         in="path",
 *         required=true,
 *         description="Language code",
 *         @OA\Schema(type="string", example="en")
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
 *             @OA\Property(property="price", type="desimal", example="50"),
 *             @OA\Property(property="calories", type="integer", example="55"),
 *             @OA\Property(property="image", type="string", example="image"),
 *             @OA\Property(property="category_id", type="integer", example="1"),
 *             @OA\Property(property="product_type_id", type="integer", example="1"),
 *             @OA\Property(
 *                 property="product_variant_name",
 *                 type="object",
 *                 @OA\Property(property="en", type="string", example="حجم كبير"),
 *                 @OA\Property(property="ar", type="string", example="حجم كبير")
 *             ),
 *             @OA\Property(property="activation_status", type="string", example="active"),
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
 *                 property="allergens",
 *                 type="array",
 *                 @OA\Items(
 *                     type="object",
 *                     @OA\Property(
 *                         property="name",
 *                         type="string",
 *                         example="milk"
 *                     ),
 *                     @OA\Property(
 *                         property="display_name",
 *                         type="object",
 *                         @OA\Property(
 *                             property="en",
 *                             type="string",
 *                             example="milk"
 *                         ),
 *                         @OA\Property(
 *                             property="ar",
 *                             type="string",
 *                             example="حليب"
 *                         )
 *                     )
 *                 )
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Add Product data successfully",
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

class CreateSwagger {}
