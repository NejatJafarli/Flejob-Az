<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('FirstName');
            $table->string('LastName');
            $table->string('FatherName');
            $table->date('BirthDate');
            $table->string('image');
            $table->string('Description')->nullable();
            $table->string('Skills')->nullable();
            $table->boolean('Married');
            $table->string('Username')->unique();
            $table->string('Password');
            $table->unsignedBigInteger('City_id');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->unsignedInteger('MinSalary')->nullable();
            $table->unsignedInteger('MaxSalary')->nullable();
            $table->integer('Status')->default(1);
            $table->timestamps();

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
        Schema::dropIfExists('users');
    }
}
