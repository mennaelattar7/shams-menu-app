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

            ]),$this->name),

            'slug' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.public.menu_category.get_products',
                'user.api.vendor.product.index',
                'user.api.vendor.menu_category.products',
            ]),$this->slug),

            'description' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.public.menu_category.get_products',
                'user.api.vendor.product.index',
                'user.api.vendor.menu_category.products',
            ]),$this->description),

            'price' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.public.menu_category.get_products',
                'user.api.vendor.product.index',
                'user.api.vendor.menu_category.products',
            ]) && $this->variants->count() == 1 ,$this->variants->first()->price),

            'activation_status' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.public.menu_category.get_products',
                'user.api.vendor.product.index',
                'user.api.vendor.menu_category.products',
            ]),$this->activation_status),
            'availability_status' => $this->whenPivotLoaded('product___product_branches', function () {
                return $this->pivot->availability_status;
            }),

            'variants' => $this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.public.menu_category.get_products',
                'user.api.vendor.product.index',
                'user.api.vendor.menu_category.products',
            ]) && $this->variants->count()>1,  ProductVariantResource::collection($this->variants)),

            'category' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.vendor.product.index',
                'user.api.vendor.menu_category.products',
            ]),new VendorMenuCategoryResource($this->category)) ,

            'product_type' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.vendor.menu_category.products',
            ]),new ProductTypeResource($this->product_type)),

            'image' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.public.menu_category.get_products',
                'user.api.vendor.product.index',
                'user.api.vendor.menu_category.products',
            ]),$this->image ? Storage::url($this->image) : null),

            'calories' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.public.menu_category.get_products',
                'user.api.vendor.menu_category.products',
            ]),$this->calories),

            'badges' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.vendor.menu_category.products',
            ]),ProductBadgeResource::collection($this->badges)),

            'sort' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.public.menu_category.get_products',
                'user.api.vendor.product.index',
                'user.api.vendor.menu_category.products',

            ]),$this->sort),

            'views_count' =>$this->when($request->routeIs([
                'user.api.vendor.home.most_viewed_product',
                'user.api.vendor.menu_category.products',
            ]),$this->views->count()),
        ];
    }
}
