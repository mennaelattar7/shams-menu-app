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
                'user.api.vendor.ad.index',
                'user.api.vendor.ad.single',
                'user.api.public.branch.get_ad',
                'user.api.vendor.menu_theme.get_vendor_theme',
            ]),$this->company_name),

            'slug' =>$this->when($request->routeIs([
                'user.api.vendor.setting.vendor_data.get',
                'user.api.public.branch.get_vendor_data',
                'user.api.vendor.employee_position.index',
                'user.api.vendor.user.index',
                'user.api.vendor.ad.index',
                'user.api.vendor.ad.single',
                'user.api.public.branch.get_ad',
                'user.api.vendor.menu_theme.get_vendor_theme',
            ]),$this->slug),

            'brand_name' =>$this->when($request->routeIs([
                'user.api.vendor.setting.vendor_data.get',
                'user.api.public.branch.get_vendor_data',
                'user.api.vendor.employee_position.index',
                'user.api.vendor.user.index',
                'user.api.vendor.ad.index',
                'user.api.vendor.ad.single',
                'user.api.public.branch.get_ad',
                'user.api.vendor.menu_theme.get_vendor_theme',
            ]),$this->brand_name),

            'logo' =>$this->when($request->routeIs([
                'user.api.vendor.setting.vendor_data.get',
                'user.api.public.branch.get_vendor_data',
            ]), $this->logo ? url(Storage::url($this->logo))  : null),

            'banar' =>$this->when($request->routeIs([
                'user.api.vendor.setting.vendor_data.get',
                'user.api.public.branch.get_vendor_data',
            ]),$this->banar ? url(Storage::url($this->banar)) : null),

            'slogan' =>$this->when($request->routeIs([
                'user.api.vendor.setting.vendor_data.get',
                'user.api.public.branch.get_vendor_data',
            ]),$this->slogan),

            'phone_number' =>$this->when($request->routeIs([
                'user.api.vendor.setting.vendor_data.get',
                'user.api.public.branch.get_vendor_data',
            ]),$this->phone_number),

            'whats_app_number' =>$this->when($request->routeIs([
                'user.api.vendor.setting.vendor_data.get',
                'user.api.public.branch.get_vendor_data',
            ]),$this->whats_app_number),

            'email' =>$this->when($request->routeIs([
                'user.api.vendor.setting.vendor_data.get',
                'user.api.public.branch.get_vendor_data',
            ]),$this->email),

            'currencies' =>$this->when($request->routeIs([
                'user.api.vendor.setting.vendor_data.get',
                'user.api.public.branch.get_vendor_data',
            ]), Shams__CurrencyResource::collection($this->currencies)),

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
                'user.api.public.branch.get_vendor_data',
            ]),$this->message_notes),

            'vendor_social_media' => $this->when(
                $request->routeIs([
                    'user.api.public.branch.get_vendor_data',
                    'user.api.vendor.setting.vendor_data.get',
                ]),
                function () {

                    if (!$this->social_media) {
                        return null;
                    }

                    return $this->social_media->mapWithKeys(function ($item) {

                        return [
                            strtolower($item->name ?? '') => $item->pivot->link
                        ];
                    })->filter();
                }
            ),


            'branches' =>$this->when($request->routeIs([
                'user.api.vendor.auth.login',
            ]),$this->branches ? VendorBranchResource::collection($this->branches) : null),
        ];
    }
}
