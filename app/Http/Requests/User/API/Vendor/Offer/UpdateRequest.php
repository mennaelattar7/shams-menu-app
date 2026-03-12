<?php

namespace App\Http\Requests\User\API\Vendor\Offer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Request;
use App\Models\VendorBranch__Offer;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(Request $request): array
    {
        $offer_slug = $this->route('offer_slug');

        $offer = VendorBranch__Offer::where('slug',$offer_slug)->first();

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
                Rule::unique('vendor_branch___offers','name->en')
                    ->ignore($offer?->id)
                    ->where(function($q) use ($request){
                        $q->where('branch_id',$request->branch_id);
                    }),
            ],

            'name.ar' => [
                'required',
                Rule::unique('vendor_branch___offers','name->ar')
                    ->ignore($offer?->id)
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
                'date',
                'after:start_date'
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
