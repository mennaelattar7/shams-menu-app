<?php

namespace App\Swagger\Vendor\Vendor;

/**
 * @OA\Post(
 *     path="/api/{locale}/user/vendor/settings/vendor-data/update-social-media",
 *     tags={"Vendor - Settings"},
 *     operationId="updateSocialMediaVendor",
 *     summary="Update vendor social media links",
 *     description="Update social media links of the authenticated vendor",
 *
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
 *             description="Keys are social media names and values are their links",
 *             @OA\AdditionalProperties(
 *                 type="string",
 *                 format="url",
 *                 example="https://www.facebook.com/vendor"
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Social media of vendor updated successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Social Media Of Vendor Updated Successfully")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized. Token is missing or invalid.",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Unauthorized. Token is missing or invalid.")
 *         )
 *     )
 * )
 */
class UpdateVendorSocialMediaSwagger {}
