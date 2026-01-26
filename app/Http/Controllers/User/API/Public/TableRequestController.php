<?php

namespace App\Http\Controllers\User\API\Public;

use App\Http\Controllers\Controller;
use App\Models\VendorBranch__Table;
use App\Models\VendorBranch__TableRequest;
use App\Models\VendorBranch__TableRequest_StatusHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TableRequestController extends Controller
{
    public function sendRequest(Request $request)
    {
        $branch_table = VendorBranch__Table::find($request->table_id);
        $branch = $branch_table->branch;
        $new_table_request = new VendorBranch__TableRequest();
        if(Auth::check())
        {
            $new_table_request->customer_id = Auth::user()->customer->id;
        }
        $new_table_request->branch_table_id = $request->table_id;
        //get last request in branch

        $branch_tables = $branch->tables->pluck('id')->toArray();

        $all_branch_requests = VendorBranch__TableRequest::whereIn('branch_table_id',$branch_tables)->get();

        if($all_branch_requests->isEmpty())
        {
            $new_table_request->request_number = 1;
        }
        else
        {

            $last_request = $all_branch_requests->last();

            $new_table_request->request_number=$last_request->request_number+1;
        }
        $new_table_request->request_type = $request->request_type;
        $new_table_request->requested_at = now();
        $new_table_request->save();

        //add this status in vendor_branch___table_request__status_histories table
        $new_table_request_status = new VendorBranch__TableRequest_StatusHistory();
        $new_table_request_status->created_by_id =$new_table_request->customer_id;
        $new_table_request_status->table_request_id = $new_table_request->id;
        $new_table_request_status->status = 'pending';
        $new_table_request_status->save();
        return response()->json([
            'success'=>true,
            'message'=>'request was sended',
        ]);
    }
}

