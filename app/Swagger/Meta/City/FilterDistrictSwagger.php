<?php

namespace App\Swagger\Meta\City;
/**
 * @OA\get(
 *     path="/api/{locale}/user/meta/cities/filter-districts/{city_id}",
 *     tags={"App Meta"},
 *     summary="---Filter Districts Endpoint---",
 *     description="Filter Districts",
 *
 *     @OA\Parameter(
 *         name="locale",
 *         in="path",
 *         required=true,
 *         description="Language code",
 *         @OA\Schema(type="string", example="en")
 *     ),
 *     @OA\Parameter(
 *         name="city_id",
 *         in="path",
 *         required=true,
 *         description="City Id",
 *         @OA\Schema(type="integer", example="1")
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="filter Districts Succesefuly",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="filter Districts Succesefuly"),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example="1"),
 *                 @OA\Property(property="name", type="string", example="Al Amal Dist.")
 *            )
 *         )
 *     ),
 * )
 */
class FilterDistrictSwagger {}
