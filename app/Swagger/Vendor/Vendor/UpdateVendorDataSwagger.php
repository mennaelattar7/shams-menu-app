<?php

namespace App\Swagger\Vendor\Vendor;
/**
 * @OA\post(
 *     path="/api/{locale}/user/vendor/settings/vendor-data/update",
 *     tags={"Vendor - Settings"},
 *     operationId="Update vendor Data",
 *     summary="---Update vendor Data---",
 *     description="Update vendor Data",
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
 *                 property="company_name",
 *                 type="object",
 *                 @OA\Property(property="en", type="string", example="company_name"),
 *                 @OA\Property(property="ar", type="string", example="company_name")
 *             ),
 *             @OA\Property(
 *                 property="brand_name",
 *                 type="object",
 *                 @OA\Property(property="en", type="string", example="brand_name"),
 *                 @OA\Property(property="ar", type="string", example="brand_name")
 *             ),
 *             @OA\Property(property="logo", type="string", example="logo"),
 *             @OA\Property(property="banar", type="string", example="banar"),
 *             @OA\Property(
 *                 property="slogan",
 *                 type="object",
 *                 @OA\Property(property="en", type="string", example="slogan"),
 *                 @OA\Property(property="ar", type="string", example="slogan")
 *             ),
 *             @OA\Property(
 *                 property="currency_ids",
 *                 type="array",
 *                 @OA\Items(type="integer", example=1)
 *             ),
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Get vendor data successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="string", example="true"),
 *             @OA\Property(property="message", type="string", example="Branch updated successfully"),
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not Authenticated"
 *     )
 * )
 */

class UpdateVendorDataSwagger {}
