<?php

namespace App\Swagger\Meta\City;
/**
 * @OA\get(
 *     path="/api/{locale}/user/meta/cities",
 *     tags={"App Meta"},
 *     summary="---Get Cities Endpoint---",
 *     description="Get all Cities",
 *
 *     @OA\Parameter(
 *         name="locale",
 *         in="path",
 *         required=true,
 *         description="Language code",
 *         @OA\Schema(type="string", example="en")
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Get Cities successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Get Cities"),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example="1"),
 *                 @OA\Property(property="name", type="string", example="Tabuk")
 *            )
 *         )
 *     ),
 * )
 */
class GetCitySwagger {}
