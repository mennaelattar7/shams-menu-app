<?php

namespace App\Swagger\Vendor\Vendor;
/**
 * @OA\Get(
 *     path="/api/{locale}/user/vendor/settings/vendor-data",
 *     tags={"Vendor - Settings"},
 *     operationId="Single Vendor Data",
 *     summary="---Get Single Vendor Data Endpoint---",
 *     description="Get Single Vendor Data Endpoint",
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
 *         description="Get Vendor Data Successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="success"),
 *             @OA\Property(property="message", type="string", example="Get Vendor Succefully"),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="company_name", type="string", example="com1"),
 *                 @OA\Property(property="brand_name", type="string", example="com1"),
 *                 @OA\Property(property="logo", type="string", example="com1"),
 *                 @OA\Property(property="banar", type="string", example="com1"),
 *                 @OA\Property(property="slogan", type="string", example="com1"),
 *                 @OA\Property(property="more_details", type="string", example="com1"),
 *             )
 *         )
 *     ),

 *     @OA\Response(
 *         response=404,
 *         description="Not Authenticated"
 *     )
 * )
 */

class GetDataSwagger {}
