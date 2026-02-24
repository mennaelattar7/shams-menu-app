<?php

namespace App\Http\Controllers\User\API\Meta;

use App\Http\Controllers\Controller;
use App\Http\Resources\DistrictResource;
use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function index()
    {
        $all_districts = District::all();
        return response()->json([
            'success' => true,
            'data' => DistrictResource::collection($all_districts),
            'meta' => [
                'count' => $all_districts->count()
            ]
        ],200);
    }
}
