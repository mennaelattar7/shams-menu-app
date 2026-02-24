<?php

namespace App\Swagger\Vendor\Permission;
/**
 * @OA\Get(
 *     path="/api/{locale}/user/vendor/permissions",
 *     tags={"Vendor - Permission"},
 *     operationId="All Permissions",
 *     summary="---Get All Permissions In Vendor Endpoint---",
 *     description="Get All Permissions In Vendor",
 *
 *     @OA\Parameter(
 *         name="locale",
 *         in="path",
 *         required=true,
 *         description="Language code",
 *         @OA\Schema(type="string", example="en")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Get All Permissions in vendor Successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="success"),
 *             @OA\Property(property="message", type="string", example="Get Permission Succefully"),
 *             @OA\Property(
 *                 property="data",
 *                 type="array",
 *                 @OA\Items(
 *                     type="object",
 *                     @OA\Property(property="id", type="integer", example=1),
 *                     @OA\Property(property="display_name", type="string", example="create_product"),
 *                 ),
 *               ),
*             )
*          ),

 *     @OA\Response(
 *         response=404,
 *         description="Not Authenticated"
 *     )
 * )
 */

class IndexSwagger {}
