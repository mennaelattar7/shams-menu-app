<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // $active_offer = $this->offers->filter(fn($offer)=>$offer->is_active())->first();
        return [
            'id'=>$this->id,

            'name' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.public.menu_category.get_products',
                'user.api.vendor.product.index',
                'user.api.vendor.menu_category.products',
                'user.api.vendor.product.single',
                'user.api.vendor.branch.products',
                'user.api.vendor.offer.index',
                'user.api.vendor.offer.single',
            ]),$this->name),

            'slug' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.public.menu_category.get_products',
                'user.api.vendor.product.index',
                'user.api.vendor.menu_category.products',
                'user.api.vendor.product.single',
                'user.api.vendor.branch.products',
                'user.api.vendor.offer.index',
                'user.api.vendor.offer.single',
            ]),$this->slug),

            'description' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.public.menu_category.get_products',
                'user.api.vendor.product.index',
                'user.api.vendor.menu_category.products',
                'user.api.vendor.product.single',
            ]),$this->description),

            'price' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.public.menu_category.get_products',
                'user.api.vendor.product.index',
                'user.api.vendor.menu_category.products',
                'user.api.vendor.product.single',
                'user.api.vendor.offer.index',
                'user.api.vendor.offer.single',
            ]) && $this->variants->count() == 1 ,$this->variants->first()->price),

            'activation_status' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.public.menu_category.get_products',
                'user.api.vendor.product.index',
                'user.api.vendor.menu_category.products',
                'user.api.vendor.product.single',
                'user.api.vendor.branch.products',
            ]),$this->activation_status),

            'availability_status' => $this->whenPivotLoaded('product___product_branches', function () {
                return $this->pivot->availability_status;
            }),
            'activation_status_in_offer' => $this->when($request->routeIs([
                    'user.api.vendor.offer.index',
                    'user.api.vendor.offer.single',
                    ]), $this->whenPivotLoaded('vendor_branch___offer_products', function () {
                        return $this->pivot->activation_status;
            })),

            'variants' => $this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.public.menu_category.get_products',
                'user.api.vendor.product.index',
                'user.api.vendor.menu_category.products',
                'user.api.vendor.product.single',
            ]) && $this->variants->count()>1,  ProductVariantResource::collection($this->variants)),

            'category' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.vendor.product.index',
                'user.api.vendor.menu_category.products',
                'user.api.vendor.product.single',
            ]),new VendorMenuCategoryResource($this->category)) ,

            'product_type' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.vendor.menu_category.products',
                'user.api.vendor.product.single',
            ]),new ProductTypeResource($this->product_type)),

            'image' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.public.menu_category.get_products',
                'user.api.vendor.product.index',
                'user.api.vendor.menu_category.products',
                'user.api.vendor.product.single',
            ]),$this->image ? Storage::url($this->image) : null),

            'calories' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.public.menu_category.get_products',
                'user.api.vendor.menu_category.products',
                'user.api.vendor.product.single',
            ]),$this->calories),

            'badges' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.vendor.menu_category.products',
                'user.api.vendor.product.single',
            ]),ProductBadgeResource::collection($this->badges)),

            'allergens' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.vendor.menu_category.products',
                'user.api.vendor.product.single',
            ]),ProductAllergenResource::collection($this->allergens)),

            'cooking_levels' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.vendor.menu_category.products',
                'user.api.vendor.product.single',
            ]),ProductCookingLevelResource::collection($this->cooking_levels)),

            'branches' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.vendor.menu_category.products',
                'user.api.vendor.product.single',
            ]),VendorBranchResource::collection($this->branches)),

            'sort' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.public.menu_category.get_products',
                'user.api.vendor.product.index',
                'user.api.vendor.menu_category.products',
                'user.api.vendor.product.single',
            ]),$this->sort),

            'views_count' =>$this->when($request->routeIs([
                'user.api.vendor.home.most_viewed_product',
                'user.api.vendor.menu_category.products',
            ]),$this->views->count()),
        ];
    }
}
