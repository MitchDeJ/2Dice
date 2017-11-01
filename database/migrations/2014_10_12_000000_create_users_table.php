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
            $table->bigInteger('power')->default(0);
            $table->biginteger('cash')->default(100000);
            $table->integer('companyid')->default(-1);
            $table->integer("title")->default(-1);
            $table->string("unlocked_titles")->default(serialize(array_fill(0, 20, 0)));
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
