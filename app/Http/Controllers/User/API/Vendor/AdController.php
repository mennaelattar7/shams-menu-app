<?php

namespace App\Http\Controllers\User\API\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\API\Vendor\Ad\CreateRequest;
use App\Http\Requests\User\API\Vendor\Ad\UpdateRequest;
use App\Http\Resources\Vendor__AdResource;
use App\Models\Product__ProductBranch;
use App\Models\Vendor__Ad;
use App\Models\VendorBranch__Ad;
use App\Models\VendorBranche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AdController extends BaseController
{
    public function index(Request $request)
    {
        $vendor = $this->vendor;
        $ads = $vendor->ads();
        if(!$ads->exists())
        {
            return response()->json([
                'success'=>true,
                'message'=>'there are no Ads',
                'data'=>[]
            ]);
        }
        if($request->activation_status)
        {
            $ads = $ads->where('activation_status',$request->activation_status);
        }

        if($request->time_period =="this_day")
        {
            $today = Carbon::today();
            $ads = $ads->whereDate('start_date', '<=', $today)
                    ->whereDate('end_date', '>=', $today)
                    ->get();
        }

        elseif ($request->time_period == "this_week") {

            $startOfWeek = Carbon::now()->startOfWeek(); // default Monday
            $endOfWeek = Carbon::now()->endOfWeek();     // default Sunday

            $ads = $ads->whereDate('start_date', '<=', $endOfWeek)
                    ->whereDate('end_date', '>=', $startOfWeek);
        }
        elseif ($request->time_period == "this_month") {

            $startOfMonth = Carbon::now()->startOfMonth();
            $endOfMonth = Carbon::now()->endOfMonth();

            $ads = $ads->whereDate('start_date', '<=', $endOfMonth)
                    ->whereDate('end_date', '>=', $startOfMonth);
        }
        if($request->time_period =="custom")
        {
            $startDate = Carbon::parse($request->start_date)->startOfDay(); // بداية اليوم
            $endDate   = Carbon::parse($request->end_date)->endOfDay();     // نهاية اليوم 23:59:59

            $ads = $ads->whereDate('start_date', '<=', $endDate)
                        ->whereDate('end_date', '>=', $startDate);
        }
        $ads = $ads->get();
        return response()->json([
            'success'=>true,
            'message'=>'get Ads Successfully',
            'data'=> Vendor__AdResource::collection($ads)
        ]);

    }
    public function create(CreateRequest $request)
    {
        // check active ads overlap
        if($request->activation_status == 'active'){
            $activeAd = Vendor__Ad::where('vendor_id', $this->vendor->id)
                ->where('activation_status', 'active')
                ->where('product_id',$request->product_id)
                ->where(function ($q) use ($request) {
                    $q->where('start_date', '<=', $request->end_date)
                    ->where('end_date', '>=', $request->start_date);
                })
                ->first();
            if ($activeAd) {
                return response()->json([
                    'success' => false,
                    'message' => 'There is already an active ad for this vendor during the selected period',
                ]);
            }
        }
        //check if this ad exist in vendor
        $ad = Vendor__Ad::where([
            ['vendor_id',$this->vendor->id],
            ['name',$request->name],
            ['product_id',$request->product_id],
        ])->first();
        if($ad)
        {
            return response()->json([
                'success' =>false,
                'message' =>'this ad already exist in Vendor',
            ]);
        }

        $new_ad = new Vendor__Ad();
        $new_ad->created_by_id = Auth::user()->id;
        $new_ad->vendor_id = $this->vendor->id;
        $new_ad->name = $request->name;
        if(request()->hasFile('image'))
        {
            $file=$request->image;
            $name = $file->getClientOriginalName();
            $extension = pathinfo($name)['extension'];
            $fileName = 'vendor_ad_' . Str::random(5) . '.' . $extension;

            $file->storeAs('vendor/ad/images',$fileName,'public');
            $new_ad->image = 'vendor/ad/images/' . $fileName;
        }
        $new_ad->activation_status = $request->activation_status;
        $new_ad->start_date = $request->start_date;
        $new_ad->end_date = $request->end_date;
        $new_ad->save();
        foreach($request->branch_ids as $one_branch)
        {
            //check this branch exist in vendor
            $branch = VendorBranche::find($one_branch);
            if($branch)
            {
                if($branch->vendor->id != $this->vendor->id)
                {
                    return response()->json([
                        'success' =>false,
                        'message' =>'('. $branch->name.') not exist in Vendor',
                    ],404);
                }
            }
            //check if this product available in branch
            if($request->product_id)
            {
                $product_branch = Product__ProductBranch::where('branch_id',$branch->id)
                                                        ->where('product_id',$request->product_id)
                                                        ->where('activation_status','active')
                                                        ->first();



                if(!$product_branch)
                {
                    return response()->json([
                        'success' =>false,
                        'message' =>'this product not active in this branch',
                    ]);
                }
                $new_ad->product_id = $request->product_id;
                $new_ad->save();
            }
            $new_vendor_branch_ad = new VendorBranch__Ad();
            $new_vendor_branch_ad->vendor_ad_id = $new_ad->id;
            $new_vendor_branch_ad->branch_id = $branch->id;
            $new_vendor_branch_ad->save();
        }
        return response()->json([
            'success' => true,
            'message' => 'Ad created successfully',
            'data' => $new_ad
        ]);

    }

    public function toggleActivationAd($locale,$ad_slug)
    {
        $ad = Vendor__Ad::where('slug',$ad_slug)->first();
        if(!$ad)
        {
            return response()->json([
                'success' => false,
                'message' =>'this ad not found'
            ],404);
        }
        //toggle activation
        if($ad->activation_status == "active")
        {
            $ad->activation_status = "inactive";
        }
        else
        {
            $ad->activation_status = "active";
        }
        $ad->save();
        return response()->json([
            'success' => true,
            'message' => 'Change Activation Status Succefully',
        ], 200);
    }

    public function single($locale,$ad_slug)
    {
        $ad = Vendor__Ad::where('slug',$ad_slug)->first();
        if(!$ad)
        {
            return response()->json([
                'success' => false,
                'message' =>'this ad not found'
            ],404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Get ad data Succefully',
            'data' => new Vendor__AdResource($ad)
        ], 200);
    }
    public function update(UpdateRequest $request, $locale, $ad_slug)
    {
        $ad = Vendor__Ad::where('slug', $ad_slug)
            ->where('vendor_id', $this->vendor->id)
            ->first();
        if(!$ad)
        {
            return response()->json([
                'success' =>false,
                'message'=>'this Ad Not Exist'
            ],404);
        }


        $productId = $request->product_id ?? null;



        // check active ads overlap
        if ($request->activation_status == 'active')
        {
            $activeAd = Vendor__Ad::where('vendor_id', $this->vendor->id)
                ->where('activation_status', 'active')
                ->where('id', '!=', $ad->id)
                ->where(function ($q) use ($request) {
                    $q->where('start_date', '<=', $request->end_date)
                    ->where('end_date', '>=', $request->start_date);
                })
                ->first();

            if ($activeAd) {
                return response()->json([
                    'success' => false,
                    'message' => 'There is already an active ad for this vendor during the selected period',
                ]);
            }
        }

        // check duplicate ad
        $duplicateAd = Vendor__Ad::where('vendor_id', $this->vendor->id)
            ->where('name', $request->name)
            ->where('id', '!=', $ad->id)
            ->first();

        if ($duplicateAd) {
            return response()->json([
                'success' => false,
                'message' => 'this ad already exist in Vendor',
            ]);
        }


        // update ad fields
        $ad->name = $request->name ?? $ad->name;
        $ad->product_id = $productId;
        $ad->start_date = $request->start_date ?? $ad->start_date;
        $ad->end_date = $request->end_date ?? $ad->end_date;
        $ad->activation_status = $request->activation_status ?? $ad->activation_status;

        // update image
        if ($request->hasFile('image')) {

            $file = $request->image;
            $extension = $file->getClientOriginalExtension();

            $fileName = 'vendor_ad_' . \Str::random(5) . '.' . $extension;

            $file->storeAs('vendor/ad/images', $fileName, 'public');

            $ad->image = 'vendor/ad/images/' . $fileName;
        }

        $ad->save();

        // update branches
        if ($request->branch_ids) {

            VendorBranch__Ad::where('vendor_ad_id', $ad->id)->delete();

            foreach ($request->branch_ids as $one_branch) {

                $branch = VendorBranche::find($one_branch);

                if (!$branch) {
                    return response()->json([
                        'success' => false,
                        'message' => 'branch not found',
                    ]);
                }

                // check branch belong to vendor
                if ($branch->vendor_id != $this->vendor->id) {
                    return response()->json([
                        'success' => false,
                        'message' => '(' . $branch->name . ') not exist in Vendor',
                    ]);
                }

                // check product active in branch
                if ($productId) {

                    $product_branch = Product__ProductBranch::where('branch_id', $branch->id)
                        ->where('product_id', $productId)
                        ->where('activation_status', 'active')
                        ->first();

                    if (!$product_branch) {
                        return response()->json([
                            'success' => false,
                            'message' => 'this product not active in this branch',
                        ]);
                    }
                }

                $branch_ad = new VendorBranch__Ad();
                $branch_ad->vendor_ad_id = $ad->id;
                $branch_ad->branch_id = $branch->id;
                $branch_ad->save();
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Ad updated successfully',
            'data' => $ad
        ]);
    }



}
