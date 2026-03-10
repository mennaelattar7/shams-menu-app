<?php

namespace App\Http\Requests\User\API\Vendor\Ad;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Request;

class CreateRequest extends FormRequest
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
    public function rules(Request $request): array
    {
        return [
            'name.en' => [
                'required',
            ],
            'name.ar' => [
                'required',
            ],
            'product_id' =>[
                'nullable',
                'exists:products,id'
            ],
            'start_date' =>[
                'required',
                'date'
            ],
            'end_date' =>[
                'required',
                'date'
            ],
            'activation_status' =>[
                'required',
                'in:active,inactive'
            ],
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048' // 2MB
            ],
            'branch_ids' =>[
                'required',
                'array'
            ],
            'branch_ids.*'=>[
                'integer',
                'exists:vendor___branches,id'
            ],

            // 'branch_id' =>[
            //     'required',
            //     'exists:vendor___branches,id',
            // ],





            // 'discount_type' =>[
            //     'required',
            //     'in:fixed,percentage'
            // ],
            // 'discount_value' =>[
            //     'required',
            //     'numeric',
            //     'min:0'
            // ],


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
