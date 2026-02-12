<?php

namespace App\Swagger\Vendor\Product;
/**
 * @OA\Post(
 *     path="/api/{locale}/user/vendor/products/{product_slug}/toggle-activation",
 *     tags={"Vendor - Product"},
 *     operationId="Change Toggle Product activation",
 *     summary="---Change Toggle Product activation---",
 *     description="Change Toggle Product activation",
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
 *
 *     @OA\Response(
 *         response=200,
 *         description="Change Avilabilty",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="string", example="true"),
 *             @OA\Property(property="message", type="string", example="Change Product activation Succefully"),
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not Authenticated"
 *     )
 * )
 */

class ToggleActivationSwagger {}
