<?php

namespace App\Http\Controllers\User\API\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Resources\Vendor__SocialMediaResource;
use Illuminate\Http\Request;

class SocialMediaController extends BaseController
{
    public function index()
    {
        $social_media = $this->vendor->social_media;
        return response()->json([
            'success' =>true,
            'message' => 'get Social Media successfully',
            'data' => Vendor__SocialMediaResource::collection($social_media)
        ],200);
    }
}
