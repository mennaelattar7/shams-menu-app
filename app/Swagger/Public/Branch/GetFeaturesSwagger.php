<?php

namespace App\Swagger\Public\Branch;
/**
 * @OA\Get(
 *     path="/api/{locale}/user/public/branches/{branch_slug}/features",
 *     tags={"Public - Branch"},
 *     operationId="All features In one branch",
 *     summary="---Get All features In branch Endpoint---",
 *     description="Get All features In branchy",
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
 *         description="branch Slug",
 *         @OA\Schema(type="string", example="cat1")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Get All features in Branch Successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="success"),
 *             @OA\Property(property="message", type="string", example="Get features Succefully"),
 *             @OA\Property(
 *                 property="data",
 *                 type="array",
 *                 @OA\Items(
 *                     type="object",
 *                     @OA\Property(property="id", type="integer", example=1),
 *                     @OA\Property(property="name", type="string", example="Nigresco pasta"),
 *                     @OA\Property(property="slug", type="string", example="Nigresco pasta"),
 *                     @OA\Property(property="activation_status", type="string", example="active"),
 *                     @OA\Property(
 *                         property="variants",
 *                         type="array",
 *                         @OA\Items(
 *                             type="object",
 *                             @OA\Property(property="id", type="integer", example="1"),
 *                             @OA\Property(property="name", type="string", example="Small"),
 *                             @OA\Property(property="price", type="string", example="250.00"),
 *                             @OA\Property(property="price_after_discount", type="string", example="250.00"),
 *                             @OA\Property(property="activation_status", type="string", example="active"),
 *                         )
 *                     ),
 *                     @OA\Property(
 *                         property="category",
 *                         type="object",
 *                         @OA\Property(property="id", type="integer", example=1),
 *                         @OA\Property(property="parent_category", type="string", example="Breakfast"),
 *                         @OA\Property(property="name", type="string", example="test"),
 *                         @OA\Property(property="slug", type="string", example="cat2"),
 *                     ),
 *                 ),
 *               ),
*                  @OA\Property(
*                      property="links",
*                      type="object",
*                      nullable=true,
*                      @OA\Property(property="first", type="string", example="http://127.0.0.1:8000/api/en/user/vendor/branches?per_page=3"),
*                      @OA\Property(property="last", type="string", example="http://127.0.0.1:8000/api/en/user/vendor/branches?per_page=3&page=2"),
*                      @OA\Property(property="prev", type="string", example=null),
*                      @OA\Property(property="next", type="string", example="http://127.0.0.1:8000/api/en/user/vendor/branches?per_page=3&page=2")
*                  ),
*                  @OA\Property(
*                      property="meta",
*                      type="object",
*                      nullable=true,
*                      @OA\Property(property="current_page", type="integer", example=1),
*                      @OA\Property(property="from", type="integer", example=1),
*                      @OA\Property(property="last_page", type="integer", example=2),
*                      @OA\Property(property="per_page", type="integer", example=3),
*                      @OA\Property(property="to", type="integer", example=3),
*                      @OA\Property(property="total", type="integer", example=6)
*                  )
*             )
*          ),

 *     @OA\Response(
 *         response=404,
 *         description="Not Authenticated"
 *     )
 * )
 */

class GetFeaturesSwagger {}
