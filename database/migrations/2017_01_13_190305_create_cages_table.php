<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('male');
            $table->foreign('male')->references('id')->on('mice');
            $table->unsignedInteger('female_one');
            $table->foreign('female_one')->references('id')->on('mice');
            $table->unsignedInteger('female_two')->nullable();
            $table->foreign('female_two')->references('id')->on('mice');
            $table->unsignedInteger('female_three')->nullable();
            $table->foreign('female_three')->references('id')->on('mice');
            $table->string('room_num')->nullable();
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
        Schema::drop('cages');
    }
}
