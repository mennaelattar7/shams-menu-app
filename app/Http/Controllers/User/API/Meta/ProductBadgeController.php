<?php

namespace App\Http\Controllers\User\API\Meta;

use App\Http\Controllers\Controller;
use App\Http\Resources\Shams__ProductBadgeResource;
use App\Models\Product__ProductBadge;
use App\Models\Shams__ProductBadge;
use Illuminate\Http\Request;

class ProductBadgeController extends Controller
{
    public function index()
    {
        $all_product_badges = Shams__ProductBadge::all();
        return Shams__ProductBadgeResource::collection($all_product_badges)
            ->additional([
                'success' => true,
                'message' => 'Get Shams Product Badges Successfully'
            ])
            ->response()
            ->setStatusCode(200);
    }
}
