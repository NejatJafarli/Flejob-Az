<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\category_lang;
use App\Models\lang;

class Category extends Model
{
    use HasFactory;
    //fill
    protected $fillable = ['id', "StyleClass",'SortOrder',"slug"];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($cat) {
            //find the lang languageCode = az
            $lang = lang::where('LanguageCode', 'az')->first();

            $cat_lang = category_lang::where('Category_id', $cat->id)->where('lang_id', $lang->id)->first();
            
            $cat->slug = str_replace(' ', '-', strtolower($cat_lang->CategoryName));
            
        });
        //auto slug maker
        // static::saving(function ($cat) {
        //     $lang = lang::where('LanguageCode', 'az')->first();

        //     $cat_lang = category_lang::where('Category_id', $cat->id)->where('lang_id', $lang->id)->first();
            
        //     $cat->slug = str_replace(' ', '-', strtolower($cat_lang->CategoryName));
        // });
    }

    //relationships
    public function vacancies()
    {
        return $this->hasMany(Vacancy::class);
    }

    public function category_langs()
    {
        return $this->hasMany(category_lang::class);
    }

}
