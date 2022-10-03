<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
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
            'username' => 'required| min:3 | max:20',
            'password' => 'required|min:5|max:12'


        ];
    }
    public function messages()
    {
        return[
            'username.required' => __('validationAdmin.Enter your username'),
            'username.min' => __('validationAdmin.Username must be at least 3 characters'),
            'username.max' => __('validationAdmin.Username must be at least 20 characters'),
            'password.required' => __('validationAdmin.Enter your password'),
            'password.min' => __('validationAdmin.Password must be at least 5 characters'),
            'password.max' => __('validationAdmin.Password must be at least 12 characters'),
        ];
    }
}
