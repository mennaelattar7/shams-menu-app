<?php

namespace App\Http\Controllers\User\API\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\API\Public\Review\AddRequest;
use App\Models\User;
use App\Models\User__AccountStatusHistory;
use App\Models\Vendor__Review;
use App\Models\VendorBranche;
use Illuminate\Support\Str;

class ReviewController extends Controller
{
    public function addReview($locale,$branch_slug,AddRequest $request)
    {
        $branch=VendorBranche::where('slug',$branch_slug)->first();
        if(!$branch)
        {
            return response()->json([
                'success' =>true,
                'message' =>"this Branch not exist"
            ],200);
        }
        $vendor = $branch->vendor;
        $user = User::where('phone_number',$request->phone_number)->first();
        if(!$user)
        {
            $new_user = new User();
            $new_user->name = 'guest_' . Str::random(5);
            $new_user->country_dial_code_id = 2;
            $new_user->phone_number = $request->phone_number;
            $new_user->account_type = "guest";
            $new_user->activation_status = "inactive";
            $new_user->account_status = "temporary";
            $new_user->save();

            $new_user_account_status_history = new User__AccountStatusHistory();
            $new_user_account_status_history->created_by_id = $new_user->id;
            $new_user_account_status_history->user_id = $new_user->id;
            $new_user_account_status_history->account_status= $new_user->account_status;
            $new_user_account_status_history->save();
            
            $user = $new_user;
        }


        $new_vendor_review = new Vendor__Review();
        $new_vendor_review->vendor_id = $vendor->id;
        $new_vendor_review->branch_id = $branch->id;
        $new_vendor_review->user_id = $user->id;
        $new_vendor_review->rating = $request->rating;
        $new_vendor_review->notes = $request->notes;
        $new_vendor_review->save();

        return response()->json([
            'success' =>true,
            'message' =>'Review added successfully.'
        ],200);
    }
}
