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
            $operating_hours = $operating_days->where('start_time', '<=', $currentTime)
            ->where('end_time', '>=', $currentTime)
            ->first();
            $start_time = $operating_hours ? $operating_hours->start_time : $operating_days->first()->start_time;
            $end_time = $operating_hours ? $operating_hours->end_time :$operating_days->first()->end_time;
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
            $start_time = 'This branch has no Start Time To Day.';
            $end_time = 'This branch has no End Time To Day.';
            $current_status_operating_hours = "This branch has no operating hours set for today.";
        }

        return [
            'id' => $this->id,

            'name' =>$this->when($request->routeIs([
                'user.api.vendor.branch.index',
                'user.api.vendor.branch.branch_data',
                'user.api.vendor.branch.filter',
                'user.api.public.branch.get_branch_data',
                'user.api.public.branch.get_branch_table'
            ]),$this->name) ,

            'slug' =>$this->when($request->routeIs([
                'user.api.vendor.branch.index',
                'user.api.vendor.branch.branch_data',
                'user.api.vendor.branch.filter',
                'user.api.public.branch.get_branch_data',
                'user.api.public.branch.get_branch_table'
            ]),$this->slug),

            'city' =>$this->when($request->routeIs([
                'user.api.vendor.branch.index',
                'user.api.vendor.branch.branch_data',
                'user.api.public.branch.get_branch_data'
            ]),new CityResource($this->city)),

            'district' =>$this->when($request->routeIs([
                'user.api.vendor.branch.index',
                'user.api.vendor.branch.branch_data',
                'user.api.public.branch.get_branch_data',
            ]),new DistrictResource($this->district)),

            'activation_status' =>$this->when($request->routeIs([
                'user.api.vendor.branch.index',
                'user.api.vendor.branch.branch_data',
                'user.api.vendor.branch.filter',
                'user.api.public.branch.get_branch_data',
                'user.api.public.branch.get_branch_table'
            ]),$this->activation_status),

            'google_map_link' =>$this->when($request->routeIs([
                'user.api.vendor.branch.branch_data',
                'user.api.public.branch.get_branch_data',
            ]),$this->google_map_link),

            'phone_number' =>$this->when($request->routeIs([
                'user.api.vendor.branch.branch_data',
                'user.api.public.branch.get_branch_data',
            ]),$this->phone_number),

            'whatsapp_number' =>$this->when($request->routeIs([
                'user.api.vendor.branch.branch_data',
                'user.api.public.branch.get_branch_data',
            ]),$this->whatsapp_number),

            'address' =>$this->when($request->routeIs([
                'user.api.vendor.branch.branch_data',
            ]),$this->address),

            'number_of_tables'=>$this->when($request->routeIs([
                'user.api.vendor.branch.branch_data',
            ]),$this->number_of_tables),

            'operating_hours' => $this->when($request->routeIs([
                'user.api.vendor.branch.branch_data',
            ]),VendorBranch__OperatingHourResource::collection($this->operating_hours)),

            'start_time' =>$this->when($request->routeIs([
                'user.api.public.branch.get_branch_data',
            ]), $start_time),

            'end_time' =>$this->when($request->routeIs([
                'user.api.public.branch.get_branch_data',
            ]), $end_time),

            'current_status_operating_hours' =>$this->when($request->routeIs([
                'user.api.public.branch.get_branch_data',
            ]), $current_status_operating_hours),



            // 'branch_socail_media' => $this->social_media ? SocialMediaResource::collection($this->social_media) : null,
            // 'vendor_data' =>$this->when(
            //                             !$request->routeIs('user.api.vendor.auth.login'),
            //                             $this->vendor? new VendorResource($this->vendor) : null
            //                         ),
        ];
    }
}
