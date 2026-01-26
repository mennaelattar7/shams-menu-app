<?php

namespace App\Swagger\Public\Branch;
/**
 * @OA\Post(
 *     path="/api/{locale}/user/public/table-requests/send-request",
 *     tags={"Public - Branch"},
 *     operationId="Send Table Request",
 *     summary="---Send Table Request Endpoint---",
 *     description="Create New Table Request",
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
 *             @OA\Property(property="table_id", type="integer", example="1"),
 *             @OA\Property(property="request_type", type="string", example="invoice"),
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Add Branch data successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="string", example="true"),
 *             @OA\Property(property="message", type="string", example="Branch added successfully"),
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not Authenticated"
 *     )
 * )
 */

class SendTableRequestSwagger {}
