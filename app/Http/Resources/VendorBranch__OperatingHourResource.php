<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VendorBranch__OperatingHourResource extends JsonResource
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
            'day_of_week' =>$this->day_of_week,
            'shifts' =>VendorBranch__OperatingHourShiftResource::collection($this->shifts)
        ];
    }
}
