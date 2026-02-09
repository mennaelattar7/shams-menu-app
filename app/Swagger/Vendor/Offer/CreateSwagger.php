<?php

namespace App\Swagger\Vendor\Offer;
/**
 * @OA\Post(
 *     path="/api/{locale}/user/vendor/offers/create",
 *     tags={"Vendor - Offer"},
 *     operationId="Create Offer",
 *     summary="---Create Offer Endpoint---",
 *     description="Create New Offer",
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
 *             required={"branch_id","name","discount_type","discount_value","start_date","end_date","activation_status"},
 *             type="object",
 *             @OA\Property(property="branch_id", type="integer", example="19"),
 *             @OA\Property(property="category_id", type="integer", example="19"),
 *             @OA\Property(
 *                 property="product_ids",
 *                 type="array",
 *                 @OA\Items(type="integer", example=1)
 *             ),
 *             @OA\Property(
 *                 property="name",
 *                 type="object",
 *                 @OA\Property(property="en", type="string", example="offer1"),
 *                 @OA\Property(property="ar", type="string", example="offer1")
 *             ),
 *             @OA\Property(property="discount_type", type="string", example="fixed Or percentage"),
 *             @OA\Property(property="discount_value", type="integer", example="50"),
 *             @OA\Property(property="start_date", type="string", example="2026-12-11"),
 *             @OA\Property(property="end_date", type="string", example="2026-12-11"),
 *             @OA\Property(property="activation_status", type="string", example="active"),
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Assign Offer To Products Successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="string", example="true"),
 *             @OA\Property(property="message", type="string", example="Product added successfully"),
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not Authenticated"
 *     )
 * )
 */

class CreateSwagger {}
