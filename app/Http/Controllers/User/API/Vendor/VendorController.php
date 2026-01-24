<?php

namespace App\Http\Controllers\User\API\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\API\Vendor\Vendor\UpdateRequest;
use App\Http\Requests\User\API\Vendor\Vendor\UpdateSocialMediaRequest;
use App\Http\Resources\VendorResource;
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

    public function updateSocialMedia(UpdateSocialMediaRequest $request)
    {
        $vendor = $this->vendor;
        $data = [];

        foreach ($request->social_media as $one_social_media) {
            $data[$one_social_media['social_media_icon_id']] = [
                'link' => $one_social_media['link'],
                'created_by_id' => Auth::user()->id,
            ];
        }
        $vendor->social_media()->sync($data);
        return response()->json([
            'status' =>true,
            'message' =>"Social Media Of Vendor Updated Successfully",
        ],200);

    }
}
