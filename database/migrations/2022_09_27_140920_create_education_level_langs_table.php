<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationLevelLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_level_langs', function (Blueprint $table) {
            $table->id();
            $table->string('EducationLevelName');
            $table->unsignedBigInteger("education_level_id");
            $table->unsignedBigInteger("lang_id");
            $table->timestamps();

            $table->foreign('education_level_id')->references('id')->on('education_levels');
            $table->foreign('lang_id')->references('id')->on('langs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('education_level_langs');
    }
}
