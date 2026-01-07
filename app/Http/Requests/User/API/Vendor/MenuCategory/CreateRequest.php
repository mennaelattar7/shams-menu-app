<?php

namespace App\Http\Requests\User\API\Vendor\MenuCategory;

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
            'parent_category_id' =>[
                'nullable',
                'integer'
            ],
            'name'=>[
                'required',
                'array'
            ],
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048' // 2MB
            ],
            'activation_status'=>[
                'required'
            ],
            'sort' =>[
                'required',
                'integer'
            ]
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
