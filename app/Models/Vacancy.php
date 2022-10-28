<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use HasFactory;
    //fill
    protected $fillable = [
        "VacancyName",
        "Category_id",
        "VacancyDescription",
        "VacancyRequirements",
        'City_id',
        'Photo',
        'Status',
        "CompanyUser_id",
        "PersonName",
        "PersonPhone",
        "VacancySalary",
        "Email",
        "EndDate",
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function companyUser()
    {
        return $this->belongsTo(CompanyUser::class);
    }
    
}
