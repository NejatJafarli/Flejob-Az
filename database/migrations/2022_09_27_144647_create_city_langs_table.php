<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCityLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city_langs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("city_id");
            $table->unsignedBigInteger("lang_id");
            $table->string("CityName");
            $table->timestamps();

            $table->foreign("city_id")->references("id")->on("cities");
            $table->foreign("lang_id")->references("id")->on("langs");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('city_langs');
    }
}
