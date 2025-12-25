<?php

namespace App\Http\Controllers\User\API\Meta;

use App\Http\Controllers\Controller;
use App\Http\Resources\LangResource;
use App\Http\Resources\SocialMediaResource;
use App\Models\Lang;
use App\Models\SocialMediaIcon;
use Illuminate\Http\Request;

class SocialMediaIconController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/{locale}/user/meta/social-media-icons",
     *     tags={"App Meta"},
     *     summary="Get active social-media-icons",
     *     description="Return list of active social media icons",
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
     *                         "name": "facebook",
     *                         "display_name": "facebook"
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
     *                     @OA\Property(property="name", type="string", example="facebook"),
     *                     @OA\Property(property="display_name", type="string", example="facebook")
     *                 )
     *             ),
     *             @OA\Property(property="meta", type="integer",example=1),
     *         )
     *     )
     * )
     */
    public function index($locale,Request $request)
    {
        $all_social_media_icons = SocialMediaIcon::all();
        return response()->json([
            'success' => true,
            'data' => SocialMediaResource::collection($all_social_media_icons),
            'meta' => [
                'count' => $all_social_media_icons->count()
            ]
        ],200);
    }
}
