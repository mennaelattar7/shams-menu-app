<?php

namespace App\Swagger\Public\Branch;
    /**
     * @OA\Get(
     *     path="/api/{locale}/user/public/branches/{branch_slug}",
     *     tags={"Public - Branch"},
     *     summary="Get Main Data Of Branch",
     *     description="Get Main Data Of Branch",
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
     *         description="the slug of branch",
     *         @OA\Schema(type="integer", example="eldoky-branch-2")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *             type="object",
     *             example={
     *                 "success": true,
     *                 "data": {
     *                         "id": 1,
     *                         "name": "Dokki branch",
     *                         "slug": "Dokki branch",
     *                         "phone_number": "1233665566666",
     *                         "address": "نعلﻻلرتﻻتﻻ",
     *                         "google_map_link": "https://maps.app.goo.gl/KaS8Czd6Qmy8suus8",
     *                         "start_time": "09:00:00",
     *                         "end_time": "14:00:00",
     *                         "current_status_operating_hours": "close",
     *                 },
     *             },
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean"
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(
     *                         property="id",
     *                         type="integer",
     *                         example=1
     *                     ),
     *                     @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="Dokki branch"
     *                     ),
     *                     @OA\Property(
     *                          property="slug",
     *                          type="string",
     *                          example="Dokki branch"
     *                     ),
     *                     @OA\Property(
     *                         property="phone_number",
     *                         type="string",
     *                         example="1233665566666"
     *                     ),
     *                     @OA\Property(
     *                         property="address",
     *                         type="string",
     *                         example="jhjhvj"
     *                     ),
     *                     @OA\Property(
     *                         property="google_map_link",
     *                         type="string",
     *                         example="https://maps.app.goo.gl/KaS8Czd6Qmy8suus8"),
     *                     @OA\Property(
     *                         property="start_time",
     *                         type="string",
     *                         example="09:00:00"
     *                     ),
     *                     @OA\Property(
     *                         property="end_time",
     *                         type="string",
     *                         example="09:00:00"
     *                     ),
     *                     @OA\Property(
     *                         property="current_status_operating_hours",
     *                         type="string",
     *                         enum={"open","close"},
     *                         example="close"
     *                     ),
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Failed response",
     *         @OA\JsonContent(
     *             type="object",
     *             example={
     *                 "success": false,
     *                 "message": "This branch not Active Now"
     *             },
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean"
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string"
     *             ),
     *         )
     *     ),
     * )
     */

class GetBranchDataSwagger {}
