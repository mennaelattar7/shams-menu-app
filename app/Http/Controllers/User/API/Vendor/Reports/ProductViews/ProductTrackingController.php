<?php

namespace App\Http\Controllers\User\API\Vendor\Reports\ProductViews;

use App\Http\Controllers\Controller;
use App\Http\Controllers\User\API\Vendor\BaseController;
use App\Models\Product__Tracking;
use App\Models\Vendor__MenuCategory;
use App\Models\VendorBranche;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProductTrackingController extends BaseController
{
    public function statistics($locale, $branch_slug)
    {
        $vendor = $this->vendor;
        $branch = VendorBranche::where('slug',$branch_slug)->first();
        if($branch->vendor->id == $vendor->id)
        {
            $all_products = $branch->products()->with('views')->get();
            $all_views = $all_products->pluck('views')->flatten();

            //Products viewed
            $all_products_ids = $branch->products->pluck('id')->toArray();
            $all_products_viewed = Product__Tracking::whereIn('product_id',$all_products_ids)->get()->unique('product_id');


            if(!$all_views)
            {
                return response()->json([
                    'success' =>true,
                    'message' =>'There are No Views',
                    'data' => []
                ],200);
            }

            return response()->json([
                'success' =>true,
                'message' =>'get all Visits in this branch successfully',
                'data' => [
                    'views_count' =>$all_views->count(),
                    'all_products_viewed_count' =>$all_products_viewed->count()
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

    public function index($locale, $branch_slug,Request $request)
    {
        $vendor = $this->vendor;
        $branch = VendorBranche::where('slug',$branch_slug)->first();
        if($branch->vendor->id == $vendor->id)
        {
            $all_products = $branch->products()
                ->select('products.id','products.name','products.slug')
                ->selectRaw('(select count(*) from product___trackings where product___trackings.product_id = products.id) as views_count');
            $all_views = Product__Tracking::query();

            if($request->time_period == "this_day" )
            {
                $all_views_ids_array = $all_views->whereDate('created_at', Carbon::today())->pluck('product_id')->toArray();
                $all_products->whereIn('products.id',$all_views_ids_array);
            }
            if($request->time_period =="this_week")
            {
                $startOfWeek = Carbon::now()->startOfWeek();
                $endOfWeek = Carbon::now()->endOfWeek();
                $all_views_ids_array = $all_views->whereBetween('created_at', [$startOfWeek, $endOfWeek])->pluck('product_id')->toArray();
                $all_products->whereIn('products.id',$all_views_ids_array);
            }
            if($request->time_period =="this_month")
            {
                $startOfMonth = Carbon::now()->startOfMonth(); // أول يوم في الشهر
                $endOfMonth   = Carbon::now()->endOfMonth();
                $all_views_ids_array = $all_views->whereBetween('created_at', [$startOfMonth, $endOfMonth])->pluck('product_id')->toArray();
                $all_products->whereIn('products.id',$all_views_ids_array);
            }
            if($request->time_period =="custom")
            {
                $startdate = Carbon::parse($request->start_date)->startOfDay(); // بداية اليوم
                $enddate   = Carbon::parse($request->end_date)->endOfDay();     // نهاية اليوم 23:59:59
                $all_views_ids_array = $all_views->whereBetween('created_at', [$startdate, $enddate])->pluck('product_id')->toArray();
                $all_products->whereIn('products.id',$all_views_ids_array);
            }
            if($request->sub_category_slug)
            {
                $category = Vendor__MenuCategory::where('slug',$request->sub_category_slug)->first();
                if($category)
                {
                    $all_products = $all_products->where('products.category_id',$category->id);
                }

            }
            if ($request->main_category_slug) {
                $category = Vendor__MenuCategory::where('slug',$request->main_category_slug)->first();
                if($category)
                {
                    $sub_categories_ids = $category->sub_categories()->pluck('id');
                    $all_products = $all_products->whereIn('products.category_id', $sub_categories_ids);
                }
            }


            $all_products = $all_products->get();
            if(!$all_products)
            {
                return response()->json([
                    'success' =>true,
                    'message' =>'There Are No Products',
                    'data' => []
                ],200);
            }
            return response()->json([
                'success' =>true,
                'message' =>'get all products',
                'data' => $all_products
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
}
