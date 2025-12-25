<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VendorBranchResource extends JsonResource
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
            'name' =>$this->name,
            'slug' =>$this->slug,
            'current_Status_opening_hours' =>$this->current_Status_opening_hours,
            'phone_number' => $this->phone_number,
            'address' =>$this->address,
            'latitude' =>$this->latitude,
            'longitude' =>$this->longitude,
            'vendor_data' => $this->vendor? new VendorResource($this->vendor) : null
        ];
    }
}
