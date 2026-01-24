<?php

namespace App\Swagger;

    /**
     * @OA\Post(
     *     path="/api/{locale}/user/public/auth/register",
     *     summary="---Register Endpoint---",
     *     description="Register Customer and send OTP",
     *     operationId="registerCustomer",
     *     tags={"Public - Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="name", type="string", example="menna"),
     *             @OA\Property(property="country_dial_code_id", type="integer" , example="2"),
     *             @OA\Property(property="phone_number", type="string",  example="0501234569"),
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Registered successfully"
     *     )
     * )
    */

class CustomerAuthSwagger {}
