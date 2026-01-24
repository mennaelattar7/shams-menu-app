<?php

namespace App\Swagger\Meta\Shams__Currency;
/**
 * @OA\get(
 *     path="/api/{locale}/user/meta/currencies",
 *     tags={"App Meta"},
 *     summary="---Get Currencies Endpoint---",
 *     description="Get all Currencies",
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
 *         description="Get Currencies successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Get Currencies Successfully"),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example="1"),
 *                 @OA\Property(property="name", type="string", example="best_seller"),
 *                 @OA\Property(property="code", type="string", example="SAR"),
 *                 @OA\Property(property="symbol", type="string", example="ر.س")
 *            )
 *         )
 *     ),
 * )
 */
class IndexSwagger {}
