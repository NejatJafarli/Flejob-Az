<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditAccount extends FormRequest
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
            'FirstName' => 'required',
            'LastName' => 'required',
            'FatherName' => 'required',
            'City' => 'required',
            'Married' => 'required',
            'Username' => 'required | min:6 ', //unique for users
            'email' => 'required | email  ', //unique for users
            'phone' => 'required | regex:/^\+994\d{9}$/ ', //unique for users' ,
            'Languages' => 'required | array | min:1 ',
            'Categories' => 'array',
            'image'=>'image | mimes:jpeg,png,jpg,gif,svg | max:2048',
        ];
    }
    //messages
    public function messages()
    {
        return [
            'FirstName.required' => __('validationUser.Enter your first name'),
            'LastName.required' => __('validationUser.Enter your last name'),
            'FatherName.required' => __('validationUser.Enter your father name'),
            'City.required' => __('validationUser.Enter your city'),
            'Married.required' => __('validationUser.Enter your married status'),
            'Username.required' => __('validationUser.Enter your username'),
            'Username.min' => __('validationUser.Username must be at least 6 characters'),
            'email.required' => __('validationUser.Enter your email'),
            'email.email' => __('validationUser.Enter your email correctly'),
            'phone.required' => __('validationUser.Enter your phone number'),
            'phone.regex' => __('validationUser.Enter your phone number correctly'),
            'Languages.required' => __('validationUser.Enter your languages'),
            'Languages.array' => __('validationUser.Enter your languages'),
            'Languages.min' => __('validationUser.Enter your languages'),
            'image.image' => __('validationUser.Enter your image'),
            'image.mimes' => __('validationUser.image must be jpg, png, jpeg, gif, svg'),
            'image.max' => __('validationUser.image must be less than 2MB'),
        ];
    }
}
