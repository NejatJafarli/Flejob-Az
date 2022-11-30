<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blog extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'Title', 'Description', 'Image', 'MetaTitle', 'MetaDescription', 'MetaKeywords'];

    
}
