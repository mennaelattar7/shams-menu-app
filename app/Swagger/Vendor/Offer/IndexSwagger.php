<?php

namespace App\Swagger\Vendor\Offer;
/**
 * @OA\Get(
 *     path="/api/{locale}/user/vendor/offers",
 *     tags={"Vendor - Offer"},
 *     operationId="All Offers",
 *     summary="---Get All Offers In Vendor Endpoint---",
 *     description="Get All Offers In Vendor",
 *
 *     @OA\Parameter(
 *         name="locale",
 *         in="path",
 *         required=true,
 *         description="Language code",
 *         @OA\Schema(type="string", example="en")
 *     ),
 *     @OA\Parameter(
 *         name="activation_status",
 *         in="path",
 *         required=false,
 *         description="activation_status ('active', 'inactive')",
 *         @OA\Schema(type="string", example="active")
 *     ),
 *     @OA\Parameter(
 *         name="discount_type",
 *         in="path",
 *         required=false,
 *         description="discount_type ('fixed', 'percentage')",
 *         @OA\Schema(type="string", example="fixed")
 *     ),
 *     @OA\Parameter(
 *         name="start_date",
 *         in="path",
 *         required=false,
 *         description="start_date",
 *         @OA\Schema(type="string", example="2026-12-11")
 *     ),
 *     @OA\Parameter(
 *         name="end_date",
 *         in="path",
 *         required=false,
 *         description="end_date",
 *         @OA\Schema(type="string", example="2026-12-11")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Get All Offers in vendor Successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="success"),
 *             @OA\Property(property="message", type="string", example="Get Offer Succefully"),
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

class IndexSwagger {}
