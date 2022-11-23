<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_langs', function (Blueprint $table) {
            $table->id();
            $table->string('CategoryName');
            $table->text('MetaTitle')->nullable();
            $table->text('MetaDescription')->nullable();
            $table->text('MetaKeywords')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('lang_id');
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories');

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
        Schema::dropIfExists('category_langs');
    }
}
