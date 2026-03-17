<?php

namespace App\Http\Requests\User\API\Vendor\MenuCategory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

class CreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        $vendor = Auth::user()->vendor_representative->vendor;
        $rules =[
            'parent_category_id' =>[
                'nullable',
                'integer',
                'exists:vendor___menu_categories,id'
            ],

            'name.en' => [
                'required',
                Rule::unique('vendor___menu_categories', 'name->en')
                ->where(function($q) use ($vendor){
                    $q->where('vendor_id',$vendor->id);
                }),
            ],
            'name.ar' => [
                'required',
                Rule::unique('vendor___menu_categories', 'name->ar')
                ->where(function($q) use ($vendor){
                    $q->where('vendor_id',$vendor->id);
                }),
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
            ],
            'array_branches_ids' => [
                'required',
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
