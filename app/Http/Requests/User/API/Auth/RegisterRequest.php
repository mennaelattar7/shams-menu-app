<?php

namespace App\Http\Requests\User\API\Auth;

use App\Models\Country;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        $rules= [
            'name' =>[
                'required',
                'string',
                'max:255'
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email'
            ] ,
            'country_dial_code_id' =>[
                'required'
            ],
            'phone_number' =>[
                'required',
                'unique:users,phone_number'
            ],
            'password' =>[
                'required',
                'min:6'
            ]
        ];
        $country_dial_code_id = $this->input('country_dial_code_id');
        $country_code = Country::find($country_dial_code_id)->country_code;

        // نعمل regex مختلف حسب الدولة
        switch ($country_code) {
            case 'EG': // مصر
                $rules['phone_number'][] = 'regex:/^01[0125][0-9]{8}$/';
                break;

            case 'SA': // السعودية
                $rules['phone_number'][] = 'regex:/^05[0-9]{8}$/';
                break;
        }
        return $rules;
    }
}
