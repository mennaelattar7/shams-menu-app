<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VendorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' =>$this->id,

            'company_name' =>$this->when($request->routeIs([
                'user.api.vendor.setting.vendor_data.get',
            ]),$this->company_name),

            'slug' =>$this->when($request->routeIs([
                'user.api.vendor.setting.vendor_data.get',
                'user.api.public.branch.get_vendor_data',
            ]),$this->slug),

            'brand_name' =>$this->when($request->routeIs([
                'user.api.vendor.setting.vendor_data.get',
                'user.api.public.branch.get_vendor_data',
            ]),$this->brand_name),

            'logo' =>$this->when($request->routeIs([
                'user.api.vendor.setting.vendor_data.get',
                'user.api.public.branch.get_vendor_data',
            ]),$this->logo),

            'banar' =>$this->when($request->routeIs([
                'user.api.vendor.setting.vendor_data.get',
                'user.api.public.branch.get_vendor_data',
            ]),$this->banar),

            'slogan' =>$this->when($request->routeIs([
                'user.api.vendor.setting.vendor_data.get',
                'user.api.public.branch.get_vendor_data',
            ]),$this->slogan),

            'rating' =>$this->when($request->routeIs([
                'user.api.vendor.setting.vendor_data.get',
                'user.api.public.branch.get_vendor_data',
            ]),$this->rating),

            'ratings_count' =>$this->when($request->routeIs([
                'user.api.vendor.setting.vendor_data.get',
                'user.api.public.branch.get_vendor_data',
            ]),$this->ratings_count),

            'more_details' =>$this->when($request->routeIs([
                'user.api.vendor.setting.vendor_data.get',
            ]),$this->more_details),

            'vendor_social_media' =>$this->when($request->routeIs([
                'user.api.public.branch.get_vendor_data',
            ]),SocialMediaResource::collection($this->social_media)),


            'branches' =>$this->when($request->routeIs([
                'user.api.vendor.auth.login',
            ]),$this->branches ? VendorBranchResource::collection($this->branches) : null),
        ];
    }
}
