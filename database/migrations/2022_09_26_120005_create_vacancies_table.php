<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('VacancyName');
            $table->unsignedBigInteger('Category_id');
            $table->text('VacancyDescription');
            $table->text('VacancyRequirements');
            $table->unsignedBigInteger('CompanyUser_id');
            $table->unsignedBigInteger('City_id');
            $table->date('EndDate');
            $table->string('PersonName');
            $table->string('PersonPhone');
            $table->string('VacancySalary');
            $table->string('Email');
            $table->integer('Status')->default(4); // 0 inactive | 1 active | 3 accepted but not payed | 4 moderator waiting  | 5 rejected
            $table->integer('SortOrder')->default(0);
            $table->dateTime('PremiumEndDate')->nullable();
            $table->timestamps();

            $table->foreign('Category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('CompanyUser_id')->references('id')->on('company_users')->onDelete('cascade');
            $table->foreign('City_id')->references('id')->on('cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vacancies');
    }
}
