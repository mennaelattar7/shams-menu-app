<?php

namespace App\Swagger\Vendor\Branch;
/**
 * @OA\Get(
 *     path="/api/{locale}/user/vendor/branches/{branch_slug}/table_requests/issue",
 *     tags={"Vendor - Branch"},
 *     operationId="Get All Table Requests In Branche",
 *     summary="---Get All Table Requests In Branche---",
 *     description="Get All Table Requests In Branche",
 *
 *     @OA\Parameter(
 *         name="locale",
 *         in="path",
 *         required=true,
 *         description="Language code",
 *         @OA\Schema(type="string", example="en")
 *     ),
 *     @OA\Parameter(
 *         name="request_type",
 *         in="query",
 *         required=false,
 *         description="The type of Request ('invoice','issue','ready_to_order','other')",
 *         @OA\Schema(type="string",enum={'invoice','issue','ready_to_order','other'} , example="invoice")
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

class GetTableRequestsSwagger {}
