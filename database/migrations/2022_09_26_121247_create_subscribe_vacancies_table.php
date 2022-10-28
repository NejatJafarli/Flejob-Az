<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscribeVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribe_vacancies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Vacancy_id');
            $table->unsignedBigInteger('User_id');
            $table->timestamps();

            $table->foreign('Vacancy_id')->references('id')->on('vacancies')->onDelete('cascade');
            $table->foreign('User_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscribe_vacancies');
    }
}
