<?php

namespace App\Http\Controllers\User\API\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\API\Vendor\Product\CreateRequest;
use App\Models\Product;
use App\Models\Product__ProductAllergen;
use App\Models\Product__ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class ProductController extends BaseController
{
    public function index(Request $request)
    {
        if($request->per_page != null)
        {
            $all_branches= $this->vendor->branches()->paginate($request->per_page);
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
        //add in product tabel
        $new_product = new Product();
        $new_product->created_by_id = $this->user->id;
        $new_product->category_id = $request->category_id;
        $new_product->product_type_id = $request->product_type_id;
        $new_product->name = $request->name;
        $new_product->description = $request->description;
        if(request()->hasFile('image'))
        {
            $file=$request->image;
            $name = $file->getClientOriginalName();
            $extension = pathinfo($name)['extension'];
            $fileName = 'vendor_menu_category_' . Str::random(5) . '.' . $extension;

            $file->storeAs('vendor/menu_category/images',$fileName,'public');
            $new_product->image = 'vendor/menu_category/images/' . $fileName;
        }
        $new_product->activation_status = $request->activation_status;
        $new_product->calories = $request->calories;
        $new_product->save();

        //add in product___product_variants table
        $new_variant = new Product__ProductVariant();
        $new_variant->created_by_id = $this->user->id;
        $new_variant->product_id = $new_product->id;
        if($request->product_variant_name != null)
        {
            $new_variant->name = $request->product_variant_name;
        }
        $new_variant->price = $request->price;
        $new_variant->activation_status =  "active";
        $new_variant->save();

        //add in product___product_branches table
        $new_product->branches()->sync($request->branches_ids);
        //add in product___product_badges table
        $new_product->badges()->sync($request->badges_ids);
        //add in product___product_badges table
        $new_product->cooking_levels()->sync($request->cooking_level_ids);

        //add in product___product_allergens table
        foreach($request->allergens as $one_allergen)
        {
            $new_product_allergen = new Product__ProductAllergen();
            $new_product_allergen->name = $one_allergen['name'];
            $new_product_allergen->display_name = $one_allergen['display_name'];
            $new_product_allergen->product_id = $new_product->id;
            $new_product_allergen->save();
        }
        return response()->json([
            'success' => true,
            'message' => 'Product Add successfuly'
        ]);
    }
    public function single($loacle,$slug)
    {
        $branch = VendorBranche::where('slug',$slug)->first();
        return response()->json([
            'success' => true,
            'message' => 'Get Branche Data Succefully',
            'data' => new VendorBranchResource($branch)
        ], 200);
    }
    public function update($locale,$slug,UpdateRequest $request)
    {
        $branch = VendorBranche::where('slug',$slug)->first();
        if(!$branch)
        {
            return response()->json([
                'success' => false,
                'message' => 'This Branch Not found',
            ], 404);
        }
        else
        {
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
    }

    public function filter(FilterRequest $request)
    {
        $branchesQuery = $this->vendor->branches();
        if($request->filled('city_id'))
        {
            $branchesQuery->where('city_id',$request->city_id);
        }
        if($request->filled('district_id'))
        {
            $branchesQuery->where('district_id',$request->district_id);
        }
        if($request->filled('activation_status'))
        {
            $branchesQuery->where('activation_status',$request->activation_status);
        }
        if($request->filled('name'))
        {
            $branchesQuery->where(function($q) use ($request){
                $q->where('name->ar','LIKE','%'.$request->name.'%')
                  ->orWhere('name->en','LIKE','%'.$request->name.'%');
            });
        }
        $branches = $branchesQuery->get();
        if($branches->isEmpty())
        {
            return response()->json([
                'success' =>false,
                'message' => 'There Is No Branches'
            ],404);
        }

        return VendorBranchResource::collection($branches)
        ->additional([
            'success' =>true,
            'message' => 'Get Branches Successfully'
        ])
        ->response()
        ->setStatusCode(200);
    }
}
