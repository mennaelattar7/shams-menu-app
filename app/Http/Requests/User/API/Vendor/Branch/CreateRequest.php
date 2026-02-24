<?php

namespace App\Http\Requests\User\API\Vendor\Branch;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class CreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        $rules =[
            'name' =>[
                'required',
                'unique:vendor___branches,name'
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
