<?php

namespace App\Swagger\Vendor\Product;
/**
 * @OA\Get(
 *     path="/api/{locale}/user/vendor/products/{product_slug}",
 *     tags={"Vendor - Product"},
 *     operationId="Single Product Data",
 *     summary="---Get Single Product Data Endpoint---",
 *     description="Get Single Product Data Endpoint",
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
 *         description="Slug Of product",
 *         @OA\Schema(type="string", example="product1")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Get product Data Successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="success"),
 *             @OA\Property(property="message", type="string", example="Get product Succefully"),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="name", type="string", example="branch1"),
 *                 @OA\Property(property="slug", type="string", example="branch1"),
 *                 @OA\Property(
 *                     property="city",
 *                     type="object",
 *                     @OA\Property(property="id", type="integer", example=1),
 *                     @OA\Property(property="name", type="string", example="test"),
 *                 ),
 *                 @OA\Property(
 *                     property="district",
 *                     type="object",
 *                     @OA\Property(property="id", type="integer", example=1),
 *                     @OA\Property(property="name", type="string", example="test"),
 *                 ),
 *                 @OA\Property(property="activation_status", type="string", example="active|inactive")
 *             )
 *         )
 *     ),

 *     @OA\Response(
 *         response=404,
 *         description="this Branch Not exist"
 *     )
 * )
 */

class SingleSwagger {}
