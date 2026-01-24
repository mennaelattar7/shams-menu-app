<?php

namespace App\Http\Controllers\User\API\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\VendorResource;
use App\Models\VendorBranche;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function getVendorData($locale,$branch_slug)
    {
        //check branch exist
        $branch = VendorBranche::where('slug',$branch_slug)->where('activation_status','active')->first();

        if($branch)
        {
            $vendor = $branch->vendor;
            return response()->json([
                'success' =>true,
                'message' =>'get Vendor Data Succesfully',
                'data' => new VendorResource($vendor)
            ],200);
        }
        else
        {
            return response()->json([
                'success' =>true,
                'message' =>'Branch not found or inactive',
            ],404);
        }

    }
}
