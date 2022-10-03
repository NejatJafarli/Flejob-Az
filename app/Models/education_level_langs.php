<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class education_level_langs extends Model
{
    use HasFactory;

    //fill
    protected $fillable = ['id', 'EducationLevelName', 'education_level_id', 'lang_id'];

    //relationships
    public function education_level()
    {
        return $this->belongsTo(EducationLevel::class);
    }
    public function lang()
    {
        return $this->belongsTo(lang::class);
    }
}
