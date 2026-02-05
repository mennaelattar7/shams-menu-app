<?php

namespace App\Http\Controllers\User\API\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\API\Vendor\Branch\CreateRequest;
use App\Http\Requests\User\API\Vendor\Branch\UpdateRequest;
use App\Http\Resources\Shams__VendorFeatureResource;
use App\Http\Resources\VendorBranchResource;
use App\Http\Resources\VendorMenuCategoryResource;
use App\Models\VendorBranch__Feature;
use App\Models\VendorBranch__Feature_StatusHistory;
use App\Models\VendorBranch__OperatingHour;
use App\Models\VendorBranch__OperatingHourShift;
use App\Models\VendorBranch__Table;
use App\Models\VendorBranche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class BranchController extends BaseController
{
    public function index(Request $request)
    {
        $all_branches = $this->vendor->branches();
        if($request->activation_status)
        {
            $all_branches = $all_branches->where('activation_status',$request->activation_status);
        }
        if($request->city_id)
        {
            $all_branches = $all_branches->where('city_id',$request->city_id);
        }
        if($request->district_id)
        {
            $all_branches = $all_branches->where('district_id',$request->district_id);
        }

        if($request->branch_name)
        {
            $all_branches->where(function($q) use ($request){
                $q->where('name->ar','LIKE','%'.$request->branch_name.'%')
                ->orWhere('name->en','LIKE','%'.$request->branch_name.'%');
            });
        }
        if($request->per_page != null)
        {
            $all_branches= $all_branches->paginate($request->per_page);
            return VendorBranchResource::collection($all_branches)
            ->additional([
                'success' => true,
                'message' => 'Get Branches Successfully'
            ])
            ->response()
            ->setStatusCode(200);
        }
        else
        {
            $all_branches = $this->vendor->branches;
            return response()->json([
                'success' => true,
                'message' => 'Get Branches Succefully',
                'data' => VendorBranchResource::collection($all_branches)
            ], 200);
        }
    }
    public function create(CreateRequest $request)
    {
        $user = $this->user;
        $vendor = $this->vendor;
        //get last subscription package of vendor
        $package = $vendor->package_subscriptions()
                          ->where('status','active')
                          ->latest('start_at')
                          ->first();
        //get package features
        $features = $package->features()->where('shams___vendor_package_features.activation_status','active')->get();

        //add in vendor___branches table
        $new_vendor_branch = new VendorBranche();
        $new_vendor_branch->created_by_id = $user->id;
        $new_vendor_branch->vendor_id = $vendor->id;
        $new_vendor_branch->city_id = $request->city_id;
        $new_vendor_branch->district_id = $request->district_id;
        $new_vendor_branch->name = $request->name;
        $new_vendor_branch->phone_number = $request->phone_number;
        $new_vendor_branch->whatsapp_number = $request->whatsapp_number;
        $new_vendor_branch->google_map_link = $request->google_map_link;
        $new_vendor_branch->number_of_tables =$request->number_of_tables;
        $new_vendor_branch->activation_status = $request->activation_status;
        $new_vendor_branch->save();

        //add in vendor_branch___features table
        foreach($features as  $one_feature)
        {
            $new_branch_feature = new VendorBranch__Feature();
            $new_branch_feature->branch_id = $new_vendor_branch->id;
            $new_branch_feature->feature_id = $one_feature->id;
            $new_branch_feature->activation_status = "active";
            $new_branch_feature->save();

            //add in vendor_branch___feature__status_histories table
            $new_branch_feature_status_history = new VendorBranch__Feature_StatusHistory();
            $new_branch_feature_status_history->created_by_id = Auth::user()->id;
            $new_branch_feature_status_history->branch_feature_id = $new_branch_feature->id;
            $new_branch_feature_status_history->activation_status = $new_branch_feature->activation_status;
            $new_branch_feature_status_history->save();
        }

        //add in vendor_branch___operating_hours table
        $operating_hours = $request->operating_hours;
        foreach($operating_hours as $one_day)
        {
            $new_branch_operation_houre = new VendorBranch__OperatingHour();
            $new_branch_operation_houre->created_by_id = $user->id;
            $new_branch_operation_houre->branch_id = $new_vendor_branch->id;
            $new_branch_operation_houre->day_of_week = $one_day['day_of_week'];
            $new_branch_operation_houre->save();
            //add in vendor_branch___operating_hours table
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

        //add in vendor_branch___tables
        for($i=1;$i<=$request->number_of_tables;$i++)
        {
            $new_branch_table = new VendorBranch__Table();
            $new_branch_table->created_by_id = Auth::user()->id;
            $new_branch_table->branch_id = $new_vendor_branch->id;
            $new_branch_table->table_number = $i;
            $new_branch_table->save();
        }
        return response()->json([
            'success' => true,
            'message' => 'Branch Add successfuly'
        ]);

    }
    public function getBranchData($loacle,$branch_slug)
    {
        $branch = VendorBranche::where('slug',$branch_slug)->first();
        if($branch == null)
        {
            return response()->json([
                'success' => true,
                'message' => 'This Branch Not exist',
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Get Branche Data Succefully',
            'data' => new VendorBranchResource($branch)
        ], 200);
    }
    public function updateBranchData($locale,$branch_slug,UpdateRequest $request)
    {
        $branch = VendorBranche::where('slug',$branch_slug)->first();
        if($branch == null)
        {
            return response()->json([
                'success' => false,
                'message' => 'This Branch Not found',
            ], 404);
        }

        $branch->updated_by_id = Auth::user()->id;
        $branch->city_id = $request->city_id;
        $branch->district_id = $request->district_id;
        $branch->name = $request->name;
        $branch->phone_number = $request->phone_number;
        $branch->whatsapp_number = $request->whatsapp_number;
        $branch->google_map_link = $request->google_map_link;
        $branch->number_of_tables = $request->number_of_tables;
        $branch->activation_status = $request->activation_status;
        $branch->save();
        if($branch->operating_hours)
        {
            $branch->operating_hours()->delete();
        }
        $operating_hours = $request->operating_hours;
        foreach($operating_hours as $one_day)
        {
            $new_branch_operation_houre = new VendorBranch__OperatingHour();
            $new_branch_operation_houre->created_by_id = Auth::user()->id;
            $new_branch_operation_houre->branch_id = $branch->id;
            $new_branch_operation_houre->day_of_week = $one_day['day_of_week'];
            $new_branch_operation_houre->save();
            foreach($one_day['shifts'] as $one_shift)
            {
                $new_shift = new VendorBranch__OperatingHourShift();
                $new_shift->created_by_id = Auth::user()->id;
                $new_shift->operating_hours_id = $new_branch_operation_houre->id;
                $new_shift->start_time = $one_shift['start_time'];
                $new_shift->end_time = $one_shift['end_time'];
                $new_shift->is_open = $one_shift['is_open'];
                $new_shift->save();
            }
        }
        return response()->json([
            'success' => true,
            'message' => 'Branch updated successfully',
        ]);

    }

    public function getBranchFeatures($locale,$branch_slug)
    {
        $branch = VendorBranche::where('slug',$branch_slug)->first();
        $branch_features = $branch->features()->where('shams___vendor_features.activation_status','active')->get();

        return response()->json([
            'success' => true,
            'message' => 'Get Branch Features Successfuly',
            'data' => Shams__VendorFeatureResource::collection($branch_features)
        ],200);
    }

    public function toggleActivationBranch($locale,$branch_slug,Request $request)
    {
        $branch = VendorBranche::where('slug',$branch_slug)->first();
        if($branch == null)
        {
            return response()->json([
                'success' => true,
                'message' => 'This Branch Not exist',
            ], 404);
        }
        $branch->activation_status = $request->activation_status;
        $branch->save();
        return response()->json([
            'success' => true,
            'message' => 'Change Activation StatusSuccefully',
        ], 200);
    }

    public function getCategories($locale,$branch_slug,$category_type=null)
    {
        $branch = VendorBranche::where('slug',$branch_slug)->first();
        if($branch == null)
        {
            return response()->json([
                'success' => true,
                'message' => 'This Branch Not exist',
            ], 404);
        }
        if($category_type != null)
        {
            if($category_type == "main")
            {
                $categories = $branch->categories()->where([
                    ['vendor___menu_categories.activation_status' ,'active'],
                    ['parent_category_id','=',null]
                ])->get();
            }
            elseif($category_type = "sub")
            {
                $categories = $branch->categories()->where([
                    ['vendor___menu_categories.activation_status' ,'active'],
                    ['parent_category_id','!=',null]
                ])->get();
            }
        }
        else
        {
            $categories = $branch->categories;
        }
        if($categories->isNotEmpty())
        {
            return response()->json([
                'success' =>true,
                'message' =>'Get All ' . $category_type.' Categories Successfully',
                'categories' =>VendorMenuCategoryResource::collection($categories)
            ],200);
        }
        else
        {
            return response()->json([
                'success' =>true,
                'message' =>'There Are No '.$category_type.' Categories in This Banch',
            ],404);
        }

    }

    public function getCategoriesByBranches($locale,Request $request,$category_type=null)
    {
        $branchIds = $request->branches_ids; // ?branches_ids[]=1&branches_ids[]=2

        if (!$branchIds || !is_array($branchIds)) {
            return response()->json([
                'success' => false,
                'message' => 'branches_ids must be an array of IDs'
            ], 400);
        }
        $categories = collect();
        for($i=0;$i<count($branchIds);$i++)
        {
            $branch = VendorBranche::find($branchIds[$i]);
            $categories = $categories->merge($branch->categories);
        }
        $categories = $categories->unique('id');


        if($category_type != null)
        {
            if($category_type == "main")
            {
                $categories = $categories->where('activation_status' ,'active')->where('parent_category_id','=',null);
            }
            elseif($category_type == "sub")
            {
                $categories = $categories->where('activation_status' ,'active')->where('parent_category_id','!=',null);
            }
        }
        else
        {
            $categories = $categories;
        }
        if($categories->isNotEmpty())
        {
            return response()->json([
                'success' =>true,
                'message' =>'Get All ' . $category_type.' Categories Successfully',
                'categories' =>VendorMenuCategoryResource::collection($categories)
            ],200);
        }
        else
        {
            return response()->json([
                'success' =>true,
                'message' =>'There Are No '.$category_type.' Categories in This Banch',
            ],404);
        }

    }
}
