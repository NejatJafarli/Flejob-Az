<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersAndLanguages extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_id',
        'language_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
