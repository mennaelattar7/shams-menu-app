<?php

namespace App\Swagger\Vendor\TableRequest;
/**
 * @OA\Post(
 *     path="/api/{locale}/user/vendor/table-requests/{request_id}/respond",
 *     tags={"Vendor - TableRequest"},
 *     operationId="Respond Table Request",
 *     summary="---Respond Table Request---",
 *     description="Respond Table Request",
 *
 *     @OA\Parameter(
 *         name="locale",
 *         in="path",
 *         required=true,
 *         description="Language code",
 *         @OA\Schema(type="string", example="en")
 *     ),
 *     @OA\Parameter(
 *         name="request_id",
 *         in="path",
 *         required=true,
 *         description="the Table Request Id",
 *         @OA\Schema(type="integer", example="5")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="in_progress,completed,cancelled"),
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Respond Table Request",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="string", example="true"),
 *             @OA\Property(property="message", type="string", example="The request has been responded to."),
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not Authenticated"
 *     )
 * )
 */

class RespondSwagger {}
