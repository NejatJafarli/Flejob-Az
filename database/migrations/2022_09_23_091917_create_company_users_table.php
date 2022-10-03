<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_users', function (Blueprint $table) {
            $table->id();
            $table->string('CompanyName');
            $table->string('CompanyUsername');
            $table->string('CompanyEmail');
            $table->string('CompanyPassword');
            $table->string('CompanyWebSiteLink');
            $table->string('CompanyDescription');
            $table->string('CompanyLogo');
            $table->string('CompanyAddress');
            $table->integer('Status');
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
        Schema::dropIfExists('company_users');
    }
}
