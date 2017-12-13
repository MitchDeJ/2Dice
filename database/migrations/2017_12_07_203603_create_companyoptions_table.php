<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyoptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companyoptions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company');
            $table->unsignedTinyInteger('editprofile')->default(2);
            $table->unsignedTinyInteger('makeoffers')->default(2);
            $table->unsignedTinyInteger('viewoffers')->default(0);
            $table->unsignedTinyInteger('handlerequests')->default(1);
            $table->unsignedTinyInteger('setroles')->default(3);
            $table->unsignedTinyInteger('quicksell')->default(2);
            $table->unsignedBigInteger('salary')->default(0);
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
        Schema::dropIfExists('companyoptions');
    }
}
