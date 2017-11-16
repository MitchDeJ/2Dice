<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlackjackturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blackjackturns', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user');
            $table->unsignedTinyInteger('location');
            $table->unsignedTinyInteger('usercardtype');
            $table->unsignedTinyInteger('usercard');
            $table->unsignedTinyInteger('cpucardtype');
            $table->unsignedTinyInteger('cpucard');
            $table->unsignedBigInteger('bet');
            $table->boolean('stand');
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
        Schema::dropIfExists('blackjackturns');
    }
}
