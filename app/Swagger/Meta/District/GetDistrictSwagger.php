<?php

namespace App\Swagger\Meta\District;
/**
 * @OA\get(
 *     path="/api/{locale}/user/meta/districts",
 *     tags={"App Meta"},
 *     summary="---Get Districts Endpoint---",
 *     description="Get all Districts",
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
 *         description="Get Districts successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Get Districts"),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example="1"),
 *                 @OA\Property(property="name", type="string", example="Tabuk"),
 *                 @OA\Property(
 *                     property="city",
 *                     type="object",
 *                     @OA\Property(property="id", type="integer", example="1"),
 *                     @OA\Property(property="name", type="string", example="Riyadh")
 *                )
 *            )
 *         )
 *     ),
 * )
 */
class GetDistrictSwagger {}
