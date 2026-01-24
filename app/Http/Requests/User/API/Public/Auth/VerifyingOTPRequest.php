<?php

namespace App\Http\Requests\User\API\Public\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

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
            'phone_number' =>[
                'required',
                'exists:users,phone_number'
            ],
            'otp' =>[
                'required',
                'digits:6'
            ]
        ];

        $rules['phone_number'][] = 'regex:/^05[0-9]{8}$/';
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
