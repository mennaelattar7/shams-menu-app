<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VendorMenuCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'parent_category' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.vendor.product.index',
                'user.api.vendor.branch.categories',
                'user.api.vendor.menu_category.index',
                'user.api.vendor.menu_category.get_sub_categories',
                'user.api.public.branch.getMenuCategories',
            ]),optional($this->parent_category)->name) ,

            'name' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.vendor.product.index',
                'user.api.vendor.branch.categories',
                'user.api.vendor.menu_category.index',
                'user.api.vendor.menu_category.get_sub_categories',
                'user.api.public.branch.getMenuCategories',
            ]),$this->name),

            'slug' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.vendor.product.index',
                'user.api.vendor.branch.categories',
                'user.api.vendor.menu_category.index',
                'user.api.vendor.menu_category.get_sub_categories',
                'user.api.public.branch.getMenuCategories',
            ]),$this->slug) ,

            'image' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.vendor.product.index',
                'user.api.vendor.branch.categories',
                'user.api.vendor.menu_category.index',
                'user.api.vendor.menu_category.get_sub_categories',
                'user.api.public.branch.getMenuCategories',
            ]),$this->image != null? 'https://srv1219886.hstgr.cloud/storage/'.$this->image : null) ,

            'activation_status' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.vendor.product.index',
                'user.api.vendor.branch.categories',
                'user.api.vendor.menu_category.get_sub_categories',
                'user.api.vendor.menu_category.index',
            ]),$this->activation_status) ,

            'sort' =>$this->when($request->routeIs([
                    'user.api.public.product.single',
                    'user.api.vendor.product.index',
                    'user.api.vendor.branch.categories',
                    'user.api.vendor.menu_category.index',
                    'user.api.vendor.menu_category.get_sub_categories',
                    'user.api.public.branch.getMenuCategories',
                ]),$this->sort),


            // 'image' => $this->image,

            // 'status' => $this->status,
            // 'childreen' => $this->when(
            //                             $request->routeIs('user.vendor.VendorMenuCategories'),
            //                             $this->sub_categories != null? VendorMenuCategoryResource::collection($this->whenLoaded('sub_categories')):null
            //                         )
        ];
    }
}
