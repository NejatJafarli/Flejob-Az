<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class company_and_categories extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'CompanyUser_Id',
        'category_id'
    ];
}
