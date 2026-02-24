<?php

namespace App\Http\Requests\User\API\Vendor\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class ResetPasswordRequest extends FormRequest
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
        $rules = [
            'phone_number' =>[
                'required',
                'exists:users,phone_number'
            ],
            'token' =>[
                'required',
                'string',
                'exists:password_reset_tokens,token'
            ],
            'password' =>[
                'required',
                'string',
                'min:6',
                'max:20',
                'confirmed'
            ],
            'password_confirmation' =>[
                'required',
                'string',
                'min:6',
                'max:20',
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
