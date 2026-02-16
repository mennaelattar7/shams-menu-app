<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
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
                'user.api.vendor.menu_category.sub_categories',
                'user.api.public.branch.getMenuCategories',
                'user.api.vendor.branch.categories.by_branches',
                'user.api.public.branch.get_products',
                'user.api.vendor.product.single',
                'user.api.vendor.menu_category.single',
                'user.api.vendor.offer.single',
            ]),optional($this->parent_category)->name) ,

            'name' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.vendor.product.index',
                'user.api.vendor.branch.categories',
                'user.api.vendor.menu_category.index',
                'user.api.vendor.menu_category.sub_categories',
                'user.api.public.branch.getMenuCategories',
                'user.api.vendor.branch.categories.by_branches',
                'user.api.public.branch.get_products',
                'user.api.vendor.product.single',
                'user.api.vendor.menu_category.single',
                'user.api.vendor.offer.single',
            ]),$this->name),

            'name_object' => $this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.vendor.product.index',
                'user.api.vendor.branch.categories',
                'user.api.vendor.menu_category.index',
                'user.api.vendor.menu_category.sub_categories',
                'user.api.public.branch.getMenuCategories',
                'user.api.vendor.branch.categories.by_branches',
                'user.api.public.branch.get_products',
                'user.api.vendor.product.single',
                'user.api.vendor.menu_category.single',
                'user.api.vendor.offer.single',
            ]),json_decode($this->getRawOriginal('name'), true)),

            'slug' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.vendor.product.index',
                'user.api.vendor.branch.categories',
                'user.api.vendor.menu_category.index',
                'user.api.vendor.menu_category.sub_categories',
                'user.api.public.branch.getMenuCategories',
                'user.api.vendor.branch.categories.by_branches',
                'user.api.public.branch.get_products',
                'user.api.vendor.product.single',
                'user.api.vendor.menu_category.single',
                'user.api.vendor.offer.single',
            ]),$this->slug) ,

            'image' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.vendor.product.index',
                'user.api.vendor.branch.categories',
                'user.api.vendor.menu_category.index',
                'user.api.vendor.menu_category.sub_categories',
                'user.api.public.branch.getMenuCategories',
                'user.api.vendor.branch.categories.by_branches',
                'user.api.public.branch.get_products',
                'user.api.vendor.product.single',
                'user.api.vendor.menu_category.single',
            ]),$this->image ? url(Storage::url($this->image)) : null) ,

            'activation_status' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.vendor.product.index',
                'user.api.vendor.branch.categories',
                'user.api.vendor.menu_category.sub_categories',
                'user.api.vendor.menu_category.index',
                'user.api.vendor.branch.categories.by_branches',
                'user.api.public.branch.get_products',
                'user.api.vendor.menu_category.single',
            ]),$this->activation_status) ,

            'sort' =>$this->when($request->routeIs([
                    'user.api.public.product.single',
                    'user.api.vendor.product.index',
                    'user.api.vendor.branch.categories',
                    'user.api.vendor.menu_category.index',
                    'user.api.vendor.menu_category.sub_categories',
                    'user.api.public.branch.getMenuCategories',
                    'user.api.vendor.branch.categories.by_branches',
                    'user.api.public.branch.get_products',
                    'user.api.vendor.menu_category.single',
                ]),$this->sort),
            'products' =>$this->when($request->routeIs([
                    'user.api.public.branch.get_products',
                    'user.api.vendor.menu_category.single',
                ]),ProductResource::collection($this->products)),
            'branches' => $this->when($request->routeIs([
                    'user.api.vendor.menu_category.single',
                ]),VendorBranchResource::collection($this->branches)),
        ];
    }
}
