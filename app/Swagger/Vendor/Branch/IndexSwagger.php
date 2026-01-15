<?php

namespace App\Swagger\Vendor\Branch;
/**
 * @OA\Get(
 *     path="/api/{locale}/user/vendor/branches",
 *     tags={"Vendor - Branch"},
 *     operationId="All Branchs",
 *     summary="---Get All Branchs Endpoint---",
 *     description="Get All Branchs Branch",
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
 *         description="Get All Branches Successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="success"),
 *             @OA\Property(property="message", type="string", example="Get Branches Succefully"),
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
 *             ),
*              @OA\Property(
*                  property="links",
*                  type="object",
*                  nullable=true,
*                  @OA\Property(property="first", type="string", example="http://127.0.0.1:8000/api/en/user/vendor/branches?per_page=3"),
*                  @OA\Property(property="last", type="string", example="http://127.0.0.1:8000/api/en/user/vendor/branches?per_page=3&page=2"),
*                  @OA\Property(property="prev", type="string", example=null),
*                  @OA\Property(property="next", type="string", example="http://127.0.0.1:8000/api/en/user/vendor/branches?per_page=3&page=2")
*              ),
*              @OA\Property(
*                  property="meta",
*                  type="object",
*                  nullable=true,
*                  @OA\Property(property="current_page", type="integer", example=1),
*                  @OA\Property(property="from", type="integer", example=1),
*                  @OA\Property(property="last_page", type="integer", example=2),
*                  @OA\Property(property="per_page", type="integer", example=3),
*                  @OA\Property(property="to", type="integer", example=3),
*                  @OA\Property(property="total", type="integer", example=6)
*              )
 *         )
 *     ),

 *     @OA\Response(
 *         response=404,
 *         description="Not Authenticated"
 *     )
 * )
 */

class IndexSwagger {}
