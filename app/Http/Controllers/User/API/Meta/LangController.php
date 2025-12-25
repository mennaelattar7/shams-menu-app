<?php

namespace App\Http\Controllers\User\API\Meta;

use App\Http\Controllers\Controller;
use App\Http\Resources\LangResource;
use App\Models\Lang;
use Illuminate\Http\Request;

class LangController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/{locale}/user/meta/langs",
     *     tags={"App Meta"},
     *     summary="Get active languages",
     *     description="Return list of active languages",
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
     *                         "code": "en",
     *                         "name": "english"
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
     *                     @OA\Property(property="code", type="string", example="en"),
     *                     @OA\Property(property="name", type="string", example="english")
     *                 )
     *             )
     *         )
     *     )
     * )
     */

    public function index($locale,Request $request)
    {
        $all_langs = Lang::where('status','active')->get();
        return response()->json([
            'success' => true,
            'data' => LangResource::collection($all_langs),
            'meta' => [
                'count' => $all_langs->count()
            ]
        ],200);
    }
}
