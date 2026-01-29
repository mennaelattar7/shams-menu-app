<?php

namespace App\Http\Controllers\User\API\Meta;

use App\Http\Controllers\Controller;
use App\Http\Resources\Shams__ProductAllergenResource;
use App\Models\Shams__ProductAllergen;
use Illuminate\Http\Request;

class ProductAllergenController extends Controller
{
    public function index()
    {
        $all_product_allergens = Shams__ProductAllergen::all();
        return Shams__ProductAllergenResource::collection($all_product_allergens)
            ->additional([
                'success' => true,
                'message' => 'Get Shams Product Allergenes Successfully'
            ])
            ->response()
            ->setStatusCode(200);
    }
}
