<?php

namespace App\Http\Requests\User\API\Vendor\Ad;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Request;

class UpdateRequest extends FormRequest
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
        return [

            'name.en' => [
                'sometimes',
                'required',
            ],

            'name.ar' => [
                'sometimes',
                'required',
            ],

            'product_id' =>[
                'nullable',
                'exists:products,id'
            ],

            'start_date' =>[
                'sometimes',
                'date'
            ],

            'end_date' =>[
                'sometimes',
                'date'
            ],

            'activation_status' =>[
                'sometimes',
                'in:active,inactive'
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048'
            ],

            'branch_ids' =>[
                'sometimes',
                'array'
            ],

            'branch_ids.*'=>[
                'integer',
                'exists:vendor___branches,id'
            ],
        ];
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
