<?php

namespace App\Swagger\Vendor\User;
/**
 * @OA\Post(
 *     path="/api/{locale}/user/vendor/users/create",
 *     tags={"Vendor - User"},
 *     operationId="Create User",
 *     summary="---Create User Endpoint---",
 *     description="Create New User",
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
 *             @OA\Property(property="name", type="string", example="new useer"),
 *             @OA\Property(property="phone_number", type="string", example="1111111"),
 *             @OA\Property(property="position_id", type="number", example="7"),
 *             @OA\Property(property="password", type="string", example="123456789"),
 *             @OA\Property(property="password_confirmation", type="string", example="123456789"),
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Create User Successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="string", example="true"),
 *             @OA\Property(property="message", type="string", example="Create User Successfully"),
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not Authenticated"
 *     )
 * )
 */

class CreateSwagger {}
