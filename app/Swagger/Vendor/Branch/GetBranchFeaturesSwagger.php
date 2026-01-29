<?php

namespace App\Swagger\Vendor\Branch;
/**
 * @OA\Get(
 *     path="/api/{locale}/user/vendor/branches/{branch_slug}/features",
 *     tags={"Vendor - Branch"},
 *     operationId="Branch Features",
 *     summary="---Get Branch Features Endpoint---",
 *     description="Get Branch Features Endpoint",
 *
 *     @OA\Parameter(
 *         name="locale",
 *         in="path",
 *         required=true,
 *         description="Language code",
 *         @OA\Schema(type="string", example="en")
 *     ),
 *     @OA\Parameter(
 *         name="branch_slug",
 *         in="path",
 *         required=true,
 *         description="Slug Of Branch",
 *         @OA\Schema(type="string", example="branch1")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Get Branch Features Successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="success"),
 *             @OA\Property(property="message", type="string", example="Get Branch Features Successfuly"),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="name", type="string", example="branch1"),
 *                 @OA\Property(property="slug", type="string", example="branch1"),
 *                 @OA\Property(property="code", type="string", example="branch1"),
 *                 @OA\Property(property="description", type="string", example="branch1"),
 *                 @OA\Property(property="activation_status", type="string", example="active|inactive")
 *             )
 *         )
 *     ),

 *     @OA\Response(
 *         response=404,
 *         description="this Branch Not exist"
 *     )
 * )
 */

class GetBranchFeaturesSwagger {}
