<?php

namespace App\Http\Resources;

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
        return [
            'id'=>$this->id,
            'category' => $this->category->name,
            'product_type' =>$this->product_type->name,
            'name' =>$this->name,
            'slug'=>$this->name,
            'description' =>$this->description,
            'image' =>$this->image,
            'price' =>$this->variants->count() == 1? $this->variants->first()->price:null,
            'calories' =>$this->variants->count() == 1? $this->variants->first()->calories:null,
            'status' =>$this->status,
            'variants' => ProductVariantResource::collection($this->variants->where('status','active'))
        ];
    }
}
