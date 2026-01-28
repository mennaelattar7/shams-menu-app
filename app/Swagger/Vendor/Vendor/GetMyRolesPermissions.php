<?php

namespace App\Swagger\Vendor\Vendor;
/**
 * @OA\Get(
 *     path="/api/{locale}/user/vendor/settings/my-roles-permissions",
 *     tags={"Vendor - Settings"},
 *     operationId="Get Roles And permissions",
 *     summary="---Get Roles And permissions Endpoint---",
 *     description="Get Roles And permissions Endpoint",
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
 *         description="Get Roles And permissions Successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="success"),
 *             @OA\Property(property="message", type="string", example="Get Roles And permissions Succefully"),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="representative_vendor_name", type="string", example="mennarep"),
 *                 @OA\Property(
 *                     property="roles",
 *                         type="array",
 *                         @OA\Items(type="string", example="vendor_representative")
 *                 ),
 *                 @OA\Property(
 *                     property="permissions",
 *                         type="array",
 *                         @OA\Items(type="string", example="all_product")
 *                 ),
 *             )
 *         )
 *     ),

 *     @OA\Response(
 *         response=404,
 *         description="Not Authenticated"
 *     )
 * )
 */

class GetMyRolesPermissions {}
