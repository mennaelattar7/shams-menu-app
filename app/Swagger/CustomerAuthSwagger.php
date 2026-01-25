<?php

namespace App\Swagger;

    /**
     * @OA\Post(
     *     path="/api/{locale}/user/public/auth/login",
     *     summary="---Login Endpoint---",
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
     * ======================================================================
    * @OA\Post(
    *     path="/api/{locale}/user/public/auth/verify-otp",
    *     summary="---Verifying OTP---",
    *     description="Register user using  phone number, country dial code and OTP to verify his account",
    *     operationId="verify-otp",
    *     tags={"Public - Auth"},
    *
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(
    *             required={"phone_number","otp"},
    *             @OA\Property(property="phone_number", type="string", example="01012345678", description="User mobile number"),
    *             @OA\Property(property="otp", type="string", example="123456", description="OTP sent to mobile")
    *         )
    *     ),
    *
    *     @OA\Response(
    *         response=200,
    *         description="verification successfully",
    *         @OA\JsonContent(
    *             type="object",
    *             example={
    *                 "success": true,
    *                 "token" :"3|QrRpUFZQO5KsBr0G1uONl3EftznaappuMcnuOlg79950949e",
    *                 "data": {
    *                      "user_id": 7,
    *                      "user_name": "Menna",
    *                      "user_slug": "menna",
    *                      "user_email": "menna1@test.com",
    *                      "user_country_dial_code_id": 242,
    *                      "user_phone_number": "01096856825",
    *                      "user_account_type": "vendor_representative",
    *                      "vendor_representative": {
    *                          "vendor_rep_id": 5,
    *                          "vendor_rep_position": "manager"
    *                      }
    *                 },
    *             },
    *             @OA\Property(property="success", type="boolean", example=true),
    *             @OA\Property(property="message", type="string", example="Registered successfully, OTP sent to mobile")
    *         )
    *     ),
    *
    *     @OA\Response(
    *         response=404,
    *         description="user not found"
    *     ),
    *     @OA\Response(
    *         response=400,
    *         description="Invalid or expired OTP"
    *     )
    * )
    */

class CustomerAuthSwagger {}
