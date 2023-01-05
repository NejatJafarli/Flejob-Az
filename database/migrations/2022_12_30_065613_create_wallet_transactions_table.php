<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wallet_id');
            $table->unsignedBigInteger('vacancy_id');
            $table->string('session_id');
            $table->string('order_id');
            $table->string('order_status');  //Approved Canceled Declined
            $table->string('order_status_code')->nullable(); 
            $table->string('order_status_description')->nullable();
            $table->string('amount');
            $table->string('currency');
            $table->string('transaction_id')->nullable();
            $table->string('PAN')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallet_transactions');
    }
}
