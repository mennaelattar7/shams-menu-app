<?php

namespace App\Swagger\Meta\Shams__ProductAllergen;
/**
 * @OA\get(
 *     path="/api/{locale}/user/meta/product-allergens",
 *     tags={"App Meta"},
 *     summary="---Get Product Allergens Endpoint---",
 *     description="Get all Product Allergens",
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
 *         description="Get Product allergens successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Get Shams Product allergens Successfully"),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example="1"),
 *                 @OA\Property(property="name", type="string", example="best_seller"),
 *                 @OA\Property(property="slug", type="string", example="kbk"),
 *            )
 *         )
 *     ),
 * )
 */
class IndexSwagger {}
