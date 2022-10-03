<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyPhones extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'CompanyUser_Id',
        'CompanyPhone'
    ];
    public function CompanyUser()
    {
        return $this->belongsTo(CompanyUser::class);
    }
}
