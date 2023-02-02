<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompanyUserIdWallettrans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wallet_transactions', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('CompanyUser_id')->nullable();


            $table->foreign('CompanyUser_id')->references('id')->on('company_users')->onDelete('cascade');
            // $table->foreign('wallet_id')->references('id')->on('wallets')->onDelete('cascade');
            // $table->foreign('vacancy_id')->references('id')->on('vacancies')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wallet_transactions', function (Blueprint $table) {
            //
        });
    }
}
