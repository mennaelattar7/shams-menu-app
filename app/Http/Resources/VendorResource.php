<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VendorResource extends JsonResource
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
            'brand_name'=>$this->brand_name,
            'logo' =>$this->logo,
            'banar' =>$this->banar,
            'slogan' =>$this->slogan
        ];
    }
}
