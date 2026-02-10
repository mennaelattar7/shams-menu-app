<?php

namespace App\Swagger\Vendor\Offer;
/**
 * @OA\Get(
 *     path="/api/{locale}/user/vendor/offers/{offer_slug}",
 *     tags={"Vendor - Offer"},
 *     operationId="Single offer Data",
 *     summary="---Get Single offer Data Endpoint---",
 *     description="Get Single offer Data Endpoint",
 *
 *     @OA\Parameter(
 *         name="locale",
 *         in="path",
 *         required=true,
 *         description="Language code",
 *         @OA\Schema(type="string", example="en")
 *     ),
 *     @OA\Parameter(
 *         name="offer_slug",
 *         in="path",
 *         required=true,
 *         description="Slug Of offer",
 *         @OA\Schema(type="string", example="offer1")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Get offer Data Successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="success"),
 *             @OA\Property(property="message", type="string", example="Get offer Succefully"),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="name", type="string", example="branch1"),
 *                 @OA\Property(property="slug", type="string", example="branch1"),
 *                 @OA\Property(
 *                     property="city",
 *                     type="object",
 *                     @OA\Property(property="id", type="integer", example=1),
 *                     @OA\Property(property="name", type="string", example="test"),
 *                 ),
 *                 @OA\Property(
 *                     property="district",
 *                     type="object",
 *                     @OA\Property(property="id", type="integer", example=1),
 *                     @OA\Property(property="name", type="string", example="test"),
 *                 ),
 *                 @OA\Property(property="activation_status", type="string", example="active|inactive")
 *             )
 *         )
 *     ),

 *     @OA\Response(
 *         response=404,
 *         description="this Branch Not exist"
 *     )
 * )
 */

class SingleSwagger {}
