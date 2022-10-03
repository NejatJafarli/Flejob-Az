<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category_lang extends Model
{
    use HasFactory;
    //fill
    protected $fillable = ['id', 'CategoryName', 'MetaTitle', 'MetaDescription', 'MetaKeywords', 'category_id', 'lang_id'];

    //relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function lang()
    {
        return $this->belongsTo(lang::class);
    }
    
}
