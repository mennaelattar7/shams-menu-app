<?php

namespace App\Swagger\Vendor\MenuCategory;
/**
 * @OA\Get(
 *     path="/api/{locale}/user/vendor/menu-categories",
 *     tags={"Vendor - Menu Category"},
 *     operationId="All Menu Categories",
 *     summary="---Get All Menu Categories Endpoint---",
 *     description="Get All Menu Categories Data",
 *
 *     @OA\Parameter(
 *         name="locale",
 *         in="path",
 *         required=true,
 *         description="Language code",
 *         @OA\Schema(type="string", example="en")
 *     ),
 *     @OA\Parameter(
 *         name="per_page",
 *         in="query",
 *         required=false,
 *         description="Number of items per page for pagination",
 *         @OA\Schema(type="integer", example="3")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Get All Menu Categories Successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="success"),
 *             @OA\Property(property="message", type="string", example="Get Menu Categories Succefully"),
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

class IndexSwagger {}
