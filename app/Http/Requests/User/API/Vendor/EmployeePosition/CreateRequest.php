<?php

namespace App\Http\Requests\User\API\Vendor\EmployeePosition;

use App\Models\Vendor__MenuCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
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
        $vendor = Auth::user()->vendor_representative->vendor;

        $rules =[
            'name.en' => [
                'required',
                Rule::unique('vendor___employee_positions', 'name->en')
                ->where(function($q) use ($vendor){
                    $q->where('vendor_id',$vendor->id);
                }),
            ],
            'name.ar' => [
                'required',
                Rule::unique('vendor___employee_positions', 'name->ar')
                ->where(function($q) use ($vendor){
                    $q->where('vendor_id',$vendor->id);
                }),
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
