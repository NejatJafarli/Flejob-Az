<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education', function (Blueprint $table) {
            $table->id();
            $table->string('EducationName');
            $table->smallInteger('YearStart');
            $table->smallInteger('YearEnd');
            $table->unsignedBigInteger('EducationLevel_Id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("EducationLevel_Id")->references("id")->on("education_levels");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('education');
    }
}
