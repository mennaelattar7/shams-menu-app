<?php

namespace App\Http\Requests\User\API\Vendor\Vendor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

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
        //get vandor
        $vendor = Auth::user()->vendor_representative->vendor;
        return [
            'company_name' => [
                'required',
                Rule::unique('vendors', 'company_name')->ignore($vendor->id),
            ],
            'brand_name.en'=>[
                'required',
                Rule::unique('vendors', 'brand_name->en')->ignore($vendor->id),
            ],
            'brand_name.ar'=>[
                'required',
                Rule::unique('vendors', 'brand_name->ar')->ignore($vendor->id),
            ],
            'logo' =>[
                'required'
            ],
            'banar' =>[
                'required'
            ],
            'slogan.en' => [
                Rule::unique('vendors', 'slogan')->ignore($vendor->id),
            ],
            'currency_ids' =>[
                'required',
                'array'
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
