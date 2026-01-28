<?php

namespace App\Swagger\Vendor\Vendor;

/**
 * @OA\Post(
 *     path="/api/{locale}/user/vendor/settings/vendor-data/update-ratings",
 *     tags={"Vendor - Settings"},
 *     operationId="updateRatingsVendor",
 *     summary="Update vendor ratings",
 *     description="Update ratings of the authenticated vendor",
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
 *             @OA\Property(property="rating", type="integer", example=4),
 *             @OA\Property(property="ratings_count", type="integer", example=12),
 *             @OA\Property(property="message_notes", type="string", example="kjbkjbkj"),
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
class UpdateVendorRatingsSwagger {}
