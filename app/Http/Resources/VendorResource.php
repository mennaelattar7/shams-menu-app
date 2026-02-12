<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

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
                'user.api.vendor.employee_position.index',
                'user.api.vendor.user.index',
            ]),$this->company_name),

            'slug' =>$this->when($request->routeIs([
                'user.api.vendor.setting.vendor_data.get',
                'user.api.public.branch.get_vendor_data',
                'user.api.vendor.employee_position.index',
                'user.api.vendor.user.index',
            ]),$this->slug),

            'brand_name' =>$this->when($request->routeIs([
                'user.api.vendor.setting.vendor_data.get',
                'user.api.public.branch.get_vendor_data',
                'user.api.vendor.employee_position.index',
                'user.api.vendor.user.index',
            ]),$this->brand_name),

            'logo' =>$this->when($request->routeIs([
                'user.api.vendor.setting.vendor_data.get',
                'user.api.public.branch.get_vendor_data',
            ]), $this->logo ? Storage::url($this->logo) : null),

            'banar' =>$this->when($request->routeIs([
                'user.api.vendor.setting.vendor_data.get',
                'user.api.public.branch.get_vendor_data',
            ]),$this->banar ? Storage::url($this->banar) : null),

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

            'message_notes' =>$this->when($request->routeIs([
                'user.api.vendor.setting.vendor_data.get',
            ]),$this->message_notes),

            'vendor_social_media' =>$this->when($request->routeIs([
                'user.api.public.branch.get_vendor_data',
            ]),SocialMediaResource::collection($this->social_media)),


            'branches' =>$this->when($request->routeIs([
                'user.api.vendor.auth.login',
            ]),$this->branches ? VendorBranchResource::collection($this->branches) : null),
        ];
    }
}
