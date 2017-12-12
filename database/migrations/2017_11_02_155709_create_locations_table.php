<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default("LOCATION");
            $table->string('flag')->default("flag.png");
            $table->unsignedInteger('woodprice')->default(10);
            $table->unsignedInteger('stoneprice')->default(10);
            $table->unsignedInteger('oilprice')->default(10);
            $table->unsignedInteger('planksprice')->default(10);
            $table->unsignedInteger('bricksprice')->default(10);
            $table->unsignedInteger('gasolineprice')->default(10);
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
        Schema::dropIfExists('locations');
    }
}
