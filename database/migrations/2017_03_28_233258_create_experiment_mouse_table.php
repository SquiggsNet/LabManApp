<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExperimentMouseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiment_mouse', function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('experiment_id');
            $table->foreign('experiment_id')->references('id')->on('experiments');
            $table->unsignedInteger('mouse_id');
            $table->foreign('mouse_id')->references('id')->on('mice');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('experiment_mouse');
    }
}
