<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketoffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketoffers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('creator');
            $table->tinyInteger('creatortype'); //is the creator a player or a company
            $table->tinyInteger('offertype'); //is this a buy or a sell offer
            $table->unsignedTinyInteger('item');
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('amount');
            $table->unsignedBigInteger('completed'); // amount completed, I.e 10/100 bought
            $table->unsignedBigInteger('collected'); // amount collected
            $table->unsignedInteger('location'); //location of the market this offer was opened
            $table->unsignedBigInteger('cash');// returned money
            $table->boolean('cancelled');
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
        Schema::dropIfExists('marketoffers');
    }
}
