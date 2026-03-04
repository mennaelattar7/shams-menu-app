<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'user_id' => $this->id,
            'user_name' =>$this->name,
            'user_slug' =>$this->slug,
            'user_email' => $this->email,
            'user_country_dial_code' => $this->country->dial_code,
            'user_phone_number' =>$this->phone_number,
            'user_account_type' =>$this->account_type,
            'activation_status' =>$this->activation_status,
            'account_status' => $this->account_status,
            'roles' =>$this->getRoleNames(),
            'vendor_data' => $this->when($this->vendor_representative !=null || $this->employee !=null,function(){
                if($this->vendor_representative !=null)
                {
                    return [
                        'company_name' =>$this->vendor_representative->vendor->company_name
                        ];
                }
                if($this->employee !=null)
                {
                    return [
                        'company_name' =>$this->employee->vendor->company_name
                        ];
                }

            }),

        ];
    }
}
