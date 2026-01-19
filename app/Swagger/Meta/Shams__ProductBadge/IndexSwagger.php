<?php

namespace App\Swagger\Meta\Shams__ProductBadge;
/**
 * @OA\get(
 *     path="/api/{locale}/user/meta/product-badges",
 *     tags={"App Meta"},
 *     summary="---Get Product Badges Endpoint---",
 *     description="Get all Product Badges",
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
 *         description="Get Product Badges successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Get Shams Product Badges Successfully"),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example="1"),
 *                 @OA\Property(property="name", type="string", example="best_seller"),
 *                 @OA\Property(property="display_name", type="string", example="best_seller"),
 *                 @OA\Property(property="description", type="string", example="desc best_seller")
 *            )
 *         )
 *     ),
 * )
 */
class IndexSwagger {}
