<?php

namespace App\Http\Controllers\User\API\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\API\Vendor\User\CreateRequest;
use App\Http\Resources\Vendor__EmployeeResource;
use App\Models\User;
use App\Models\User__AccountStatusHistory;
use App\Models\Vendor__Employee;
use App\Models\Vendor__EmployeePosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    public function index()
    {
        $vendor = $this->vendor;
        $employees = $vendor->employees;
        if($employees->isEmpty())
        {
            return response()->json([
                'success' =>false,
                'message' => 'There Are No Employees In Vendor'
            ],404);
        }
        return response()->json([
            'success' =>true,
            'message' =>'get Employee Successfully',
            'data' => Vendor__EmployeeResource::collection($employees)
        ],200);
    }
    public function create(CreateRequest $request)
    {
        //add to user table
        $new_user = new User();
        $new_user->name = $request->name;
        $new_user->country_dial_code_id = 2;
        $new_user->phone_number = $request->phone_number;
        $new_user->account_type = "vendor_employee";
        $new_user->activation_status = "inactive";
        $new_user->account_status ="not_approved";
        $new_user->save();

        //add in user___account_status_histories table
        $new_user_account_status = new User__AccountStatusHistory();
        $new_user_account_status->created_by_id = $this->user->id;
        $new_user_account_status->user_id = $new_user->id;
        $new_user_account_status->account_status = $new_user->account_status;
        $new_user_account_status->save();

        //add in vendor___employees table
        $new_vendor_employee = new Vendor__Employee();
        $new_vendor_employee->created_by_id = $this->user->id;
        $new_vendor_employee->vendor_id = $this->vendor->id;
        $new_vendor_employee->user_id = $new_user->id;
        $new_vendor_employee->position_id = $request->position_id;
        $new_vendor_employee->save();

        //get Role Depend on postion
        $postion = Vendor__EmployeePosition::find($request->position_id);
        $role = $postion->role;

        //assign role to user
        $new_user->assignRole($role);

        return response()->json([
            'success' =>true,
            'message' => 'new Vendor Employee Created Successfully'
        ],200);
    }
}
