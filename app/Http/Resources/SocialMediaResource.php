<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SocialMediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            $this->name =>$this->when($request->routeIs([
                'user.api.public.branch.get_vendor_data',
            ]),$this->pivot->link ?? null),

            'id'=>$this->id,
            'name'=>$this->name,
            'display_name' =>$this->display_name,
            'link' => $this->pivot->link ?? null,
        ];
    }
}
