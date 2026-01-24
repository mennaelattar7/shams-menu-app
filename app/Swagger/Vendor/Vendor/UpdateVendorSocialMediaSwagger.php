<?php

namespace App\Swagger\Vendor\Vendor;
/**
 * @OA\post(
 *     path="/api/{locale}/user/vendor/settings/vendor-data/update-social-media",
 *     tags={"Vendor - Settings"},
 *     operationId="update-social-media vendor ",
 *     summary="---update-social-media vendor ---",
 *     description="update-social-media vendor ",
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
 *             required={"social_media"},
 *             @OA\Property(
 *                 property="social_media",
 *                 type="array",
 *                 @OA\Items(
 *                     type="object",
 *                     required={"social_media_icon_id","link"},
 *                     @OA\Property(
 *                         property="social_media_icon_id",
 *                         type="integer",
 *                         example=1
 *                     ),
 *                     @OA\Property(
 *                         property="link",
 *                         type="string",
 *                         format="url",
 *                         example="https://www.facebook.com/vendor"
 *                     )
 *                 )
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Social media saved successfully"
 *     )
 * )
 */


class UpdateVendorSocialMediaSwagger {}
