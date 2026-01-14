<?php

namespace App\Http\Controllers\User\API\Meta;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductTypeResource;
use App\Models\Product__Type;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    // /**
    //  * @OA\Get(
    //  *     path="/api/{locale}/user/meta/product-types",
    //  *     tags={"App Meta"},
    //  *     summary="Get Product types",
    //  *     description="Return list of Product types",
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
    //  *                         "name": "food"
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
    //  *                     @OA\Property(property="name", type="string", example="food")
    //  *                 )
    //  *             )
    //  *         )
    //  *     )
    //  * )
    //  */
    public function allItems()
    {
        $all_types = Product__Type::all();
        return response()->json([
            'success' => true,
            'data' => ProductTypeResource::collection($all_types),
            'meta' => [
                'count' => $all_types->count()
            ]
        ],200);
    }
}
