<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    //fill
    protected $fillable = ['id', "StyleClass",'SortOrder'];


    //relationships
    public function vacancies()
    {
        return $this->hasMany(Vacancy::class);
    }

    public function category_langs()
    {
        return $this->hasMany(category_lang::class);
    }

}
