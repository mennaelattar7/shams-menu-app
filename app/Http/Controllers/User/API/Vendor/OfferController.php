<?php

namespace App\Http\Controllers\User\API\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\API\Vendor\Offer\CreateRequest;
use App\Http\Resources\VendorBranch__OfferResource;
use App\Models\Vendor__MenuCategory;
use App\Models\VendorBranch__Offer;
use App\Models\VendorBranch__OfferProduct;
use App\Models\VendorBranche;
use Illuminate\Http\Request;

class OfferController extends BaseController
{
    public function index(Request $request)
    {
        $offersQuery = VendorBranch__Offer::whereHas('branch', function ($q) {
            $q->where('vendor_id', $this->vendor->id);
        });

        if ($request->filled('activation_status')) {
            $offersQuery->where('activation_status', $request->activation_status);
        }

        if ($request->filled('discount_type')) {
            $offersQuery->where('discount_type', $request->discount_type);
        }

        if ($request->filled('start_date')) {
            $offersQuery->whereDate('start_date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $offersQuery->whereDate('end_date', '<=', $request->end_date);
        }

        $offers = $offersQuery->get();
        if ($offers->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'There are no offers'
            ],404);
        }
        return response()->json([
            'success' => true,
            'message' => 'get Offers successfully',
            'data' => VendorBranch__OfferResource::collection($offers)
        ],200);
    }

    public function create(CreateRequest $request)
    {
        $branch = VendorBranche::find($request->branch_id);

        if(!$branch)
        {
            return response()->json([
                'success' =>false,
                'message' =>'This Branch not exist'
            ],404);
        }
        else
        {
            if($branch->vendor->id != $this->vendor->id)
            {
                return response()->json([
                    'success' => false,
                    'message' => 'This Branch Not Exist in This vendor',
                ], 404);
            }
            //check if ther is products
            if($branch->products->isEmpty())
            {
                return response()->json([
                    'success' =>false,
                    'message' =>'There Are No Products To Assign Offer For Them'
                ],404);
            }
            else
            {
                //create offer
                $new_offer = new VendorBranch__Offer();
                $new_offer->created_by_id = $this->user->id;
                $new_offer->branch_id = $branch->id;
                $new_offer->name = $request->name;
                $new_offer->discount_type = $request->discount_type;
                $new_offer->discount_value = $request->discount_value;
                $new_offer->start_date = $request->start_date;
                $new_offer->end_date = $request->end_date;
                $new_offer->activation_status = $request->activation_status;
                $new_offer->save();

                if($request->category_id)
                {
                    $category = Vendor__MenuCategory::find($request->category_id);
                    if(!$category)
                    {
                        return response()->json([
                            'success' =>false,
                            'message' =>'This Category not Exsit'
                        ],404);
                    }
                    else
                    {
                        //check category type (main or sub)
                        if($category->parent_category_id == null)
                        {
                            //get all products in main category
                            //1- get sub categories
                            if($category->sub_categories->isEmpty())
                            {
                                $products = $category->products;
                            }
                            else
                            {
                                $products = $category->sub_categories()->with('products')->get()->pluck('products')->flatten()->unique();
                            }
                        }
                        else
                        {
                            $products = $category->products;
                        }
                    }
                }
                else
                {
                    //get all products in branch
                    $products = $branch->categories()->with('products')->get()->pluck('products')->flatten()->unique();
                }
                if($products->isEmpty())
                {
                    return response()->json([
                        'success' =>false,
                        'message' =>'There Are No Products To Assign Offer For Them'
                    ],404);
                }
                else
                {
                    if($request->product_ids)
                    {
                        $products = $products->whereIn('id',$request->product_ids);
                    }
                    else
                    {
                        $products = $products;
                    }
                }
                foreach($products as $one_product)
                {
                    $new_offer_product = new VendorBranch__OfferProduct();
                    $new_offer_product->created_by_id = $this->user->id;
                    $new_offer_product->product_id = $one_product->id;
                    $new_offer_product->offer_id = $new_offer->id;
                    $new_offer_product->save();
                }
                return response()->json([
                    'success' =>true,
                    'message' =>'Assign Offer To Products Successfully'
                ],200);
            }


        }

    }

    public function single($locale,$offer_slug)
    {
        // $offer = VendorBranch__Offer::where('slug',$offer_slug)->first();
        $offer = VendorBranch__Offer::with([
            'branch',
            'products.category.parent_category'
        ])->where('slug',$offer_slug)->first();

        if(!$offer)
        {
            return response()->json([
                'success' =>false,
                'message' => 'This Offer Not Exist'
            ],404);
        }
        return response()->json([
            'success' =>true,
            'message' => 'Get Offer Successfully',
            'data' => new VendorBranch__OfferResource($offer)
        ],200);
    }
}
