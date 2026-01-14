<?php

namespace App\Swagger\Vendor\Branch;
/**
 * @OA\Post(
 *     path="/api/{locale}/user/vendor/branches/create",
 *     tags={"Vendor Endpoints --- Branch"},
 *     operationId="Create Branch",
 *     summary="---Create Branch Endpoint---",
 *     description="Create New Branch",
 *
 *     @OA\Parameter(
 *         name="locale",
 *         in="path",
 *         required=true,
 *         description="Language code",
 *         @OA\Schema(type="string", example="en")
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
 *             @OA\Property(property="status", type="string", example="success"),
 *             @OA\Property(property="message", type="string", example="success Login"),
 *             @OA\Property(property="token", type="string", example="38|hmKx2mys6d2wKJw75x4qR3AVvoIuF69RwHMhk8EF7ab40fbb"),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="user_id", type="integer", example=1),
 *                 @OA\Property(property="user_name", type="string", example="Menna"),
 *                 @OA\Property(property="user_slug", type="string", example="menna"),
 *                 @OA\Property(property="user_email", type="string", example="menna_vendor_rep@test.com"),
 *                 @OA\Property(property="user_country_dial_code_id", type="integer", example="242"),
 *                 @OA\Property(property="user_phone_number", type="string", example="0501234567"),
 *                 @OA\Property(property="user_account_type", type="string", example="vendor_representative"),
 *                 @OA\Property(
 *                      property="vendor_representative",
 *                      type="object",
 *                      @OA\Property(property="vendor_rep_id", type="integer", example=1),
 *                      @OA\Property(property="vendor_rep_position", type="string", example="manager"),
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not Authenticated"
 *     )
 * )
 */

class CreateSwagger {}
