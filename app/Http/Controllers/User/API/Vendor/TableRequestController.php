<?php

namespace App\Http\Controllers\User\API\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Resources\VendorBranch__TableRequestResource;
use App\Models\VendorBranch__TableRequest;
use App\Models\VendorBranch__TableRequest_StatusHistory;
use Illuminate\Http\Request;

class TableRequestController extends BaseController
{
    public function respond($locale,$request_id ,Request $request)
    {
        $table_request = VendorBranch__TableRequest::find($request_id);
        $table_request->current_status = $request->status;
        if($request->status == "completed")
        {
            $table_request->completed_at = now();
        }
        $table_request->save();
        //add row in vendor_branch___table_request__status_histories table
        $new_status_history = new VendorBranch__TableRequest_StatusHistory();
        $new_status_history->created_by_id = $this->user->id;
        $new_status_history->table_request_id = $table_request->id;
        $new_status_history->status = $request->status;
        if($request->status == "cancelled")
        {
            $new_status_history->reason = $request->reason;
        }
        $new_status_history->save();
        return response()->json([
            'success' =>true,
            'message'=>"The request has been responded to."
        ],200);

    }

    public function single($locale,$request_id)
    {
        $table_request = VendorBranch__TableRequest::find($request_id);
        if(!$table_request)
        {
            return response()->json([
                'success' =>false,
                'message' =>'this Request Not Exist'
            ],404);
        }
        return response()->json([
            'success' =>true,
            'message' =>'get Table Request Successufully',
            'data' => new VendorBranch__TableRequestResource($table_request)
        ],200);
    }
}
