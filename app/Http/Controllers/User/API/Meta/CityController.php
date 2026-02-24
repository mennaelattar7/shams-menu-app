<?php

namespace App\Http\Controllers\User\API\Meta;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Http\Resources\DistrictResource;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $all_cities = City::all();
        return response()->json([
            'success' => true,
            'data' => CityResource::collection($all_cities),
            'meta' => [
                'count' => $all_cities->count()
            ]
        ],200);
    }

    public function filterDistrict(Request $request)
    {
        $city = City::find($request->city_id);
        $districts = $city->districts;
        return response()->json([
            'success' => true,
            'message' => "filter Districts Succesefuly",
            'data' => DistrictResource::collection($districts)
        ],200);
    }
}
