<?php

namespace App\Swagger;

    /**
     * @OA\Post(
     *     path="/api/{locale}/user/vendor/auth/register",
     *     summary="---Register Endpoint---",
     *     description="Register vendor and send OTP",
     *     operationId="registerVendor",
     *     tags={"Vendor Endpoints --- Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="name", type="string", example="menna"),
     *             @OA\Property(property="email", type="string", example="menna@gmail.com"),
     *             @OA\Property(property="country_dial_code_id", type="integer" , example="2"),
     *             @OA\Property(property="phone_number", type="string",  example="0501234569"),
     *             @OA\Property(property="position", type="string", example="manager"),
     *             @OA\Property(
     *                 property="company_name",
     *                 type="object",
     *                 @OA\Property(property="en", type="string", example="com1"),
     *                 @OA\Property(property="ar", type="string", example="com1")
     *             ),
     *             @OA\Property(property="vendor_type_id", type="integer", example="1")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Registered successfully"
     *     )
     * )
     * ..............................................................................
    * @OA\Post(
    *     path="/api/{locale}/user/auth/verify-otp-register",
    *     summary="---Verifying OTP---",
    *     description="Register user using  phone number, country dial code and OTP to verify his account",
    *     operationId="verify-otp-register",
    *     tags={"Vendor Endpoints --- Auth"},
    *
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(
    *             required={"country_dial_code_id","phone_number","otp"},
    *             @OA\Property(property="country_dial_code_id", type="integer", example=242, description="Country dial code ID"),
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
    *==============================================================================================================
    * @OA\Post(
    *     path="/api/{locale}/user/vendor/auth/login",
    *     operationId="LoginVendor",
    *     tags={"Vendor Endpoints --- Auth"},
    *     summary="---Login Endpoint---",
    *     description="Login Vendor --- NOTE : (delete all old tokens)",
    *     @OA\Parameter(
    *         name="locale",
    *         in="path",
    *         required=true,
    *         description="Language code",
    *         @OA\Schema(type="string", example="en")
    *     ),
    *
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="phone_number", type="string", example="0501234568"),
    *             @OA\Property(property="password", type="string", example="123456")
    *         )
    *     ),
    *
    *     @OA\Response(
    *         response=200,
    *         description="Get vendor data successfully",
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="status", type="string", example="success"),
    *             @OA\Property(property="message", type="string", example="success Login"),
    *             @OA\Property(property="token", type="string", example="72|vOPnfYYGTuQH1fJja2qFhoCoLf3Jc7bv1FvVcJgvc02903d6"),
    *             @OA\Property(
    *                 property="data",
    *                 type="object",
    *                 @OA\Property(property="user_id", type="integer", example=1),
    *                 @OA\Property(property="user_name", type="string", example="Menna"),
    *                 @OA\Property(property="user_slug", type="string", example="menna"),
    *                 @OA\Property(property="user_email", type="string", example="menna_vendor_rep@test.com"),
    *                 @OA\Property(property="user_country_dial_code", type="integer", example="+966"),
    *                 @OA\Property(property="user_phone_number", type="string", example="0501234568"),
    *                 @OA\Property(property="user_account_type", type="string", example="vendor_representative"),
    *                 @OA\Property(
    *                      property="vendor_representative",
    *                      type="object",
    *                      @OA\Property(property="vendor_rep_id", type="integer", example=1),
    *                      @OA\Property(property="vendor_rep_position", type="string", example="manager")
    *                 )
    *             )
    *         )
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Not Authenticated"
    *     )
    * )
    *========================================================================================
    * @OA\Post(
    *     path="/api/{locale}/user/vendor/auth/forget-password",
    *     operationId="ForgetPasswordVendor",
    *     tags={"Vendor Endpoints --- Auth"},
    *     summary="---Forget Password Endpoint---",
    *     description="Forget password",
    *     @OA\Parameter(
    *         name="locale",
    *         in="path",
    *         required=true,
    *         description="Language code",
    *         @OA\Schema(type="string", example="en")
    *     ),
    *
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="phone_number", type="string", example="0501234568")
    *         )
    *     ),
    *
    *     @OA\Response(
    *         response=200,
    *         description="Get OTP",
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="status", type="string", example="success"),
    *             @OA\Property(property="message", type="string", example="If the phone number exists, an OTP has been sent"),
    *         )
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Not Authenticated"
    *     )
    * )
    *===========================================================================================
    * @OA\Post(
    *     path="/api/{locale}/user/auth/verify-otp-forget-password",
    *     summary="---Verifying OTP In Forget Passwprd Endpoint---",
    *     description="Verifying OTP In Forget Passwprd Endpoint",
    *     operationId="verify-otp-forget-password",
    *     tags={"Vendor Endpoints --- Auth"},
    *     @OA\Parameter(
    *         name="locale",
    *         in="path",
    *         required=true,
    *         description="Language code",
    *         @OA\Schema(type="string", example="en")
    *     ),
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
    *                 "temporary_token" :"oxhCZlMXXRk6kV28HwNmfeDmA1tqjVrdj41wa2VHgcEmFYQZ8xLPO1CCzG6v",
    *                 },
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
    *===============================================================================================
    * @OA\Post(
    *     path="/api/{locale}/user/vendor/auth/reset-password",
    *     summary="---Reset Passwprd Endpoint---",
    *     description="Reset Passwprd Endpoint Note: after reset login",
    *     operationId="reset-password",
    *     tags={"Vendor Endpoints --- Auth"},
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
    *             required={"phone_number","token","password","password_confirmation"},
    *             @OA\Property(property="phone_number", type="string", example="01012345678"),
    *             @OA\Property(property="token", type="string", example="oxhCZlMXXRk6kV28HwNmfeDmA1tqjVrdj41wa2VHgcEmFYQZ8xLPO1CCzG6v"),
    *             @OA\Property(property="password", type="string", example="123456"),
    *             @OA\Property(property="password_confirmation", type="string", example="123456")
    *         )
    *     ),
    *
    *     @OA\Response(
    *         response=200,
    *         description="Get vendor data successfully",
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="status", type="boolean", example=true),
    *             @OA\Property(property="message", type="string", example="Password reset successfully"),
    *             @OA\Property(property="token", type="string", example="80|3dhfAPZheskanpZvHHsiwZG3TwS9HVXUJdih5CZD1b36ce43"),
    *             @OA\Property(
    *                 property="data",
    *                 type="object",
    *                 @OA\Property(property="user_id", type="integer", example=1),
    *                 @OA\Property(property="user_name", type="string", example="Menna"),
    *                 @OA\Property(property="user_slug", type="string", example="menna"),
    *                 @OA\Property(property="user_email", type="string", example="menna_vendor_rep@test.com"),
    *                 @OA\Property(property="user_country_dial_code", type="integer", example="+966"),
    *                 @OA\Property(property="user_phone_number", type="string", example="0501234568"),
    *                 @OA\Property(property="user_account_type", type="string", example="vendor_representative"),
    *                 @OA\Property(
    *                      property="roles",
    *                      type="array",
    *                      @OA\Items(type="string", example="vendor_representative")
    *                 )
    *             )
    *         )
    *     ),
    *
    *     @OA\Response(
    *         response=400,
    *         description="Invalid token or Phone number"
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="User not found"
    *     )
    * )
    *===========================================================================
    * @OA\Post(
    *     path="api/{locale}/user/vendor/auth/logout",
    *     tags={"Vendor Endpoints --- Auth"},
    *     summary="---Logout Endpoint---",
    *     description="Logout vendor Representative",
    *
    *     @OA\Parameter(
    *         name="locale",
    *         in="path",
    *         required=true,
    *         description="Language code",
    *         @OA\Schema(type="string", example="en")
    *     ),
    *
    *     @OA\Response(
    *         response=200,
    *         description="Get vendor data successfully",
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="status", type="string", example="true"),
    *             @OA\Property(property="message", type="string", example="Logged out successfully"),
    *         )
    *     ),
    * )
    */

class VendorAuthSwagger {}
