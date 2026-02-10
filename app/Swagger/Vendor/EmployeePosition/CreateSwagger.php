<?php

namespace App\Swagger\Vendor\EmployeePosition;
/**
 * @OA\Post(
 *     path="/api/{locale}/user/vendor/employee_positions/create",
 *     tags={"Vendor - Employee Position"},
 *     operationId="Create Position",
 *     summary="---Create Position Endpoint---",
 *     description="Create New Position",
 *
 *     @OA\Parameter(
 *         name="locale",
 *         in="path",
 *         required=true,
 *         description="Language code",
 *         @OA\Schema(type="string", example="en")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                 property="name",
 *                 type="object",
 *                 @OA\Property(property="en", type="string", example="branch1"),
 *                 @OA\Property(property="ar", type="string", example="branch1")
 *             ),
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Create Position Successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="string", example="true"),
 *             @OA\Property(property="message", type="string", example="Create Position Successfully"),
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not Authenticated"
 *     )
 * )
 */

class CreateSwagger {}
