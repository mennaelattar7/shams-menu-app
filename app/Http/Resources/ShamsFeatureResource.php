<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShamsFeatureResource extends JsonResource
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
            'name'=>$this->name,
            'description'=>$this->description,
            'slug' => $this->when($request->routeIs([
                'user.api.public.branch.get_features',
            ]),$this->slug),
            'code' => $this->when($request->routeIs([
                'user.api.public.branch.get_features',
            ]),$this->code),
            'activation_status' => $this->when($request->routeIs([
                'user.api.public.branch.get_features',
            ]),$this->activation_status),
        ];
    }
}
