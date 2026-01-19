<?php

namespace App\Swagger\Vendor\Branch;
/**
 * @OA\Get(
 *     path="/api/{locale}/user/vendor/branches/filter",
 *     tags={"Vendor - Branch"},
 *     operationId="Filter Branchs",
 *     summary="---Filter Branchs Endpoint---",
 *     description="Filter Branchs Branch",
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
 *         in="query",
 *         required=false,
 *         description="id of city",
 *         @OA\Schema(type="integer", example="1")
 *     ),
 *     @OA\Parameter(
 *         name="district_id",
 *         in="query",
 *         required=false,
 *         description="id of district",
 *         @OA\Schema(type="integer", example="1")
 *     ),
 *     @OA\Parameter(
 *         name="activation_status",
 *         in="query",
 *         required=false,
 *         description="activation status of branch",
 *         @OA\Schema(type="string", example="active")
 *     ),
 *     @OA\Parameter(
 *         name="name",
 *         in="query",
 *         required=false,
 *         description="name of branch",
 *         @OA\Schema(type="string", example="bran")
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Get All Branches Successfully",
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
 *                 @OA\Property(property="activation_status", type="string", example="active|inactive")
 *             ),
 *         )
 *     ),

 *     @OA\Response(
 *         response=404,
 *         description="Not Authenticated"
 *     )
 * )
 */

class FilterSwagger {}
