<?php

namespace App\Http\Requests\User\API\Vendor\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRatingsRequest extends FormRequest
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
            'rating' =>[
                'required',
                'integer'
            ],
            'ratings_count'=>[
                'required',
                'integer'
            ],
            'message_notes' =>[
                'required'
            ]
        ];
    }
}
