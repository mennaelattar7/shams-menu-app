<?php

namespace App\Swagger\Vendor\Lang;
/**
 * @OA\get(
 *     path="/api/{locale}/user/vendor/langs",
 *     tags={"Vendor - Lang"},
 *     summary="---Get  Vendor Langs Endpoint---",
 *     description="Get all Lang of vendor",
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
 *         description="Get Vendor lang successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Get Langs Succefully | No Langs"),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example="3"),
 *                 @OA\Property(property="name", type="string", example="English"),
 *                 @OA\Property(property="code", type="string", example="en"),
 *            )
 *         )
 *     ),
 * )
 */
class GetLangSwagger {}
