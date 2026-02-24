<?php

namespace App\Http\Requests\User\API\Vendor\MenuCategory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
                'integer',
                'exists:vendor___menu_categories,id'
            ],
            'name' => [
                'required',
                'array',
            ],
            'name.en' =>[
                'required',
                'string',
                Rule::unique('vendor___menu_categories', 'name->en')
                    ->ignore($this->route('category_slug'),'slug') // أو id حسب الراوت
            ],
            'name.ar' =>[
                'required',
                'string',
                Rule::unique('vendor___menu_categories', 'name->ar')
                    ->ignore($this->route('category_slug'),'slug') // أو id حسب الراوت
            ],
            'image' => [
                'nullable',
                'sometimes',
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
            ],
            'array_branches_ids' => [
                'array',
                'min:1'
            ],
            'array_branches_ids.*' => [
                'integer',
                'exists:vendor___branches,id'
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
