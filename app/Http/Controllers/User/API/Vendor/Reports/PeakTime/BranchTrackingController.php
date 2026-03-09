<?php

namespace App\Http\Controllers\User\API\Vendor\Reports\PeakTime;

use App\Http\Controllers\Controller;
use App\Http\Controllers\User\API\Vendor\BaseController;
use App\Models\VendorBranch__Tracking;
use App\Models\VendorBranche;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BranchTrackingController extends BaseController
{
    public function statistics($locale, $branch_slug)
    {
        $vendor = $this->vendor;
        $branch = VendorBranche::where('slug',$branch_slug)->first();
        if($branch->vendor->id == $vendor->id)
        {
            $all_visits = $branch->visits->count();


        // 1️⃣ نجمع عدد الزيارات لكل ساعة
            $visits_per_hour = VendorBranch__Tracking::where('branch_id', $branch->id)
                ->select(DB::raw('HOUR(created_at) as hour'), DB::raw('count(*) as visits'))
                ->groupBy('hour')
                ->orderByDesc('visits')
                ->get();

            // 2️⃣ نجيب أعلى ساعة زيارات
            $peak = $visits_per_hour->first();

            if(!$peak){
                return response()->json([
                    'success' => true,
                    'message' => 'No visits found',
                    'peak_hour' => null
                ]);
            }

            // 3️⃣ ننسق الساعة بالشكل 11:00 - 12:00
            $start = str_pad($peak->hour, 2, '0', STR_PAD_LEFT) . ':00';
            $end   = str_pad($peak->hour + 1, 2, '0', STR_PAD_LEFT) . ':00';
            $peak_range = $start . ' - ' . $end;

            return response()->json([
                'success' =>true,
                'message' =>'get all Visits in this branch successfully',
                'data' => [
                    'all_visits' =>$all_visits,
                    'peak_range' =>$peak_range
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
    public function visits($locale, $branch_slug,Request $request)
    {
        $vendor = $this->vendor;
        $branch = VendorBranche::where('slug',$branch_slug)->first();

        if($branch->vendor->id == $vendor->id)
        {
            $visits_per_hour = VendorBranch__Tracking::where('branch_id', $branch->id)
                ->select(
                    DB::raw('HOUR(created_at) as hour'),
                    DB::raw('count(*) as visits'),
                    DB::raw('count(DISTINCT IFNULL(customer_id, uuid)) as unique_customers')
                )
                ->groupBy('hour')
                ->orderBy('hour');

            if($request->time_period =="this_day")
            {
                $visits_per_hour->whereDate('created_at', Carbon::today());
            }

            if($request->time_period =="this_month")
            {
                $visits_per_hour->whereBetween('created_at', [
                    Carbon::now()->startOfMonth(),
                    Carbon::now()->endOfMonth()
                ]);
            }

            if($request->time_period =="custom")
            {
                $visits_per_hour->whereBetween('created_at', [
                    Carbon::parse($request->start_date)->startOfDay(),
                    Carbon::parse($request->end_date)->endOfDay()
                ]);
            }

            // تنفيذ الاستعلام
            if($request->per_page)
            {
                $results = $visits_per_hour->paginate($request->per_page);

                $results->getCollection()->transform(function($item){
                    $start = str_pad($item->hour, 2, '0', STR_PAD_LEFT) . ':00';
                    $end   = str_pad($item->hour + 1, 2, '0', STR_PAD_LEFT) . ':00';

                    return [
                        'peak_range' => $start.' - '.$end,
                        'visits' => $item->visits,
                        'customers' => $item->unique_customers
                    ];
                });

                $data = $results;
            }
            else
            {
                $data = $visits_per_hour->get()->map(function($item){
                    $start = str_pad($item->hour, 2, '0', STR_PAD_LEFT) . ':00';
                    $end   = str_pad($item->hour + 1, 2, '0', STR_PAD_LEFT) . ':00';

                    return [
                        'peak_range' => $start.' - '.$end,
                        'visits' => $item->visits,
                        'customers' => $item->unique_customers
                    ];
                });
            }

            return response()->json([
                'success' => true,
                'message' => 'Visits and customers grouped by hour',
                'data' => $data
            ],200);
        }

        return response()->json([
            'success' => false,
            'message' =>'this Branch not found in this vendor'
        ],404);
    }
}
