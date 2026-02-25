<?php

namespace App\Http\Controllers\User\API\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\API\Vendor\Vendor\UpdateRatingsRequest;
use App\Http\Requests\User\API\Vendor\Vendor\UpdateRequest;
use App\Http\Resources\VendorResource;
use App\Models\SocialMediaIcon;
use App\Models\Vendor__Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class VendorController extends BaseController
{
    public function getVendorData()
    {
        return response()->json([
            'sucess' =>true,
            'message' =>'Get Vendor Data Successfully',
            'data' =>new VendorResource($this->vendor)
        ],200);
    }
    public function Update(UpdateRequest $request)
    {
        $vendor = $this->vendor;
        $vendor->company_name = $request->company_name;
        $vendor->brand_name = $request->brand_name;
        if(request()->hasFile('logo'))
        {
            $file=$request->logo;
            $name = $file->getClientOriginalName();
            $extension = pathinfo($name)['extension'];
            $fileName = 'Vendor_Logo' . Str::random(5) . '.' . $extension;

            $file->storeAs('Vendor/Logo',$fileName,'public');
            $vendor->logo = 'Vendor/Logo/' . $fileName;
        }
        if(request()->hasFile('banar'))
        {
            $file=$request->banar;
            $name = $file->getClientOriginalName();
            $extension = pathinfo($name)['extension'];
            $fileName = 'Vendor_Banar' . Str::random(5) . '.' . $extension;

            $file->storeAs('Vendor/Banar',$fileName,'public');
            $vendor->banar = 'Vendor/Banar/' . $fileName;
        }
        $vendor->slogan = $request->slogan;
        $vendor->save();
        $vendor->currencies()->sync($request->currency_ids);
        return response()->json([
            'status' =>true,
            'message' =>"Vendor Updated Successfully",
        ],200);
    }

    public function updateSocialMedia(Request $request)
    {
        $vendor = $this->vendor;
        $data=[];
        foreach($request->all() as $key => $one_item)
        {
            $socal_media_icon = SocialMediaIcon::where('name',$key)->first();
            if($socal_media_icon)
            {
                $socal_media_link = $one_item;
                $data[$socal_media_icon->id] = [
                    'link' => $socal_media_link,
                    'created_by_id' => Auth::user()->id
                ];
            }
        }
        $vendor->social_media()->sync($data);
        return response()->json([
            'status' =>true,
            'message' =>"Social Media Of Vendor Updated Successfully",
        ],200);
    }

    public function updateRatings(UpdateRatingsRequest $request)
    {
        $vendor = $this->vendor;
        $vendor->rating = $request->rating;
        $vendor->ratings_count = $request->ratings_count;
        $vendor->message_notes = $request->message_notes;
        $vendor->save();
        return response()->json([
            'status' =>true,
            'message' =>"Ratings filed Of Vendor Updated Successfully",
        ],200);
    }

    public function updateBranchFeatureActivation()
    {

    }

    public function getRolesPremissions()
    {
        return response()->json([
            'success' => true,
            'message' =>'Get Roles And permissions successfully',
            'data' =>[
                'representative_vendor_name' => Auth::user()->name,
                'roles' =>Auth::user()->getRoleNames(),
                'permissions' => Auth::user()->getAllPermissions()->pluck('display_name')
            ]
        ],200);
    }
}
