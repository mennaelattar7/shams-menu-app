<?php

namespace App\Swagger\Vendor\Product;
/**
 * @OA\Post(
 *     path="/api/{locale}/user/vendor/products/{product_slug}/toggle-availability/{branch_slug}",
 *     tags={"Vendor - Product"},
 *     operationId="Change Toggle Product availability",
 *     summary="---Change Toggle Product availability---",
 *     description="Change Toggle Product availability",
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
 *         description="the sluge of Product",
 *         @OA\Schema(type="string", example="product-slug")
 *     ),
 *     @OA\Parameter(
 *         name="branch_slug",
 *         in="path",
 *         required=true,
 *         description="the sluge of Branch",
 *         @OA\Schema(type="string", example="branch-slug")
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Change Avilabilty",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="string", example="true"),
 *             @OA\Property(property="message", type="string", example="Change Product Avilabilty Succefully"),
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not Authenticated"
 *     )
 * )
 */

class ToggleAvailabilitySwagger {}
