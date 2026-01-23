<?php

namespace App\Http\Controllers\User\API\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Resources\VendorResource;
use Illuminate\Http\Request;

class VendorController extends BaseController
{
    public function getVendorData()
    {
        return response()->json([
            'sucess' =>true,
            'message' =>'Get Vendor Data Successfully',
            'data' =>new VendorResource($this->vendor)
        ],200);
    }
}
