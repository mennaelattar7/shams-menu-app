<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VendorMenuCategoryResource extends JsonResource
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
            'parent_category' =>$this->when($request->routeIs([
                'user.api.public.product.single',
            ]),optional($this->parent_category)->name) ,
            'name' =>$this->when($request->routeIs([
                'user.api.public.product.single',
            ]),$this->name)  ,
            'slug' =>$this->when($request->routeIs([
                'user.api.public.product.single',
            ]),$this->slug) ,


            // 'image' => $this->image,
            // 'sort' =>$this->sort,
            // 'status' => $this->status,
            // 'childreen' => $this->when(
            //                             $request->routeIs('user.vendor.VendorMenuCategories'),
            //                             $this->children_categories != null? VendorMenuCategoryResource::collection($this->whenLoaded('children_categories')):null
            //                         )
        ];
    }
}
