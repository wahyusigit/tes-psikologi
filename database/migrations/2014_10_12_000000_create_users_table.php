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
            $table->string('username');
            $table->string('nama',32);
            $table->string('email')->unique();
            $table->char('alamat',200)->nullable();
            $table->char('no_hp',14)->nullable();
            $table->char('no_telp',16)->nullable();
            $table->string('password');
            $table->string('avatar')->default('img/avatar.png');
            // $table->string('avatar_small')->default('img/avatar.png');
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
