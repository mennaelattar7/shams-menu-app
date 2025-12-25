<?php

namespace App\Http\Controllers\User\API\Meta;

use App\Http\Controllers\Controller;
use App\Http\Resources\VendorTypeResource;
use App\Models\VendorType;
use Illuminate\Http\Request;

class VendorTypeController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/{locale}/user/meta/vendor-types",
     *     tags={"App Meta"},
     *     summary="Get active vendor types",
     *     description="Return list of active vendor types",
     *
     *     @OA\Parameter(
     *         name="locale",
     *         in="path",
     *         required=true,
     *         description="Language code",
     *         @OA\Schema(type="string", example="en")
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
     *                     {
     *                         "id": 1,
     *                         "name": "Restaurant",
     *                     }
     *                 },
     *                 "meta": {
     *                     {
     *                          "count":1
     *                     }
     *                 },
     *             },
     *             @OA\Property(property="success", type="boolean"),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="Restaurant"),
     *                 )
     *             ),
     *             @OA\Property(property="meta", type="integer",example=1),
     *         )
     *     )
     * )
     */

    public function allItems($locale,Request $request)
    {
        $all_vendor_types = VendorType::where('status','active')->get();
        return response()->json([
            'success' => true,
            'data' => VendorTypeResource::collection($all_vendor_types),
            'meta' => [
                'count' => $all_vendor_types->count()
            ]
        ],200);
    }
}
