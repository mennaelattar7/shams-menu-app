<?php

namespace App\Http\Controllers\User\API\Vendor\Reports\ProductFav;

use App\Http\Controllers\Controller;
use App\Http\Controllers\User\API\Vendor\BaseController;
use App\Models\Customer__Favourite;
use App\Models\VendorBranche;
use Illuminate\Http\Request;

class ProductFavouritController extends BaseController
{
    public function statistics($locale, $branch_slug)
    {
        $vendor = $this->vendor;
        
        $branch = VendorBranche::where('slug',$branch_slug)->first();
        if($branch->vendor->id == $vendor->id)
        {
            $all_products = $branch->products()->with('favourites')->get();
            $all_favourites = $all_products->pluck('favourites')->flatten();

            //Products Fav
            $all_products_ids = $branch->products->pluck('id')->toArray();
            $all_products_fav = Customer__Favourite::whereIn('product_id',$all_products_ids)->get()->unique('product_id');


            if(!$all_favourites)
            {
                return response()->json([
                    'success' =>true,
                    'message' =>'There is No Favourite List',
                    'data' => []
                ],200);
            }

            return response()->json([
                'success' =>true,
                'message' =>'get all Favourites List in this branch successfully',
                'data' => [
                    'favourits_count' =>$all_favourites->count(),
                    'products_fav' =>$all_products_fav->count()
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

    public function index($locale, $branch_slug)
    {
        $vendor = $this->vendor;
        $branch = VendorBranche::where('slug',$branch_slug)->first();
        if($branch->vendor->id == $vendor->id)
        {
            $all_products = $branch->products()
                ->select('products.id','products.name','products.slug')
                ->selectRaw('(select count(*) from customer___favourites where customer___favourites.product_id = products.id) as favs_count')
                ->get();

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
