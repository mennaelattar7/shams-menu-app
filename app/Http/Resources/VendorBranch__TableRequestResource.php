<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;


class VendorBranch__TableRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $response_time = null;
        $waiting_time = null;
        if($this->requested_at && $this->completed_at)
        {
            $requested_at = Carbon::parse($this->requested_at);
            $completed_at = Carbon::parse($this->completed_at);

            $diff = $requested_at->diff($completed_at);

            $response_time =
                ($diff->days * 24 + $diff->h) . ':' .
                str_pad($diff->i, 2, '0', STR_PAD_LEFT) . ':' .
                str_pad($diff->s, 2, '0', STR_PAD_LEFT);
        }
        elseif($this->requested_at && $this->completed_at == null)
        {
            $requested_at = Carbon::parse($this->requested_at);
            $completed_at = Carbon::parse($this->completed_at);

            $diff = $requested_at->diff($completed_at);

            $waiting_time =
                ($diff->days * 24 + $diff->h) . ':' .
                str_pad($diff->i, 2, '0', STR_PAD_LEFT) . ':' .
                str_pad($diff->s, 2, '0', STR_PAD_LEFT);
        }




        return [
            'id' => $this->id,
            'table' => new VendorBranch__TableResource($this->table),
            'request_number' => $this->request_number,
            'request_type' => $this->request_type,
            'current_status' => $this->current_status,
            'notes' => $this->notes,
            'requested_at_time' => Carbon::parse($this->requested_at)->format('H:i:s') ,
            'requested_at_date' => Carbon::parse($this->requested_at)->format('Y-M-d') ,
            'completed_at' => Carbon::parse($this->completed_at)->format('H:i:s') ,

            'status_history' => $this->when($request->routeIs([
                'user.api.vendor.table_request.single',
            ]), VendorBranch__TableRequest_StatusHistoryResource::collection($this->status_history)),

            'response_time' =>  $response_time,
            'waiting_time' =>$waiting_time
        ];
    }
}
