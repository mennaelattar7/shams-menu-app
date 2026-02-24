<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VendorRepresentativeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "vendor_rep_id" =>$this->id,
            'vendor_rep_position' =>$this->position,
            // 'vendor_data' =>$this->when(
            //                             $request->routeIs('user.api.vendor.auth.login'),
            //                             $this->vendor ? new VendorResource($this->vendor) : null
            //                         ),
        ];
    }
}
