<?php

namespace App\Http\Controllers\User\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\VendorBranchResource;
use App\Models\VendorBranche;
use Illuminate\Http\Request;

class VendorBranchController extends Controller
{
    // /**
    //  * @OA\Get(
    //  *     path="/api/{locale}/user/branches/{branch_id}",
    //  *     tags={"Branch Data"},
    //  *     summary="Get Main Data Of Branch",
    //  *     description="Return 'Vendor Data' ,'Branch Data' ",
    //  *
    //  *     @OA\Parameter(
    //  *         name="locale",
    //  *         in="path",
    //  *         required=true,
    //  *         description="Language code",
    //  *         @OA\Schema(type="string", example="en")
    //  *     ),
    //  *     @OA\Parameter(
    //  *         name="branch_id",
    //  *         in="path",
    //  *         required=true,
    //  *         description="the id of branch",
    //  *         @OA\Schema(type="integer", example="1")
    //  *     ),
    //  *
    //  *     @OA\Response(
    //  *         response=200,
    //  *         description="Successful response",
    //  *         @OA\JsonContent(
    //  *             type="object",
    //  *             example={
    //  *                 "success": true,
    //  *                 "data": {
    //  *                         "id": 1,
    //  *                         "name": "Dokki branch",
    //  *                         "slug": "Dokki branch",
    //  *                         "phone_number": "1233665566666",
    //  *                         "address": "نعلﻻلرتﻻتﻻ",
    //  *                         "google_place_link": "https://maps.app.goo.gl/KaS8Czd6Qmy8suus8",
    //  *                         "opening_time": "09:00:00",
    //  *                         "closing_time": "14:00:00",
    //  *                         "current_status_operating_hours": "close",
    //  *                         "branch_socail_media": {
    //  *                             {
    //  *                                  "id": 1,
    //  *                                  "name": "facebook",
    //  *                                  "display_name": "facebook",
    //  *                                  "link": "fghjkl;'lkjhgfhjkl;"
    //  *                             }
    //  *                         },
    //  *                         "vendor_data": {
    //  *                               "id": 1,
    //  *                               "brand_name": "shams",
    //  *                               "logo": "image",
    //  *                               "banar": "image",
    //  *                               "slogan": "Dishes that please the palate",
    //  *                               "vendor_social_media": {
    //  *                                   {
    //  *                                       "id": 1,
    //  *                                       "name": "facebook",
    //  *                                       "display_name": "facebook",
    //  *                                       "link": "fghjkl;'lkjhgfhjkl;"
    //  *                                   }
    //  *                               }
    //  *                         }
    //  *                 },
    //  *             },
    //  *             @OA\Property(
    //  *                 property="success",
    //  *                 type="boolean"
    //  *             ),
    //  *             @OA\Property(
    //  *                 property="data",
    //  *                 type="array",
    //  *                 @OA\Items(
    //  *                     @OA\Property(
    //  *                         property="id",
    //  *                         type="integer",
    //  *                         example=1
    //  *                     ),
    //  *                     @OA\Property(
    //  *                         property="name",
    //  *                         type="string",
    //  *                         example="Dokki branch"
    //  *                     ),
    //  *                     @OA\Property(
    //  *                          property="slug",
    //  *                          type="string",
    //  *                          example="Dokki branch"
    //  *                     ),
    //  *                     @OA\Property(
    //  *                         property="phone_number",
    //  *                         type="string",
    //  *                         example="1233665566666"
    //  *                     ),
    //  *                     @OA\Property(
    //  *                         property="address",
    //  *                         type="string",
    //  *                         example="jhjhvj"
    //  *                     ),
    //  *                     @OA\Property(
    //  *                         property="google_place_link",
    //  *                         type="string",
    //  *                         example="https://maps.app.goo.gl/KaS8Czd6Qmy8suus8"),
    //  *                     @OA\Property(
    //  *                         property="opening_time",
    //  *                         type="string",
    //  *                         example="09:00:00"
    //  *                     ),
    //  *                     @OA\Property(
    //  *                         property="closing_time",
    //  *                         type="string",
    //  *                         example="09:00:00"
    //  *                     ),
    //  *                     @OA\Property(
    //  *                         property="current_status_operating_hours",
    //  *                         type="string",
    //  *                         enum={"open","close"},
    //  *                         example="close"
    //  *                     ),
    //  *                     @OA\Property(
    //  *                         property="branch_socail_media",
    //  *                         type="array",
    //  *                         @OA\Items(
    //  *                             @OA\Property(
    //  *                                 property="id",
    //  *                                 type="integer",
    //  *                                 example=1
    //  *                             ),
    //  *                             @OA\Property(
    //  *                                 property="name",
    //  *                                 type="string",
    //  *                                 example="facebook"
    //  *                             ),
    //  *                             @OA\Property(
    //  *                                property="display_name",
    //  *                                type="string",
    //  *                                example="facebook"
    //  *                             ),
    //  *                             @OA\Property(
    //  *                               property="link",
    //  *                               type="string",
    //  *                               example="ghjkjhghjhghj"
    //  *                            ),
    //  *                         )
    //  *                     ),
    //  *                     @OA\Property(
    //  *                         property="vendor_data",
    //  *                         type="array",
    //  *                         @OA\Items(
    //  *                             @OA\Property(
    //  *                                 property="id",
    //  *                                 type="integer",
    //  *                                 example=1
    //  *                             ),
    //  *                             @OA\Property(
    //  *                                 property="brand_name",
    //  *                                 type="string",
    //  *                                 example="shams"
    //  *                             ),
    //  *                             @OA\Property(
    //  *                                 property="logo",
    //  *                                 type="string",
    //  *                                 example="image src"
    //  *                             ),
    //  *                             @OA\Property(
    //  *                                 property="banar",
    //  *                                 type="string",
    //  *                                 example="image src"
    //  *                             ),
    //  *                             @OA\Property(
    //  *                                 property="slogan",
    //  *                                 type="string",
    //  *                                 example="Dishes that please the palate"
    //  *                             ),
    //  *                             @OA\Property(
    //  *                                 property="vendor_social_media",
    //  *                                 type="array",
    //  *                                 @OA\Items(
    //  *                                     @OA\Property(
    //  *                                         property="id",
    //  *                                         type="integer",
    //  *                                         example=1
    //  *                                     ),
    //  *                                     @OA\Property(
    //  *                                         property="name",
    //  *                                         type="string",
    //  *                                         example="facebook"
    //  *                                     ),
    //  *                                     @OA\Property(
    //  *                                         property="display_name",
    //  *                                         type="string",
    //  *                                         example="facebook"
    //  *                                     ),
    //  *                                     @OA\Property(
    //  *                                         property="link",
    //  *                                         type="string",
    //  *                                         example="ghjkjhghjhghj"
    //  *                                     ),
    //  *                                 )
    //  *                             )
    //  *                         )
    //  *                     )
    //  *                 )
    //  *             )
    //  *         )
    //  *     ),
    //  *     @OA\Response(
    //  *         response=403,
    //  *         description="Failed response",
    //  *         @OA\JsonContent(
    //  *             type="object",
    //  *             example={
    //  *                 "success": false,
    //  *                 "message": "This branch not Active Now"
    //  *             },
    //  *             @OA\Property(
    //  *                 property="success",
    //  *                 type="boolean"
    //  *             ),
    //  *             @OA\Property(
    //  *                 property="message",
    //  *                 type="string"
    //  *             ),
    //  *         )
    //  *     ),
    //  * )
    //  */
    public function getBranchData($locale,$branch_id)
    {
        $branch = VendorBranche::find($branch_id);
        if($branch->activation_status == "active")
        {
            return response()->json([
                'success' => true,
                'message' => 'Branch retrieved successfully',
                'data' => new VendorBranchResource($branch)
            ],200);
        }
        else
        {
            return response()->json([
                'success' => false,
                'message' =>'This branch not Active Now',
            ],403);
        }
    }
}
