<?php

namespace App\Http\Controllers\User\API\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\Vendor__AdResource;
use App\Models\VendorBranche;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdController extends Controller
{
    public function getAd($locale,$branch_slug)
    {
        $branch=VendorBranche::where('slug',$branch_slug)->first();
        if(!$branch)
        {
            return response()->json([
                'success' =>true,
                'message' =>"this Branch not exist"
            ],200);
        }
        $ads = $branch->ads()->where('activation_status','active')
                           ->whereDate('start_date', '<=', Carbon::today())
                           ->whereDate('end_date', '>=', Carbon::today())
                           ->first();
        return response()->json([
            'success' =>true,
            'message'=>'get Current activation ad Successfully',
            'data' => new Vendor__AdResource($ads)
        ],200);

    }
}
