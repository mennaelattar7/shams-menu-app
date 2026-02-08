<?php

namespace App\Http\Requests\User\API\Vendor\Product;

use App\Models\Product;
use App\Models\Vendor__MenuCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Request;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'product_slug' => $this->route('product_slug'),
        ]);
    }
    public function rules(Request $request): array
    {
        $product = Product::where('slug',$this->route('product_slug'))->first();
        $productId = $product ? $product->id : null;

        $rules=[
            'product_slug' => [
                'required',
                'exists:products,slug'
            ],
            'name.en' => [
                'required',
                Rule::unique('products', 'name->en')
                ->ignore($productId)
                ->where(function($q){
                    $category = Vendor__MenuCategory::find($this->category_id);
                    if($category)
                    {
                        $vendor = $category->vendor;
                        //get all categories in vendor
                        $categories_ids = $vendor->menu_categories()->pluck('id')->toArray();
                        $q->whereIn('category_id',$categories_ids);
                    }
                }),
            ],
            'name.ar' => [
                'required',
                Rule::unique('products', 'name->ar')
                ->ignore($productId)
                ->where(function($q){
                    $category = Vendor__MenuCategory::find($this->category_id);
                    if($category)
                    {
                        $vendor = $category->vendor;
                        //get all categories in vendor
                        $categories_ids = $vendor->menu_categories()->pluck('id')->toArray();
                        $q->whereIn('category_id',$categories_ids);
                    }
                }),
            ],
            'description' =>[
                'required',
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
