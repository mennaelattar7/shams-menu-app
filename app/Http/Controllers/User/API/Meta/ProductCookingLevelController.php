<?php

namespace App\Http\Controllers\User\API\Meta;

use App\Http\Controllers\Controller;
use App\Http\Resources\Shams__ProductCookingLevelResource;
use App\Models\Shams__ProductCookingLevel;
use Illuminate\Http\Request;

class ProductCookingLevelController extends Controller
{
    public function index()
    {
        $all_product_cooking_levels = Shams__ProductCookingLevel::all();
        return Shams__ProductCookingLevelResource::collection($all_product_cooking_levels)
            ->additional([
                'success' => true,
                'message' => 'Get Shams Product Cooking Levels Successfully'
            ])
            ->response()
            ->setStatusCode(200);
    }
}
