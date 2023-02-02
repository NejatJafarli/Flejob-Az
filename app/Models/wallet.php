<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'CompanyUser_id',
        'total_spend',
        'status',
        'UserId'
    ];

    public function company_user()
    {
        return $this->belongsTo(CompanyUser::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
