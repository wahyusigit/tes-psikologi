<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_jad_sek');
            $table->date('tanggal_jad');
            $table->time('waktu_jad');
            $table->integer('total_siswa_jad')->nullable(); // total siswa yg mengikuti tes
            $table->enum('status_jad', ['Belum', 'Sudah'])->default('Belum');
            $table->timestamps();

            $table->foreign('id_jad_sek')->references('id')->on('sekolahs')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwals');
    }
}
