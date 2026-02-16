<?php

namespace App\Swagger\Vendor\MenuCategory;
/**
 * @OA\Post(
 *     path="/api/{locale}/user/vendor/menu-categories/{category_slug}/update",
 *     tags={"Vendor - Menu Category"},
 *     summary="---Update Menu Category Endpoint---",
 *     description="Update New Menu Category",
 *
 *     @OA\Parameter(
 *         name="locale",
 *         in="path",
 *         required=true,
 *         description="Language code",
 *         @OA\Schema(type="string", example="en")
 *     ),
 *     @OA\Parameter(
 *         name="category_slug",
 *         in="path",
 *         required=true,
 *         description="Slug Of category",
 *         @OA\Schema(type="string", example="category6")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="parent_category_id", type="integer", example="1"),
 *             @OA\Property(
 *                 property="name",
 *                 type="object",
 *                 @OA\Property(property="en", type="string", example="cat1"),
 *                 @OA\Property(property="ar", type="string", example="cat1")
 *             ),
 *             @OA\Property(property="activation_status", type="string", example="active"),
 *             @OA\Property(property="sort", type="integer", example="1"),
 *             @OA\Property(property="image", type="string", example="image"),
 *             @OA\Property(property="array_branches_ids", type="string", example="2,3,4"),
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Add Menu Category successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="string", example="true"),
 *             @OA\Property(property="message", type="string", example="menu Category added successfully"),
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not Authenticated"
 *     )
 * )
 */
class UpdateSwagger{}
