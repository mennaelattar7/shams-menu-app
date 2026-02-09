<?php

namespace App\Swagger\Vendor\Branch;
/**
 * @OA\Get(
 *     path="/api/{locale}/user/vendor/branches/{branch_slug}/products/{availability_status?}",
 *     tags={"Vendor - Branch"},
 *     operationId="Get All Products In Branch ",
 *     summary="---Get All Products In Branch---",
 *     description="Get All Products In Branch ",
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
 *         description="the sluge of branch",
 *         @OA\Schema(type="string", example="branch-slug")
 *     ),
 *     @OA\Parameter(
 *         name="availability_status",
 *         in="path",
 *         required=false,
 *         description="The availability status ('available', 'not_available' Or 'null)",
 *         @OA\Schema(type="string", example="available")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Get All Products Successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="success"),
 *             @OA\Property(property="message", type="string", example="Get Branch Products successfully"),
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

class GetProductsSwagger {}
