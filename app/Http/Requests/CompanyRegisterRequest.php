<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRegisterRequest extends FormRequest
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
            'CompanyName' => 'required',
            'CompanyUsername' => 'required | min:6 | unique:company_users ', //unique for users
            'CompanyEmail' => 'required | email | unique:company_users',
            'CompanyPassword' => 'required | min:6',
            'CompanyAddress' => 'required',
            'CompanyLogo' => 'required | image | mimes:jpeg,png,jpg,gif,svg | max:2048',
            'CompanyDescription' => 'required',
            'CompanyCategories' => ' required | array | min:1 ',
            'CompanyPhone' =>'required | array | min:1',
            'CompanyWebSiteLink' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'CompanyName.required' => __('companyValidation.Enter your company name'),
            'CompanyUsername.required' => __('companyValidation.Enter your company username'),
            'CompanyEmail.required' => __('companyValidation.Enter your company email'),
            'CompanyPassword.required' => __('companyValidation.Enter your company password'),
            'CompanyPassword_confirmation.required' => __('companyValidation.Enter your company password confirmation'),
            'CompanyAdress.required' => __('companyValidation.Enter your company address'),
            'CompanyPhone.required' => __('companyValidation.Enter your company phone'),
            'CompanyLogo.required' => __('companyValidation.Enter your company logo'),
            'CompanyDescription.required' => __('companyValidation.Enter your company description'),
            'Categories.required' => __('companyValidation.Enter your company categories'),
            'CompanyLink.required' => __('companyValidation.Enter your company link'),
            'CompanyUsername.unique' => __('companyValidation.This username is already taken'),
            'CompanyEmail.unique' => __('companyValidation.This email is already taken'),
            'CompanyPassword.min' => __('companyValidation.Password must be at least 6 characters'),
            'CompanyPassword_confirmation.same' => __('companyValidation.Password confirmation must be same as password'),
            'CompanyLogo.mimes' => __('companyValidation.Enter your company logo in correct format'),
            'CompanyLogo.max' => __('companyValidation.Enter your company logo in correct size'),
            'Categories.min' => __('companyValidation.Enter your company categories'),
            'Categories.array' => __('companyValidation.Enter your company categories'),
        ];
        // 'CompanyPhone.regex' => __('companyValidation.Enter your company phone in correct format'),
    }
}
