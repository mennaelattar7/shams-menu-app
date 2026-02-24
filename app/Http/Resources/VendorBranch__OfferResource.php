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
            'name_object' => json_decode($this->getRawOriginal('name'), true),
            'slug' =>$this->slug,
            'discount_type' =>$this->discount_type,
            'discount_value'=>$this->discount_value,
            'start_date' =>$this->start_date,
            'end_date' => $this->end_date,
            'activation_status' =>$this->activation_status,
            // 'products' => ProductResource::collection($this->products)
            'categories' => $this->products
                ->groupBy('category_id')
                ->map(function ($products) {

                    $category = $products->first()->category;

                    return [
                        'id' => $category->id,
                        'name' => $category->name,
                        'name_object' => json_decode($category->getRawOriginal('name'), true),
                        'slug' => $category->slug,

                        'parent_category' => $category->parent_category
                            ? [
                                'id' => $category->parent_category->id,
                                'name' => $category->parent_category->name,
                                'slug' => $category->parent_category->slug,
                            ]
                            : null,

                        'products' => ProductResource::collection($products),
                    ];
                })
                ->values(),
        ];
    }
}
