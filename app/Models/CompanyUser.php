<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyUser extends Model
{
    use HasFactory;

    // table name
    protected $table='company_users';
    
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
        'slug'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($companyUser) {
            //find the lang languageCode = az
            // $lang = lang::where('LanguageCode', 'az')->first();

            // $cat_lang = category_lang::where('Category_id', $cat->id)->where('lang_id', $lang->id)->first();
            
            $companyUser->slug = str_replace(' ', '-', strtolower($companyUser->CompanyName));
        });

        //auto slug maker
        static::saving(function ($comp) {
            $comp->slug = str_replace(' ', '-', strtolower($comp->CompanyName));
        });
    }
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
