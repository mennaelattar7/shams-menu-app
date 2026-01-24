<?php

namespace App\Swagger\Public\Branch;
/**
 * @OA\Get(
 *     path="/api/{locale}/user/public/branches/{branch_slug}/menu-categories",
 *     tags={"Public - Menu Category"},
 *     operationId="All Active Menu Categories",
 *     summary="---Get All Active Menu Categories Endpoint---",
 *     description="Get All Active Menu Categories Data",
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
 *         description="slug of blanch",
 *         @OA\Schema(type="string", example="test")
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

class getMenuCategoriesSwagger {}
