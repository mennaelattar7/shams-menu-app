<?php

namespace App\Swagger\Public\Review;
/**
 * @OA\Post(
 *     path="/api/{locale}/user/public/branches/{branch_slug}/reviews/add-review",
 *     tags={"public - Review"},
 *     operationId="Add Review",
 *     summary="---Add Review Endpoint---",
 *     description="Add Review",
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
 *         description="Slug of Branch",
 *         @OA\Schema(type="string", example="eldoky-branch-2")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="phone_number", type="string", example="0501254579"),
 *             @OA\Property(property="rating", type="string", example="0501254579"),
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Review added successfully.",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="string", example="true"),
 *             @OA\Property(property="message", type="string", example="Review added successfully."),
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not Authenticated"
 *     )
 * )
 */

class AddReviewSwagger {}
