<?php

namespace App\Http\Controllers\User\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\VendorBranchResource;
use App\Models\VendorBranche;
use Illuminate\Http\Request;

class VendorBranchController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/{locale}/user/branches/{branch_id}",
     *     tags={"Branch Data"},
     *     summary="Get Main Data Of Branch",
     *     description="Return 'Vendor Data' ,'Branch Data' ",
     *
     *     @OA\Parameter(
     *         name="locale",
     *         in="path",
     *         required=true,
     *         description="Language code",
     *         @OA\Schema(type="string", example="en")
     *     ),
     *     @OA\Parameter(
     *         name="branch_id",
     *         in="path",
     *         required=true,
     *         description="the id of branch",
     *         @OA\Schema(type="integer", example="1")
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
     *                         "current_status_opening_hours": "open",
     *                         "phone_number": "1233665566666",
     *                         "address": "نعلﻻلرتﻻتﻻ",
     *                         "google_place_link": "https://maps.app.goo.gl/KaS8Czd6Qmy8suus8",
     *                         "vendor_data": {
     *                               "id": 1,
     *                               "brand_name": "shams",
     *                               "logo": "image",
     *                               "banar": "image",
     *                               "slogan": "Dishes that please the palate"
     *                         }
     *                 },
     *             },
     *             @OA\Property(property="success", type="boolean"),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="Dokki branch"),
     *                     @OA\Property(property="slug", type="string", example="Dokki branch")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function getBranchData($locale,$branch_id)
    {

        $branch = VendorBranche::find($branch_id);
        if($branch->is_active)
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
                'data' => new VendorBranchResource($branch)
            ],403);
        }
    }
}
