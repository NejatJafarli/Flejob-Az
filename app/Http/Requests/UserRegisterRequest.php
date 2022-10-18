<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            'BirthDate' => 'required',
            'City' => 'required',
            'Married' => 'required',
            'Username' => 'required | min:6 | unique:users', //unique for users
            'Password' => 'required | min:6',
            'Password_confirmation' => 'required | same:Password',
            'email' => 'required | email  |  unique:users', //unique for users
            'phone' => 'required | regex:/^\+994\d{9}$/ |unique:users', //unique for users' ,
            'companyname' => 'array',
            'companyrank' => 'required_if:companyname ,!=, null | array',
            'companyEnddate' => 'required_if:companyname ,!=, null | array',
            'companyStartdate' => 'required_if:companyname ,!=, null | array',
            'image' => 'required | image | mimes:jpeg,png,jpg,gif,svg | max:2048',
            'educationName' =>  'array',
            //Year regex:
            'educationYear' => 'required_if:educationName  ,!=, null | array',
            'educationLevel' => 'required_if:educationName ,!=, null  | array',
            'Languages' => 'required | array | min:1 ',
            'Categories' => 'array',
            'LinkName' =>   'required_if:Link ,!=, null',
            'Link' =>   'required_if:LinkName ,!=, null',
        ];
    }
    //messages
    public function messages()
    {
        return [
            'FirstName.required' => __('validationUser.Enter your first name'),
            'LastName.required' => __('validationUser.Enter your last name'),
            'FatherName.required' => __('validationUser.Enter your father name'),
            'BirthDate.required' => __('validationUser.Enter your birth date'),
            'City.required' => __('validationUser.Enter your city'),
            'Married.required' => __('validationUser.Enter your married status'),
            'Username.required' => __('validationUser.Enter your username'),
            'Username.min' => __('validationUser.Username must be at least 6 characters'),
            'Password.required' => __('validationUser.Enter your password'),
            'Password.min' => __('validationUser.Password must be at least 6 characters'),
            'Password_confirmation.required' => __('validationUser.Enter your password confirmation'),
            'Password_confirmation.same' => __('validationUser.Password confirmation must be same as password'),
            'email.required' => __('validationUser.Enter your email'),
            'email.email' => __('validationUser.Enter your email correctly'),
            'phone.required' => __('validationUser.Enter your phone number'),
            'phone.regex' => __('validationUser.Enter your phone number correctly'),
            'companyname.required_if' => __('validationUser.Enter your company name'),
            'companyrank.required_if' => __('validationUser.Enter your company rank'),
            'companyEnddate.required_if' => __('validationUser.Enter your company date'),
            'companyStartdate.required_if' => __('validationUser.Enter your company date'),
            'image.required' => __('validationUser.Enter your image'),
            'image.image' => __('validationUser.image must be jpg, png, jpeg, gif, svg'),
            'image.mimes' => __('validationUser.image must be jpg, png, jpeg, gif, svg'),
            'image.max' => __('validationUser.image must be less than 2MB'),
            'educationName.required_if' => __('validationUser.Enter your education name'),
            'educationYearStart.required_if' => __('validationUser.Enter your education year'),
            'educationYearEnd.required_if' => __('validationUser.Enter your education year'),
            'educationLevel.required_if' => __('validationUser.Enter your education level'),
            'Languages.required' => __('validationUser.Enter your languages'),
            'Languages.array' => __('validationUser.Enter your languages'),
            'Languages.min' => __('validationUser.Enter your languages'),
            'LinkName.required_if' => __('validationUser.Enter your link name'),
            'Link.required_if' => __('validationUser.Enter your link'),
        ];
    }
}
