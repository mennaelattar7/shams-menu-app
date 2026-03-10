<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Vendor__AdResource extends JsonResource
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
            'vendor' => new VendorResource($this->vendor),
            'product' => new ProductResource($this->product),
            'name' => $this->name,
            'slug' =>$this->slug,
            'image'=>$this->image,
            'start_date' => $this->start_date,
            'end_date'=>$this->end_date,
            'activation_status' =>$this->activation_status,
            'branches' => $this->branches
        ];
    }
}
