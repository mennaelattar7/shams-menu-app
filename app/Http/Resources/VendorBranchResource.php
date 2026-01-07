<?php

namespace App\Http\Resources;

use App\Models\VendorBranch__OperatingHour;
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
        $operating_days = VendorBranch__OperatingHour::where([
            ['branch_id',$this->id],
            ['day_of_week',$currentDay]
        ]
        )->get();

        if($operating_days->isNotEmpty())
        {
            $operating_hours = $operating_days->where('opening_time', '<=', $currentTime)
            ->where('closing_time', '>=', $currentTime)
            ->first();
            $opening_time = $operating_hours ? $operating_hours->opening_time : $operating_days->first()->opening_time;
            $closing_time = $operating_hours ? $operating_hours->closing_time :$operating_days->first()->closing_time;
            if($operating_hours)
            {

                if($operating_hours->is_open == "yes")
                {
                    $current_status_operating_hours = "open";

                }
                else
                {
                    $current_status_operating_hours ="close";
                }
            }
            else
            {
                $current_status_operating_hours ="close";
            }
        }
        else
        {
            $opening_time = null;
            $closing_time = null;
            $current_status_operating_hours = "This branch has no operating hours set for today.";
        }

        return [
            'id' =>$this->id,
            'name' =>$this->name,
            'slug' =>$this->slug,
            'phone_number' => $this->phone_number,
            'address' =>$this->address,
            'google_place_link' =>$this->google_place_link,
            'opening_time' =>$opening_time,
            'closing_time'=>$closing_time,
            'current_status_operating_hours' => $current_status_operating_hours,
            'branch_socail_media' => $this->social_media ? SocialMediaResource::collection($this->social_media) : null,
            'vendor_data' =>$this->when(
                                        !$request->routeIs('user.api.vendor.auth.login'),
                                        $this->vendor? new VendorResource($this->vendor) : null
                                    ),
        ];
    }
}
