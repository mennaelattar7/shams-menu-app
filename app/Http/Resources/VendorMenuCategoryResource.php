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
                'user.api.public.branch.getMenuCategories',
            ]),optional($this->parent_category)->name) ,

            'name' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.vendor.product.index',
                'user.api.vendor.branch.categories',
                'user.api.vendor.menu_category.index',
                'user.api.public.branch.getMenuCategories',
            ]),$this->name),

            'slug' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.vendor.product.index',
                'user.api.vendor.branch.categories',
                'user.api.vendor.menu_category.index',
                'user.api.public.branch.getMenuCategories',
            ]),$this->slug) ,

            'image' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.vendor.product.index',
                'user.api.vendor.branch.categories',
                'user.api.vendor.menu_category.index',
                'user.api.public.branch.getMenuCategories',
            ]),$this->image != null? 'http://127.0.0.1:8000/storage/'.$this->image : null) ,

            'activation_status' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.vendor.product.index',
                'user.api.vendor.branch.categories',
                'user.api.vendor.menu_category.index',
            ]),$this->activation_status) ,


            // 'image' => $this->image,
            // 'sort' =>$this->sort,
            // 'status' => $this->status,
            // 'childreen' => $this->when(
            //                             $request->routeIs('user.vendor.VendorMenuCategories'),
            //                             $this->children_categories != null? VendorMenuCategoryResource::collection($this->whenLoaded('children_categories')):null
            //                         )
        ];
    }
}
