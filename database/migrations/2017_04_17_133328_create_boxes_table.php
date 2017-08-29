<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boxes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('column')->nullable();
            $table->unsignedInteger('row')->nullable();
            $table->unsignedInteger('box')->nullable();
            $table->unsignedInteger('capacity')->nullable();
            $table->unsignedInteger('shelf_id');
            $table->foreign('shelf_id')->references('id')->on('shelves');
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
        Schema::drop('boxes');
    }
}
