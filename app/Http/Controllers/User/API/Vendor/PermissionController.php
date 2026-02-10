<?php

namespace App\Http\Controllers\User\API\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Resources\Permissionresource;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        //get all permission in vendor module
        $permissioins = Permission::where('is_vendor',true)->where('guard_name','api')->get();
        return response()->json([
            'success' => true,
            'message' =>'Get All Permissions Successfully',
            'data' =>Permissionresource::collection($permissioins)
        ],200);
    }
}
