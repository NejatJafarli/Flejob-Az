<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wallet_transaction extends Model
{
    use HasFactory;
    // $table->unsignedBigInteger('wallet_id');
    // $table->unsignedBigInteger('vacancy_id');
    // $table->string('session_id');
    // $table->string('order_id');
    // $table->string('order_status');  //Approved Canceled Declined
    // $table->string('amount');
    // $table->string('currency');
    // $table->string('transaction_id')->nullable();
    // $table->string('PAN')->nullable();

    protected $fillable = [
        'id',
        'wallet_id',
        'vacancy_id',
        'session_id',
        'order_id',
        'order_status',
        'order_status_code',
        'order_status_description',
        'amount',
        'currency',
        'transaction_id',
        'PAN',
    ];

    public function wallet()
    {
        return $this->belongsTo(wallet::class);
    }

    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }

    
}
