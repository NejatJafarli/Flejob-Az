<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    //fill
    protected $fillable = ['id','EducationLevel_id','EducationName','YearStart','YearEnd','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function educationLevel()
    {
        return $this->belongsTo(EducationLevel::class);
    }
}
