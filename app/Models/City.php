<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    //fill
    protected $fillable = ['id'];


    //relation ship with city Lang
    public function cityLang()
    {
        return $this->hasMany(city_lang::class);
    }
    
    
}
