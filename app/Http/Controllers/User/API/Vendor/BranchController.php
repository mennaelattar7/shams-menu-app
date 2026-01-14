<?php

namespace App\Http\Controllers\User\API\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\API\Vendor\Branch\CreateRequest;
use App\Models\VendorBranch__OperatingHour;
use App\Models\VendorBranch__OperatingHourShift;
use App\Models\VendorBranche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
    public function create(CreateRequest $request)
    {
        $user = Auth::user();
        //add in vendor___branches table
        $new_vendor_branch = new VendorBranche();
        $new_vendor_branch->created_by_id = $user->id;
        $new_vendor_branch->vendor_id = $user->vendor_representative->vendor->id;
        $new_vendor_branch->city_id = $request->city_id;
        $new_vendor_branch->district_id = $request->district_id;
        $new_vendor_branch->name = $request->name;
        $new_vendor_branch->phone_number = $request->phone_number;
        $new_vendor_branch->whatsapp_number = $request->whatsapp_number;
        $new_vendor_branch->google_map_link = $request->google_map_link;
        $new_vendor_branch->number_of_tables =$request->number_of_tables;
        $new_vendor_branch->activation_status = $request->activation_status;
        $new_vendor_branch->save();
        $operating_hours = $request->operating_hours;
        foreach($operating_hours as $one_day)
        {
            $new_branch_operation_houre = new VendorBranch__OperatingHour();
            $new_branch_operation_houre->created_by_id = $user->id;
            $new_branch_operation_houre->branch_id = $new_vendor_branch->id;
            $new_branch_operation_houre->day_of_week = $one_day['day_of_week'];
            $new_branch_operation_houre->save();

            foreach($one_day['shifts'] as $one_shift)
            {
                $new_shift = new VendorBranch__OperatingHourShift();
                $new_shift->created_by_id = $user->id;
                $new_shift->operating_hours_id = $new_branch_operation_houre->id;
                $new_shift->start_time = $one_shift['start_time'];
                $new_shift->end_time = $one_shift['end_time'];
                $new_shift->is_open = $one_shift['is_open'];
                $new_shift->save();
            }
        }
        return response()->json([
            'success' => true,
            'message' => 'Branch Add successfuly'
        ]);

    }
}
