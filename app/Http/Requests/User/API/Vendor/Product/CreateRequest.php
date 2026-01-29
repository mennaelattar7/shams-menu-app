<?php

namespace App\Http\Requests\User\API\Vendor\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
class CreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        $rules =[
            'name.en' => [
                'required',
                Rule::unique('products', 'name->en'),
            ],
            'name.ar' => [
                'required',
                Rule::unique('products', 'name->ar'),
            ],
            'description' =>[
                'required',
                'unique:products,description'
            ],
            'price' =>[
                'required',
                'numeric',
                'min:0.01',
            ],
            'calories' =>[
                'required',
                'numeric',
            ],
            'image'=>[
                'required',
            ],
            'category_id' =>[
                'required',
                'exists:vendor___menu_categories,id'
            ],
            'product_type_id'=>[
                'required',
                'exists:shams___product_types,id'
            ],
            'product_variant_name' =>[
                'nullable'
            ],
            'activation_status' =>[
                'in:active,inactive'
            ],
            'branches_ids' =>[
                'required',
                'array'
            ],
            'badges_ids' =>[
                'required',
                'array'
            ],
            'cooking_level_ids' =>[
                'required',
                'array'
            ],




            // 'allergens' => [
            //     'nullable',
            //     'array'
            // ],
            // 'allergens.*.name' => [
            //     'required',
            //     'string',
            //     'max:100',
            // ],
            // 'allergens.*.display_name' => [
            //     'required',
            //     'array',
            // ],

            // 'allergens.*.display_name.en' => [
            //     'required',
            //     'string',
            // ],

            // 'allergens.*.display_name.ar' => [
            //     'required',
            //     'string',
            // ],
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
