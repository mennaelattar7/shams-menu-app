<?php

namespace App\Http\Controllers\User\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\VendorBranchResource;
use App\Models\VendorBranche;
use Illuminate\Http\Request;

class VendorBranchController extends Controller
{
    public function getBranchData($locale,$branch_id)
    {
        $branch = VendorBranche::find($branch_id);
        if($branch->is_active)
        {
            return response()->json([
                'success' => true,
                'message' => 'Branch retrieved successfully',
                'data' => new VendorBranchResource($branch)
            ],200);
        }
        else
        {
            return response()->json([
                'success' => false,
                'message' =>'This branch not Active Now',
                'data' => new VendorBranchResource($branch)
            ],403);
        }
    }
}
