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
        $active_offer = $this->offers->filter(fn($offer)=>$offer->is_active())->first();
        return [
            'id'=>$this->id,
            'category' => $this->category->name,
            'product_type' =>$this->product_type->name,
            'name' =>$this->name,
            'slug'=>$this->name,
            'description' =>$this->description,
            'image' =>$this->image,
            'status' =>$this->status,
            'offer' => $active_offer ? new VendorBranch__OfferResource($active_offer) : null,
            'variants' => ProductVariantResource::collection($this->variants->where('status','active'))
        ];
    }
}
