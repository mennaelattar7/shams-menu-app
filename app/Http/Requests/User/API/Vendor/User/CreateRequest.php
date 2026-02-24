<?php

namespace App\Http\Requests\User\API\Vendor\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Request;

class CreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(Request $request): array
    {
        $rules =[
            'name' => [
                'required',
            ],
            'phone_number' =>[
                'required',
                'unique:users,phone_number'
            ],
            'position_id' =>[
                'required',
                'exists:vendor___employee_positions,id'
            ],
        ];
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
