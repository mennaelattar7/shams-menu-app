<?php

namespace App\Http\Controllers\User\API\Public;

use App\Http\Controllers\Controller;
use App\Models\Customer__Favourite;
use App\Models\Product;
use App\Models\VendorBranche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerFavouriteController extends Controller
{
    public function addToFavourite($locale,$branch_slug,Request $request)
    {

        $branch = VendorBranche::where('slug',$branch_slug)->first();
        $products = $request->products_ids;
        $customer = Auth::user()->customer;
        $data = [];
        foreach($request->products_ids as $one_product_id)
        {
            $data[$one_product_id]=[
                'branch_id' => $branch->id
            ];
        }
        $customer->favourites()->sync($data);
        return response()->json([
            'success' =>true,
            'message'=>'Product Added In Favourite List'
        ],200);




    }
}
