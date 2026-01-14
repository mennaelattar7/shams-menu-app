<?php

namespace App\Swagger\Vendor\Lang;
/**
 * @OA\Post(
 *     path="/api/{locale}/user/vendor/langs/select-langs",
 *     tags={"Vendor Endpoints --- Lang"},
 *     summary="---Select Vendor Langs Endpoint---",
 *     description="add or remove lang from vendor",
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
 *             @OA\Property(property="lang_id", type="integer", example="3")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Lang toggled successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Language added or removed"),
 *             @OA\Property(property="action", type="string", example="added | removed")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="lang not found",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="This Lang Not exist")
 *         )
 *     ),
 * )
 */
class SelectLangSwagger {}
