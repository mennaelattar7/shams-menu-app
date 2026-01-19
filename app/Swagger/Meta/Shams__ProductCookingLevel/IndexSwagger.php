<?php

namespace App\Swagger\Meta\Shams__ProductCookingLevel;
/**
 * @OA\get(
 *     path="/api/{locale}/user/meta/product-cooking-levels",
 *     tags={"App Meta"},
 *     summary="---Get Product cooking-levels Endpoint---",
 *     description="Get all Product cooking-levels",
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
 *         description="Get Product cooking-levels successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Get Shams Product cooking-levels Successfully"),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example="1"),
 *                 @OA\Property(property="name", type="string", example="rare"),
 *                 @OA\Property(property="display_name", type="string", example="rare"),
 *                 @OA\Property(property="description", type="string", example="desc rare")
 *            )
 *         )
 *     ),
 * )
 */
class IndexSwagger {}
