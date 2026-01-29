<?php

namespace App\Swagger\Vendor\Branch;
/**
 * @OA\Put(
 *     path="/api/{locale}/user/vendor/branches/{branch_slug}/toggle-activation",
 *     tags={"Vendor - Branch"},
 *     operationId="Change Toggle Branch Activation",
 *     summary="---Change Toggle Branch Activation---",
 *     description="Change Toggle Branch Activation",
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
 *         description="the sluge of branch",
 *         @OA\Schema(type="string", example="branch-slug")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="activation_status", type="string", example="active|inactive"),
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

class toggleActivationSwagger {}
