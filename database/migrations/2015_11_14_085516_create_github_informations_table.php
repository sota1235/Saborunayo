<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGithubInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('github_informations', function (BluePrint $table) {
            $table->increments('github_id')->increments();
            $table->integer('user_id')->unique();
            $table->string('token')->unique();
            $table->integer('id')->unique();
            $table->string('nickname');
            $table->string('name');
            $table->string('email');
            $table->string('avatar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('github_informations');
    }
}
