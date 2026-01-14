<?php

namespace App\Http\Controllers\User\API\Meta;

use App\Http\Controllers\Controller;
use App\Http\Resources\ShamsFeatureResource;
use App\Models\Shams_Feature;
use Illuminate\Http\Request;

class ShamsFeatureController extends Controller
{
    // /**
    //  * @OA\Get(
    //  *     path="/api/{locale}/user/meta/shams-features",
    //  *     tags={"App Meta"},
    //  *     summary="Get active Shams Features",
    //  *     description="Return list of active Shams Features",
    //  *
    //  *     @OA\Parameter(
    //  *         name="locale",
    //  *         in="path",
    //  *         required=true,
    //  *         description="Language code",
    //  *         @OA\Schema(type="string", example="en")
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
    //  *                     {
    //  *                         "id": 1,
    //  *                         "name": "Request Waiter",
    //  *                         "description":"Request Waiter"
    //  *                     }
    //  *                 },
    //  *                 "meta": {
    //  *                     {
    //  *                          "count":1
    //  *                     }
    //  *                 },
    //  *             },
    //  *             @OA\Property(property="success", type="boolean"),
    //  *             @OA\Property(
    //  *                 property="data",
    //  *                 type="array",
    //  *                 @OA\Items(
    //  *                     @OA\Property(property="id", type="integer", example=1),
    //  *                     @OA\Property(property="name", type="string", example="Request Waiter"),
    //  *                     @OA\Property(property="description", type="string", example="Request Waiter"),
    //  *                 )
    //  *             ),
    //  *             @OA\Property(property="meta", type="integer",example=1),
    //  *         )
    //  *     )
    //  * )
    //  */


    public function allItems($locale,Request $request)
    {
        $all_features = Shams_Feature::where('status','active')->get();
        return response()->json([
            'success' => true,
            'data' => ShamsFeatureResource::collection($all_features),
            'meta' => [
                'count' => $all_features->count()
            ]
        ],200);
    }
}
