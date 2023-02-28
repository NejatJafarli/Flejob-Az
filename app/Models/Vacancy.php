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
        'WithAgreement',
        "CompanyUser_id",
        "PersonName",
        "PersonPhone",
        "VacancySalary",
        "Email",
        "EndDate",
        "slug"
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($vac) {

            $last_id = Vacancy::latest()->first()->id;
            //convert to int
            $last_id = (int)$last_id+1;
            $vac->slug = str_replace(' ', '-', strtolower($vac->VacancyName)).'-'.$last_id;
        });

        // static::saving(function ($cat) {
            
        //     $cat->slug = str_replace(' ', '-', strtolower($cat->VacancyName).'-'.$cat->id);
        //     //remove the slash from the slug /
        //     $cat->slug = str_replace('/', '-', strtolower($cat->slug));
        // });
    }
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_replace(' ', '-', strtolower($value)).'-'.$this->id;
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function companyUser()
    {
        return $this->belongsTo(CompanyUser::class);
    }
    
}
