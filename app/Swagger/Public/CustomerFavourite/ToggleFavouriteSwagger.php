<?php

namespace App\Swagger\Public\CustomerFavourite;
/**
 * @OA\Post(
 *     path="/api/{locale}/user/public/customers/{branch_slug}/toggle-favourite",
 *     tags={"public - Customer [Favourite]"},
 *     operationId="Add and remove Product To Favourite List",
 *     summary="---Add and remove Product To Favourite List---",
 *     description="Add and remove Product To Favourite List",
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
 *             @OA\Property(
 *                 property="product_slug",
 *                 type="string",
 *                 example="mkron-ngrsko"
 *             ),
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Product Removed from Favourite List",
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

class ToggleFavouriteSwagger {}
