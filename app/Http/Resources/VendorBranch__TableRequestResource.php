<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VendorBranch__TableRequestResource extends JsonResource
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
            'table' => new VendorBranch__TableResource($this->table),
            'request_number' =>$this->request_number,
            'request_type' =>$this->request_type,
            'current_status' =>$this->current_status,
            'requested_at' =>$this->requested_at,
            'completed_at' =>$this->completed_at,
            'status_history' =>$this->when($request->routeIs([
                'user.api.vendor.table_request.single',
            ]),VendorBranch__TableRequest_StatusHistoryResource::collection($this->status_history)),
        ];
    }
}
