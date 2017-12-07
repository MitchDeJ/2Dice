<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 15);
            $table->string('avatar', 64)->default('default.png');
            $table->string('desc', 400)->default("Welcome to our profile! This is a standard description.");
            $table->string('owner', 15);
            $table->string('createdat');
            $table->unsignedTinyInteger('location');
            $table->unsignedInteger('level')->default(1);
            $table->unsignedBigInteger('cash')->default(0);
            $table->unsignedBigInteger('wood')->default(0);
            $table->unsignedBigInteger('stone')->default(0);
            $table->unsignedBigInteger('wheat')->default(0);
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
        Schema::dropIfExists('companies');
    }
}
