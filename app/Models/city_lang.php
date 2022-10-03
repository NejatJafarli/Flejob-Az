<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class city_lang extends Model
{
    use HasFactory;
    //fill
    protected $fillable = ['id','city_id','lang_id','CityName'];


    //relation ship with city
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    
}
