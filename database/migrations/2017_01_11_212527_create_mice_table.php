<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mice', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('colony_id');
            $table->foreign('colony_id')->references('id')->on('colonies');
            $table->string('source');
            $table->unsignedInteger('reserved_for')->nullable();
            $table->foreign('reserved_for')->references('id')->on('users');
            $table->boolean('sex')->nullable();
            $table->boolean('geno_type_a')->nullable();
            $table->boolean('geno_type_b')->nullable();
            $table->unsignedInteger('father')->nullable();
            $table->foreign('father')->references('id')->on('mice');
            $table->unsignedInteger('mother_one')->nullable();
            $table->foreign('mother_one')->references('id')->on('mice');
            $table->unsignedInteger('mother_two')->nullable();
            $table->foreign('mother_two')->references('id')->on('mice');
            $table->unsignedInteger('mother_three')->nullable();
            $table->foreign('mother_three')->references('id')->on('mice');
            $table->date('birth_date');
            $table->date('wean_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('is_alive');
            $table->boolean('sick_report');
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
        Schema::drop('mice');
    }
}
