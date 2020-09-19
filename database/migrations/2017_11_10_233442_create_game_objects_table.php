<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameObjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_objects', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedTinyInteger('type');
            $table->unsignedTinyInteger('location');
            $table->integer('owner');
            $table->unsignedBigInteger('cash');
            $table->unsignedBigInteger('maxbet');
            $table->bigInteger('profit');
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
        Schema::dropIfExists('objects');
    }
}
