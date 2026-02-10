<?php

namespace App\Http\Controllers\User\API\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\API\Vendor\EmployeePosition\CreateRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Vendor__EmployeePosition;
use Illuminate\Http\Request;

class EmployeePositionController extends BaseController
{
    public function create(CreateRequest $request)
    {
        //add in vendor___employee_positions table
        $new_employee_position = new Vendor__EmployeePosition();
        $new_employee_position->created_by_id = $this->user->id;
        $new_employee_position->vendor_id = $this->vendor->id;
        $new_employee_position->name = $request->name;
        $new_employee_position->save();

        //add in Role Table
        $new_role = new Role();
        $new_role->position_id = $new_employee_position->id;
        $new_role->name = $this->vendor->slug.'_'.$new_employee_position->slug;
        $brandNames = json_decode($this->vendor->getRawOriginal('brand_name'), true);
        $positionNames = json_decode($new_employee_position->getRawOriginal('name'), true);
        $new_role->display_name_en = $brandNames['en'].' ('. $positionNames['en'].')';
        $new_role->display_name_ar = $brandNames['ar'].' ('. $positionNames['ar'].')';
        $new_role->type = "vendor_employee";
        $new_role->guard_name = "api";
        $new_role->save();

        $new_employee_position->role_id = $new_role->id;
        $new_employee_position->save();

        //add role to permissions
        $permissions = Permission::whereIn('id', $request->permission_ids)->pluck('name');
        $new_role->syncPermissions($permissions);

        return response()->json([
            'success' =>true,
            'message' =>'Create Position and Assign Permission Successfully'
        ],200);

    }

}
