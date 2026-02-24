<?php

namespace App\Http\Controllers\User\API\Meta;

use App\Http\Controllers\Controller;
use App\Http\Resources\CurrencyResource;
use App\Models\Shams__Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function index($locale,Request $request)
    {
        $all_currencies = Shams__Currency::where('activation_status','active')->get();
        return response()->json([
            'success' => true,
            'message' =>"Get Currencies Successfully",
            'data' => CurrencyResource::collection($all_currencies),
        ],200);
    }
}
