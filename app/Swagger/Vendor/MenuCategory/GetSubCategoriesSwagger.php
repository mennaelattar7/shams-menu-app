<?php

namespace App\Swagger\Vendor\MenuCategory;
/**
 * @OA\Get(
 *     path="/api/{locale}/user/vendor/menu-categories/{category_slug}/sub-categories",
 *     tags={"Vendor - Menu Category"},
 *     operationId="All sub Categories",
 *     summary="---Get All sub Categories Endpoint---",
 *     description="Get All Sub Categories Data",
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
 *         description="slug of main category code",
 *         @OA\Schema(type="string", example="maincat")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Get All Sub Categories Successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="success"),
 *             @OA\Property(property="message", type="string", example="Get Sub Categories Succefully"),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="name", type="string", example="menucategory"),
 *                 @OA\Property(property="slug", type="string", example="branch1"),
 *                 @OA\Property(property="activation_status", type="string", example="active|inactive")
 *             ),
 *         )
 *     ),

 *     @OA\Response(
 *         response=404,
 *         description="Not Authenticated"
 *     )
 * )
 */

class GetSubCategoriesSwagger {}
