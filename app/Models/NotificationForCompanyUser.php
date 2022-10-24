<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationForCompanyUser extends Model
{
    use HasFactory;
    protected $table = 'notification_for_company_users';
    protected $fillable = [
        'user_id',
        'vacancy_id',
        'body',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }
}
