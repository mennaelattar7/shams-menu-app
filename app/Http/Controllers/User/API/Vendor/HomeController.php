<?php

namespace App\Http\Controllers\User\API\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends BaseController
{

    public function statistics(Request $request)
    {
        $vendor = $this->vendor;
        $branchesQuery = $vendor->branches();
        if($request->branch_slug) {
            $branchesQuery->where('slug', $request->branch_slug);
        }
        $branches = $branchesQuery->get();
        $monthNumber = null;
        if($request->month_name) {
            try {
                $monthNumber = Carbon::parse($request->month_name . ' 1')->month;
            } catch (\Exception $e) {
                $monthNumber = null;
            }
        }

        $visitsQuery = $vendor->branches()->with(['visits' => function($q) use ($monthNumber) {
            if($monthNumber) {
                $q->whereMonth('created_at', $monthNumber);
            }
        }]);

        if($request->branch_slug) {
            $visitsQuery->where('slug', $request->branch_slug);
        }

        $visits = $visitsQuery->get()->sum(function($branch){
            return $branch->visits->count();
        });

        $customers = Customer::count(); // حاليا كله

        $ready_to_order_query = $vendor->branches()->with(['tables.table_requests' => function($q) use ($monthNumber) {
            $q->where('request_type', 'ready_to_order');
            if($monthNumber) {
                $q->whereMonth('created_at', $monthNumber);
            }
        }]);

        if($request->branch_slug) {
            $ready_to_order_query->where('slug', $request->branch_slug);
        }

        $ready_to_order_table_requests = $ready_to_order_query->get()
            ->pluck('tables.*.table_requests')
            ->flatten()
            ->count();
        $call_waiter_query = $vendor->branches()->with(['tables.table_requests' => function($q) use ($monthNumber) {

            if($monthNumber) {
                $q->whereMonth('created_at', $monthNumber);
            }
        }]);

        if($request->branch_slug) {
            $call_waiter_query->where('slug', $request->branch_slug);
        }

        $call_waiter = $call_waiter_query->get()
            ->pluck('tables.*.table_requests')
            ->flatten()
            ->count();

        // ==========================
        // response
        // ==========================
        return response()->json([
            'success'=>true,
            'message' => 'get statistics successfully',
            'data' => [
                'visits' => $visits,
                'customer' => $customers,
                'ready_to_order' => $ready_to_order_table_requests,
                'call_waiter' => $call_waiter
            ]
        ], 200);
    }
    public function mostViewedProducts()
    {
        $all_products = Product::withCount('views')->whereHas('category',function($q){
                $q->where('vendor_id',$this->vendor->id);
            })->orderByDesc('views_count')->take(3)->get();

        return response()->json([
            'success' =>true,
            'message' =>'get the most Viewed Products',
            'data' => ProductResource::collection($all_products)
        ],200);
    }
    public function mostFavouriteProducts()
    {
        $all_products = Product::withCount('favourites')->whereHas('category',function($q){
                $q->where('vendor_id',$this->vendor->id);
            })->orderByDesc('favourites_count')->take(3)->get();
        return response()->json([
            'success' =>true,
            'message' =>'get the most favourite Products',
            'data' => ProductResource::collection($all_products)
        ],200);
    }
}
