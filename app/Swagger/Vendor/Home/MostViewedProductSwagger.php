<?php

namespace App\Swagger\Vendor\Home;
/**
 * @OA\Get(
 *     path="/api/{locale}/user/vendor/home/most-viewed-products",
 *     tags={"Vendor - Home"},
 *     operationId="Most-Viewed-Products",
 *     summary="---Get Most Viewed Products In Vendor Endpoint---",
 *     description="Get Most Viewed Products In Vendor Endpoint",
 *
 *     @OA\Parameter(
 *         name="locale",
 *         in="path",
 *         required=true,
 *         description="Language code",
 *         @OA\Schema(type="string", example="en")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="get the most Viewed Products",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="success"),
 *             @OA\Property(property="message", type="string", example="Get Product Succefully"),
 *             @OA\Property(
 *                 property="data",
 *                 type="array",
 *                 @OA\Items(
 *                     type="object",
 *                     @OA\Property(property="id", type="integer", example=1),
 *                     @OA\Property(property="name", type="string", example="Nigresco pasta"),
 *                     @OA\Property(property="slug", type="string", example="Nigresco pasta"),
 *                     @OA\Property(property="activation_status", type="string", example="active"),
 *                     @OA\Property(
 *                         property="variants",
 *                         type="array",
 *                         @OA\Items(
 *                             type="object",
 *                             @OA\Property(property="id", type="integer", example="1"),
 *                             @OA\Property(property="name", type="string", example="Small"),
 *                             @OA\Property(property="price", type="string", example="250.00"),
 *                             @OA\Property(property="price_after_discount", type="string", example="250.00"),
 *                             @OA\Property(property="activation_status", type="string", example="active"),
 *                         )
 *                     ),
 *                     @OA\Property(
 *                         property="category",
 *                         type="object",
 *                         @OA\Property(property="id", type="integer", example=1),
 *                         @OA\Property(property="parent_category", type="string", example="Breakfast"),
 *                         @OA\Property(property="name", type="string", example="test"),
 *                         @OA\Property(property="slug", type="string", example="cat2"),
 *                     ),
 *                 ),
 *               ),
*             )
*          ),

 *     @OA\Response(
 *         response=404,
 *         description="Not Authenticated"
 *     )
 * )
 */

class MostViewedProductSwagger {}
