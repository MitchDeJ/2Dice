<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name', 20)->unique();
            $table->string('email', 64)->unique();
            $table->string('password');
            $table->string("avatar")->default("default.png");
            $table->string("desc",400)->default("Welcome to my profile! This is a standard description.");

            $table->string("started", 20)->default("START-DATE");
            $table->string("lastlogin", 20)->default("LAST-LOGIN");

            $table->unsignedTinyInteger("location")->default(0);

            $table->unsignedInteger('rank')->default(1);
            $table->unsignedInteger('xp')->default(0);
            $table->boolean('vip')->default(false);
            $table->unsignedInteger('prestige')->default(0);
            $table->unsignedBigInteger('power')->default(0);

            $table->unsignedBigInteger('cash')->default(100000);
            $table->unsignedBigInteger('wood')->default(0);
            $table->unsignedBigInteger('stone')->default(0);
            $table->unsignedBigInteger('wheat')->default(0);

            $table->integer('company')->default(-1);

            $table->tinyInteger("title")->default(-1);
            $table->string("unlockedtitles")->default(serialize(array_fill(0, 20, 0)));

            $table->unsignedBigInteger("highestbet")->default(0);
            $table->unsignedInteger("totalbets")->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
