<?php

namespace App\Http\Requests\User\API\Vendor\Branch;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;
class CreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(Request $request): array
    {
        $vendor = Auth::user()->vendor_representative->vendor;
        $rules =[
            'name.en' => [
                'required',
                Rule::unique('vendor___branches', 'name->en')
                ->where(function($q) use ($vendor){
                    $q->where('vendor_id',$vendor->id);
                }),
            ],
            'name.ar' => [
                'required',
                Rule::unique('vendor___branches', 'name->ar')
                ->where(function($q) use ($vendor){
                    $q->where('vendor_id',$vendor->id);
                }),
            ],
            'city_id'=>[
                'required',
                'exists:cities,id'
            ],
            'district_id'=>[
                'required',
                'exists:districts,id'
            ],
            'google_map_link' =>[
                'required'
            ],
            'phone_number' =>[
                'required',
            ],
            'whatsapp_number'=>[
                'required'
            ],
            'number_of_tables' =>[
                'required',
                'integer'
            ],
            'activation_status' =>[
                'required'
            ]
        ];
        $rules['phone_number'][] = 'regex:/^05[0-9]{8}$/';
        $rules['whatsapp_number'][] = 'regex:/^05[0-9]{8}$/';
        return $rules;
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'errors' => $validator->errors()
        ], 422));
    }
}
