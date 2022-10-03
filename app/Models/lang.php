<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lang extends Model
{
    use HasFactory;
    //fill
    protected $fillable = ['id', 'LangName', 'LangCode'];

    //relationships
    public function category_langs()
    {
        return $this->hasMany(Category::class);
    }

    //education level langs
    public function education_level_langs()
    {
        return $this->hasMany(EducationLevel::class);
    }
}
