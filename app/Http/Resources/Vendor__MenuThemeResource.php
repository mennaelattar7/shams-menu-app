<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Vendor__MenuThemeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'vendor_id' => new VendorResource($this->vendor),
            'main_category_layout' => $this->main_category_layout,
            'products_layout' => $this->products_layout,
            'theme_name' => $this->theme_name,
            'theme_details' => new Vendor__MenuThemeDetailResource($this->menu_theme_details)
        ];
    }
}
