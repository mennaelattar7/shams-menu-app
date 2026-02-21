<?php

namespace App\Swagger\Vendor\EmployeePosition;
/**
 * @OA\Get(
 *     path="/api/{locale}/user/vendor/employee_positions",
 *     tags={"Vendor - Employee Position"},
 *     operationId="All Employee Positions",
 *     summary="---Get All Menu Categories Endpoint---",
 *     description="Get All Menu Categories Data",
 *
 *     @OA\Parameter(
 *         name="locale",
 *         in="path",
 *         required=true,
 *         description="Language code",
 *         @OA\Schema(type="string", example="en")
 *     ),
 *     @OA\Parameter(
 *         name="activation_status",
 *         in="query",
 *         required=false,
 *         description="activation_status Of employee position",
 *         @OA\Schema(type="string",enum={"active","inactive"} ,example="active")
 *     ),
 *     @OA\Parameter(
 *         name="name",
 *         in="query",
 *         required=false,
 *         description="name Of employee position",
 *         @OA\Schema(type="string", example="data")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Get All Employee Position Successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="success"),
 *             @OA\Property(property="message", type="string", example="Get Employee Position Succefully"),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="name", type="string", example="menucategory"),
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

class IndexSwagger {}
