<?php

namespace App\Swagger\Vendor\Branch;
/**
 * @OA\Get(
 *     path="/api/{locale}/user/vendor/branches/categories/by-branches",
 *     tags={"Vendor - Branch"},
 *     operationId="Get All Categories In Some Branches",
 *     summary="---Get All Categories In Some Branches---",
 *     description="Get All Categories In Some Branches",
 *
 *     @OA\Parameter(
 *         name="locale",
 *         in="path",
 *         required=true,
 *         description="Language code",
 *         @OA\Schema(type="string", example="en")
 *     ),
 *     @OA\Parameter(
 *         name="category_type",
 *         in="path",
 *         required=false,
 *         description="The type of category (sub or main)",
 *         @OA\Schema(type="string", example="main")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                 property="branches_ids",
 *                 type="array",
 *                 @OA\Items(type="integer", example=1)
 *             ),
 *         )
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

class GetCategoriesByBranchesSwagger {}
