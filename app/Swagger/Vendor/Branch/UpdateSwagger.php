<?php

namespace App\Swagger\Vendor\Branch;
/**
 * @OA\Put(
 *     path="/api/{locale}/user/vendor/branches/{slug}",
 *     tags={"Vendor - Branch"},
 *     operationId="Update Branch Data",
 *     summary="---Update Branch Data---",
 *     description="Update Branch Data",
 *
 *     @OA\Parameter(
 *         name="locale",
 *         in="path",
 *         required=true,
 *         description="Language code",
 *         @OA\Schema(type="string", example="en")
 *     ),
 *     @OA\Parameter(
 *         name="slug",
 *         in="path",
 *         required=true,
 *         description="the sluge of branch",
 *         @OA\Schema(type="string", example="branch-slug")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                 property="name",
 *                 type="object",
 *                 @OA\Property(property="en", type="string", example="branch1"),
 *                 @OA\Property(property="ar", type="string", example="branch1")
 *             ),
 *             @OA\Property(property="city_id", type="integer", example="1"),
 *             @OA\Property(property="district_id", type="integer", example="1"),
 *             @OA\Property(property="google_map_link", type="string", example="https://maps.app.goo.gl/HXVbNNgQfSUFZkvK7"),
 *             @OA\Property(property="phone_number", type="string", example="0501234567"),
 *             @OA\Property(property="whatsapp_number", type="string", example="0501234567"),
 *             @OA\Property(property="number_of_tables", type="integer", example="5"),
 *             @OA\Property(property="activation_status", type="string", example="active"),
 *             @OA\Property(
 *                 property="operating_hours",
 *                 type="array",
 *                 @OA\Items(
 *                     type="object",
 *                     @OA\Property(property="day_of_week", type="integer", example="1"),
 *                     @OA\Property(
 *                         property="shifts",
 *                         type="array",
 *                         @OA\Items(
 *                             type="object",
 *                             @OA\Property(property="start_time", type="string", example="09:00:00"),
 *                             @OA\Property(property="end_time", type="string", example="09:00:00"),
 *                             @OA\Property(property="is_open", type="string", example="yes"),
 *                         )
 *                     )
 *                )
 *             ),
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Get vendor data successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="string", example="true"),
 *             @OA\Property(property="message", type="string", example="Branch updated successfully"),
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not Authenticated"
 *     )
 * )
 */

class UpdateSwagger {}
