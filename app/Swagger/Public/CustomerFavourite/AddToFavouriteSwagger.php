<?php

namespace App\Swagger\Public\CustomerFavourite;
/**
 * @OA\Post(
 *     path="/api/{locale}/user/public/customers/{branch_slug}/add-to-favourite",
 *     tags={"public - Customer [Favourite]"},
 *     operationId="Add Product To Favourite List",
 *     summary="---Add Product To Favourite List Endpoint---",
 *     description="Add Product To Favourite Listh",
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
 *                 property="products_ids",
 *                 type="array",
 *                 @OA\Items(
 *                     type="object",
 *                     @OA\Property(property="products_ids", type="integer", example="1"),
 *                )
 *             ),
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Add Product To Favourite List",
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

class AddToFavouriteSwagger {}
