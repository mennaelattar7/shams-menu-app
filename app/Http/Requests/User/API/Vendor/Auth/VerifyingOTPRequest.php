<?php

namespace App\Http\Requests\User\API\Vendor\Auth;

use Illuminate\Foundation\Http\FormRequest;

class VerifyingOTPRequest extends FormRequest
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
            'country_dial_code_id' =>[
                'required',
                'exists:countries,id'
            ],
            'phone_number'=>[
                'required',
            ],
            'otp' =>[
                'required',
                'digits:6'
            ]
        ];
        return $rules;
    }
}
