<?php

namespace App\Http\Requests\User\API\Vendor\Offer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
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
            'branch_id' =>[
                'required',
                'exists:vendor___branches,id',
            ],
            'category_id' =>[
                'nullable',
                'exists:vendor___menu_categories,id'
            ],
            'product_ids' =>[
                'array'
            ],
            'product_ids.*'=>[
                'integer',
                'exists:products,id'
            ],
            'name.en' => [
                'required',
                Rule::unique('vendor_branch___offers', 'name->en')
                ->where(function($q) use ($request){
                    $q->where('branch_id',$request->branch_id);
                }),
            ],
            'name.ar' => [
                'required',
                Rule::unique('vendor_branch___offers', 'name->ar')
                ->where(function($q) use ($request){
                    $q->where('branch_id',$request->branch_id);
                }),
            ],
            'discount_type' =>[
                'required',
                'in:fixed,percentage'
            ],
            'discount_value' =>[
                'required',
                'numeric',
                'min:0'
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
            ]
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
