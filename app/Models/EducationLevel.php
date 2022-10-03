<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationLevel extends Model
{
    use HasFactory;
    //fill
    protected $fillable = ['id'];
    
    //relationships
    public function education_level_langs()
    {
        return $this->hasMany(education_level_langs::class);
    }


}
