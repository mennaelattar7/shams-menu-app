<?php

namespace App\Http\Resources;

use App\Models\VendorBranche;
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
        //check if branch_slug in route
        if($request->route('branch_slug') != null)
        {
            $branch = VendorBranche::where('slug',$request->route('branch_slug'))->first();
        }
        else
        {
            $branch = null;
        }
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
                'user.api.public.branch.product.get_products',
                'user.api.vendor.product.single',
                'user.api.vendor.menu_category.single',
                'user.api.vendor.offer.single',
            ]),$this->parent_category != null? new VendorMenuCategoryResource($this->parent_category): null ),

            'name' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.vendor.product.index',
                'user.api.vendor.branch.categories',
                'user.api.vendor.menu_category.index',
                'user.api.vendor.menu_category.sub_categories',
                'user.api.public.branch.getMenuCategories',
                'user.api.vendor.branch.categories.by_branches',
                'user.api.public.branch.product.get_products',
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
                'user.api.public.branch.product.get_products',
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
                'user.api.public.branch.product.get_products',
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
                'user.api.public.branch.product.get_products',
                'user.api.vendor.product.single',
                'user.api.vendor.menu_category.single',
            ]),$this->image ? url(Storage::url($this->image)) : null) ,



            'activation_status_in_vendor' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.vendor.product.index',
                'user.api.vendor.branch.categories',
                'user.api.vendor.menu_category.sub_categories',
                'user.api.vendor.menu_category.index',
                'user.api.vendor.branch.categories.by_branches',
                'user.api.public.branch.product.get_products',
                'user.api.vendor.menu_category.single',
                'user.api.public.branch.getMenuCategories',
            ]),$this->activation_status),

            'activation_status_in_branch' => $this->when($request->routeIs([
                'user.api.public.branch.getMenuCategories'])&&$branch != null, function () use ($branch) {
                $branchRelation = $this->branches
                    ->firstWhere('id', $branch->id);

                return $branchRelation
                    ? $branchRelation->pivot->activation_status
                    : null;
            }),

            'sort' =>$this->when($request->routeIs([
                    'user.api.public.product.single',
                    'user.api.vendor.product.index',
                    'user.api.vendor.branch.categories',
                    'user.api.vendor.menu_category.index',
                    'user.api.vendor.menu_category.sub_categories',
                    'user.api.public.branch.getMenuCategories',
                    'user.api.vendor.branch.categories.by_branches',
                    'user.api.public.branch.product.get_products',
                    'user.api.vendor.menu_category.single',
                ]),$this->sort),
            'products' =>$this->when($request->routeIs([
                    'user.api.public.branch.product.get_products',
                    'user.api.vendor.menu_category.single',
                ]),ProductResource::collection($this->products)),

            'branches' => $this->when($request->routeIs([
                    'user.api.vendor.menu_category.single',
                ]),VendorBranchResource::collection($this->branches)),
        ];
    }
}
