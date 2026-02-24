<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
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
            'name' =>$this->when($request->routeIs([
                'user.api.vendor.employee_position.index',
            ]),$this->name),
            'display_name_en' =>$this->when($request->routeIs([
                'user.api.vendor.employee_position.index',
            ]),$this->display_name_en),
            'display_name_ar' =>$this->when($request->routeIs([
                'user.api.vendor.employee_position.index',
            ]),$this->display_name_ar),
        ];
    }
}
