<?php

namespace App\Swagger\Vendor\TableRequest;
/**
 * @OA\Get(
 *     path="/api/{locale}/user/vendor/table-requests/{request_id}",
 *     tags={"Vendor - TableRequest"},
 *     operationId="Single Table Request Data",
 *     summary="---Get Single Table Request Data Endpoint---",
 *     description="Get Single Table Request Data Endpoint",
 *
 *     @OA\Parameter(
 *         name="locale",
 *         in="path",
 *         required=true,
 *         description="Language code",
 *         @OA\Schema(type="string", example="en")
 *     ),
 *     @OA\Parameter(
 *         name="request_id",
 *         in="path",
 *         required=true,
 *         description="Table Request Id",
 *         @OA\Schema(type="integer", example="5")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Get Table Request Data Successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="success"),
 *             @OA\Property(property="message", type="string", example="Get Branches Succefully"),
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
