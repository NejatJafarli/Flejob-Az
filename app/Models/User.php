<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    //fill
    protected $fillable = [
        'id',
        'FirstName',
        'LastName',
        'FatherName',
        'BirthDate',
        'image',
        'Description',
        'Skills',
        'Married',
        'Username',
        'email',
        'Password',
        'phone',
        'MinSalary',
        'MaxSalary',
        'City_id',
    ];

    public function education()
    {
        return $this->hasMany(Education::class, 'user_id', 'EducationName','EducationLevel_id','YearStart','YearEnd');
    }
    public function Links()
    {
        return $this->hasMany(Link::class);
    }

    public function Companies()
    {
        return $this->hasMany(Company::class);
    }

    public function usersAndCategories()
    {
        return $this->belongsToMany(UsersAndCategories::class,'users_and_categories','User_id','Category_id');
    }

    public function usersAndLanguages()
    {
        return $this->belongsToMany(UsersAndLanguages::class,'users_and_languages','User_id','Language_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    
}
