<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMouseStoragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mouse_storages', function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('mouse_id');
            $table->foreign('mouse_id')->references('id')->on('mice');
            $table->unsignedInteger('box_id');
            $table->foreign('box_id')->references('id')->on('boxes');
            $table->unsignedInteger('tissue_id');
            $table->foreign('tissue_id')->references('id')->on('tissues');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->date('extraction_date');
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
        Schema::drop('mouse_storages');
    }
}