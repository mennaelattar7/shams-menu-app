<?php

namespace App\Swagger\Vendor\MenuCategory;
/**
 * @OA\Get(
 *     path="/api/{locale}/user/vendor/menu-categories/{category_slug}",
 *     tags={"Vendor - Menu Category"},
 *     operationId="Single Menu Category Data",
 *     summary="---Get Single Menu Category Data Endpoint---",
 *     description="Get Single Menu Category Data Endpoint",
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
 *     @OA\Response(
 *         response=200,
 *         description="Get category Data Successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="success"),
 *             @OA\Property(property="message", type="string", example="Get category Succefully"),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="name", type="string", example="branch1"),
 *                 @OA\Property(property="slug", type="string", example="branch1"),
 *                 @OA\Property(
 *                     property="city",
 *                     type="object",
 *                     @OA\Property(property="id", type="integer", example=1),
 *                     @OA\Property(property="name", type="string", example="test"),
 *                 ),
 *                 @OA\Property(
 *                     property="district",
 *                     type="object",
 *                     @OA\Property(property="id", type="integer", example=1),
 *                     @OA\Property(property="name", type="string", example="test"),
 *                 ),
 *                 @OA\Property(property="activation_status", type="string", example="active|inactive")
 *             )
 *         )
 *     ),

 *     @OA\Response(
 *         response=404,
 *         description="this Branch Not exist"
 *     )
 * )
 */

class SingleSwagger {}
