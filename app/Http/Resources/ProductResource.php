<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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

            'name' =>$this->name,

            'slug' =>$this->slug,



            'description' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.public.menu_category.get_products',
            ]),$this->description),

            'activation_status' =>$this->activation_status,

            'availability_status' =>$this->availability_status,

            'variants' => ProductVariantResource::collection($this->variants->where('activation_status','active')),

            'category' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.vendor.product.index',
            ]),new VendorMenuCategoryResource($this->category)) ,

            'product_type' =>$this->when($request->routeIs([
                'user.api.public.product.single',
            ]),new ProductTypeResource($this->product_type)),

            'image' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.public.menu_category.get_products',
            ]),$this->image),
            'calories' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.public.menu_category.get_products',
            ]),$this->calories),
            // 'allergens' =>$this->when($request->routeIs([
            //     'user.api.public.product.single',
            //     'user.api.public.menu_category.get_products',
            // ]),ProductAllergenResource::collection($this->allergens)),
            'badges' =>$this->when($request->routeIs([
                'user.api.public.product.single',
            ]),ProductBadgeResource::collection($this->badges)),

            'views_count' =>$this->when($request->routeIs([
                'user.api.vendor.home.most_viewed_product',
            ]),$this->views->count()),





            // 'category' => $this->category->name,
            // 'product_type' =>$this->product_type->name,
            // 'name' =>$this->name,
            // 'slug'=>$this->name,
            // 'description' =>$this->description,
            // 'image' =>$this->image,
            // 'status' =>$this->status,
            // // 'offer' => $active_offer ? new VendorBranch__OfferResource($active_offer) : null,

        ];
    }
}
