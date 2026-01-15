<?php

namespace App\Http\Requests\User\API\Vendor\Branch;

use Illuminate\Foundation\Http\FormRequest;
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
        return [
            'name' => [
                'required'
            ],
            'city_id' => [
                'required',
                'integer',
                'exists:cities,id'
            ],
            'district_id' => [
                'required',
                'integer',
                'exists:districts,id'
            ],
            'google_map_link' => [
                'url'
            ] ,
            'phone_number' => [
                'required',
                'string',
                'max:20'
            ],
            'whatsapp_number' => [
                'required',
                'string',
                'max:20'
            ],
            'number_of_tables' => [
                'required',
                'integer',
                'min:1'
            ],
            'activation_status' => [
                'required',
                'in:active,inactive'
            ],
            'operating_hours' =>[
                'required',
                'array'
            ] ,
            'operating_hours.*.day_of_week' =>[
                'required',
                'integer',
                'min:1',
                'max:7'
            ],
            'operating_hours.*.shifts' => [
                'required',
                'array'
            ] ,
            'operating_hours.*.shifts.*.start_time' => [
                'required',
            ],
            'operating_hours.*.shifts.*.end_time' =>[
                'required'
            ],
            'operating_hours.*.shifts.*.is_open' =>[
                'required',
                'in:yes,no'
            ] ,
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
