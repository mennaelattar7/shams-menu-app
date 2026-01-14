<?php

namespace App\Swagger\Branch;
/**
 * @OA\Post(
 *     path="/api/{locale}/user/vendor/menu_category/create",
 *     tags={"Vendor Endpoints"},
 *     summary="---Create Menu Category Endpoint---",
 *     description="Create New Menu Category",
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
 *         description="Get vendor data successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="success"),
 *             @OA\Property(property="message", type="string", example="success Login"),
 *             @OA\Property(property="token", type="string", example="38|hmKx2mys6d2wKJw75x4qR3AVvoIuF69RwHMhk8EF7ab40fbb"),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="user_id", type="integer", example=1),
 *                 @OA\Property(property="user_name", type="string", example="Menna"),
 *                 @OA\Property(property="user_slug", type="string", example="menna"),
 *                 @OA\Property(property="user_email", type="string", example="menna_vendor_rep@test.com"),
 *                 @OA\Property(property="user_country_dial_code_id", type="integer", example="242"),
 *                 @OA\Property(property="user_phone_number", type="string", example="0501234567"),
 *                 @OA\Property(property="user_account_type", type="string", example="vendor_representative"),
 *                 @OA\Property(
 *                      property="vendor_representative",
 *                      type="object",
 *                      @OA\Property(property="vendor_rep_id", type="integer", example=1),
 *                      @OA\Property(property="vendor_rep_position", type="string", example="manager"),
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not Authenticated"
 *     )
 * )
 */
