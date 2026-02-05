<?php

namespace App\Http\Requests\User\API\Vendor\Product;

use App\Models\Vendor__MenuCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
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
        $category = Vendor__MenuCategory::find($request->category_id);
        $vendor = $category->vendor;
        //get all categories in vendor
        $categories_ids = $vendor->menu_categories()->pluck('id')->toArray();

        $rules =[
            'name.en' => [
                'required',
                Rule::unique('products', 'name->en')
                ->where(function($q) use ($categories_ids){
                    $q->whereIn('category_id',$categories_ids);
                }),
            ],
            'name.ar' => [
                'required',
                Rule::unique('products', 'name->ar')
                ->where(function($q) use ($categories_ids){
                    $q->whereIn('category_id',$categories_ids);
                }),
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
                'array'
            ],
            'cooking_level_ids' =>[
                'array'
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
