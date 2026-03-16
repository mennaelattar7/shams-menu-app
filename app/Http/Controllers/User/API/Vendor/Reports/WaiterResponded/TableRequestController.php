<?php

namespace App\Http\Controllers\User\API\Vendor\Reports\WaiterResponded;

use App\Http\Controllers\Controller;
use App\Http\Controllers\User\API\Vendor\BaseController;
use App\Http\Resources\VendorBranch__TableRequestResource;
use App\Models\VendorBranch__TableRequest;
use App\Models\VendorBranche;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TableRequestController extends BaseController
{
    public function statistics($locale,$branch_slug)
    {
        $vendor = $this->vendor;
        $branch = VendorBranche::where('slug',$branch_slug)->first();
        if($branch->vendor->id == $vendor->id)
        {
            $branch_tables = $branch->tables;
            $table_requests_collection = collect();

            foreach ($branch_tables as $table) {
                foreach ($table->table_requests as $request) {
                    $table_requests_collection->push($request);
                }
            }

            if($table_requests_collection->isEmpty())
            {
                return response()->json([
                    'success' =>true,
                    'message' =>'there are no table request in this branch',
                    'data' =>[
                        'average_response_time' => 0
                    ]
                ],200);
            }

            $completed_requests = $table_requests_collection->whereNotNull('completed_at');

            $average_response = $completed_requests->avg(function ($request) {
                return Carbon::parse($request->requested_at)
                    ->diffInMinutes($request->completed_at);
            });

            $delayed_requests_count = $table_requests_collection->whereNull('completed_at')->count();


            // $average_response_time = $average_seconds ? gmdate('H:i:s', $average_seconds) : null;
            return response()->json([
                    'success' =>true,
                    'message' =>'Get Data Successfully',
                    'data' =>[
                        'average_response' => round($average_response),
                        'delayed_requests_count' =>$delayed_requests_count
                    ]
                ],200);
        }
        else
        {
            return response()->json([
                'success' =>false,
                'message' =>'this Branch not found in this vendor'
            ],404);
        }
    }
    public function index($locale,$branch_slug,Request $request)
    {
        $vendor = $this->vendor;

        $branch = VendorBranche::where('slug',$branch_slug)->first();

        if(!$branch || $branch->vendor_id != $vendor->id)
        {
            return response()->json([
                'success' => false,
                'message' => 'this Branch not found in this vendor'
            ],404);
        }



        $table_requests = VendorBranch__TableRequest::whereHas('table', function ($q) use ($branch) {
            $q->where('branch_id', $branch->id);
        })
        ->orderByDesc('requested_at');

        if($request->time_period =="this_day")
        {
            $table_requests = $table_requests->whereDate('requested_at', Carbon::today());
        }

        if($request->time_period =="this_week")
        {
            $startOfWeek = Carbon::now()->startOfWeek();
            $endOfWeek = Carbon::now()->endOfWeek();
            $table_requests = $table_requests->whereBetween('requested_at', [$startOfWeek, $endOfWeek]);
        }
        if($request->time_period =="this_month")
        {
            $startOfMonth = Carbon::now()->startOfMonth(); // أول يوم في الشهر
            $endOfMonth   = Carbon::now()->endOfMonth();
            $table_requests = $table_requests->whereBetween('requested_at', [$startOfMonth, $endOfMonth]);
        }
        if($request->time_period =="custom")
        {
            $startdate = Carbon::parse($request->start_date)->startOfDay(); // بداية اليوم
            $enddate   = Carbon::parse($request->end_date)->endOfDay();     // نهاية اليوم 23:59:59
            $table_requests = $table_requests->whereBetween('requested_at', [$startdate, $enddate]);
        }
        if($request->request_type)
        {
            $table_requests = $table_requests->where('request_type',$request->request_type);
        }
        if($request->response_status)
        {
            if($request->response_status == "fast")
            {
                $table_requests = $table_requests->whereNotNull('completed_at')
                                                ->whereRaw('TIMESTAMPDIFF(MINUTE, requested_at, completed_at) <= ?', [30]);
            }
            elseif($request->response_status == "late")
            {
                $table_requests = $table_requests->where(function($q){
                    $q->whereNull('completed_at')
                    ->orWhereRaw('TIMESTAMPDIFF(MINUTE, requested_at, completed_at) > ?', [30]);
                });
            }
        }

        if($request->per_page)
        {
            $table_requests = $table_requests->paginate($request->per_page);
        }
        else
        {
            $table_requests = $table_requests->get();
        }

        return VendorBranch__TableRequestResource::collection($table_requests)
            ->additional([
                'success' => true,
                'message' => 'Get Table Requests Successfully'
            ])
            ->response()
            ->setStatusCode(200);
    }
}
