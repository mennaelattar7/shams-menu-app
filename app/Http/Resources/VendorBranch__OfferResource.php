<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VendorBranch__OfferResource extends JsonResource
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
            'branch' => new VendorBranchResource($this->branch),
            'name' =>$this->name,
            'slug' =>$this->slug,
            'discount_type' =>$this->discount_type,
            'discount_value'=>$this->discount_value,
            'start_date' =>$this->start_date,
            'end_date' => $this->end_date,
            'activation_status' =>$this->activation_status,
            'products' => ProductResource::collection($this->products)
        ];
    }
}
