<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductVariantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $active_offer = $this->product->offers->filter(fn($offer)=>$offer->is_active())->first();
        if($active_offer)
        {
            if($active_offer->discount_type == "fixed")
            {
                $price_after_discount = $this->price - $active_offer->discount_value;
            }
            else
            {
                $price_after_discount = $this->price - ($this->price * ($active_offer->discount_value / 100));
            }

        }
        else
        {
            $price_after_discount = null;
        }
        return [
            'id'=>$this->id,
            'name' => $this->name,
            'price' =>$this->price,
            'price_after_discount' =>$price_after_discount,
            'status'=>$this->status,
        ];
    }
}
