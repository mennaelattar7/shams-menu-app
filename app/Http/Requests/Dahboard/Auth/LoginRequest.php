<?php

namespace App\Http\Requests\Dahboard\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => [
                'email',
                'required',
                'exists:users,email'
            ],
            'password' => [
                'required',
                'min:8',
                'max:20'
            ],
        ];
    }
    public function messages()
    {
        return[
            'email.required' => trans('Dashboard.Please_enter_your_email'),
        ];
    }
    public function req_method()
    {
        $remember = $this->boolean('remember');
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password]))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
