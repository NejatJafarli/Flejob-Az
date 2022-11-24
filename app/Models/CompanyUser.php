<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyUser extends Model
{
    use HasFactory;

    protected $fillable=[
        'id',
        'CompanyName',
        'CompanyUsername',
        'CompanyEmail',
        'CompanyPassword',
        'CompanyAddress',
        'CompanyDescription',
        'CompanyLogo',
        'CompanyWebsite',
        'Status',
        'FreeVacancy',
        'Paying',
    ];

    public function CompanyAndCategories()
    {
        return $this->belongsToMany(company_and_categories::class,'company_and_categories','CompanyUser_Id','category_id');
    }


    public function CompanyPhones(){
        return $this->hasMany(CompanyPhones::class,'CompanyUser_Id','CompanyPhone');
    }

    public function Vacancies(){
        return $this->hasMany(Vacancy::class,'CompanyUser_Id','id');
    }
    
}
