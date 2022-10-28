<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'Vacancy_id',
        'Title',
        'message',
        'UserId'
    ];
    public function VacancyId()
    {
        return $this->belongsTo(Vacancy::class);
    }

    public function UserId()
    {
        return $this->belongsTo(User::class);
    }

    
}
