<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VacancyAddRequest extends FormRequest
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
            "VacancyName" => "required | min:3 | max:50",
            "Category_id" => "required | integer | exists:categories,id",
            "VacancyDescription" => "required | min:10" ,
            "CompanyUser_id" => "required | exists:company_users,id",
            "PersonName" => "required | min:3",
            "PersonPhone" => "required | regex:/^\+994\d{9}$/",
            "VacancySalary" => "required | numeric",
            "Email" => "required | email",
            "Status" => "required | integer",
        ];
    }
    public function messages()
    {
        return [
            "VacancyName.required" => __("VacancyAddValidation.Vacancy name is required"),
            "VacancyName.min" => __("VacancyAddValidation.Vacancy name must be at least 3 characters"),
            "VacancyName.max" => __("VacancyAddValidation.Vacancy name must be at most 50 characters"),
            "Category_id.required" => __("VacancyAddValidation.Category is required"),
            "Category_id.integer" => __("VacancyAddValidation.Category must be integer"),
            "Category_id.exists" => __("VacancyAddValidation.Category does not exist"),
            "VacancyDescription.required" => __("VacancyAddValidation.Vacancy description is required"),
            "VacancyDescription.min" => __("VacancyAddValidation.Vacancy description must be at least 10 characters"),
            "CompanyUser_id.required" => __("VacancyAddValidation.Company user is required"),
            "CompanyUser_id.exists" => __("VacancyAddValidation.Company user does not exist"),
            "PersonName.required" => __("VacancyAddValidation.Person name is required"),
            "PersonName.min" => __("VacancyAddValidation.Person name must be at least 3 characters"),
            "PersonPhone.required" => __("VacancyAddValidation.Person phone is required"),
            "PersonPhone.regex" => __("VacancyAddValidation.Person phone must be in +994xxxxxxxxx format"),
            "VacancySalary.required" => __("VacancyAddValidation.Vacancy salary is required"),
            "VacancySalary.numeric" => __("VacancyAddValidation.Vacancy salary must be numeric"),
            "Email.required" => __("VacancyAddValidation.Email is required"),
            "Email.email" => __("VacancyAddValidation.Email must be valid"),
            "Status.required" => __("VacancyAddValidation.Status is required"),
            "Status.integer" => __("VacancyAddValidation.Status must be integer"),
            "Status.min" => __("VacancyAddValidation.Status must be at least 0"),
            "Status.max" => __("VacancyAddValidation.Status must be at most 1"),
        ];
    }
}
