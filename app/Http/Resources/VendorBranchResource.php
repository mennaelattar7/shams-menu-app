<?php

namespace App\Http\Resources;

use App\Models\VendorBranch___OperatingHour;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VendorBranchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $currentDay = now()->dayOfWeekIso;
        $currentTime = now()->format('H:i:s');
        $opening_hours = VendorBranch___OperatingHour::where('branch_id', $this->id)
            ->where('day_of_week', $currentDay)
            ->where('opening_time', '<=', $currentTime)
            ->where('closing_time', '>=', $currentTime)
            ->first();
        $opening_time = $opening_hours->opening_time;
        $closing_time = $opening_hours->closing_time;
        if($opening_hours)
        {
            if($opening_hours->is_open == "yes")
            {
                $current_status_opening_hours = "open";

            }
            else
            {
                $current_status_opening_hours ="close";
            }
        }
        else
        {
            $current_status_opening_hours ="close";
        }
        return [
            'id' =>$this->id,
            'name' =>$this->name,
            'slug' =>$this->slug,
            'current_status_opening_hours' =>$current_status_opening_hours,
            'phone_number' => $this->phone_number,
            'address' =>$this->address,
            'google_place_link' =>$this->google_place_link,
            'opening_time' =>$opening_time,
            'closing_time'=>$closing_time,
            'vendor_data' => $this->vendor? new VendorResource($this->vendor) : null,
            'current_status_opening_hours' => $current_status_opening_hours,

        ];
    }
}
