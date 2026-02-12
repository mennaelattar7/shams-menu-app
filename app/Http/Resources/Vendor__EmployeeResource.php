<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Vendor__EmployeeResource extends JsonResource
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
            'vendor' => new VendorResource($this->vendor),
            'user' => new UserResource($this->user),
            'position' => new Vendor__EmployeePositionResource($this->position)
        ];
    }
}
