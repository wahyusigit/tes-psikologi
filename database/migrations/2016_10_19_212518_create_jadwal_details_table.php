<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJadwalDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_jadwal_jad_det');
            $table->unsignedInteger('id_tester_jad_det');
            $table->unsignedInteger('id_ruang_jad_det');
            $table->time('waktu_mulai_tes')->nullable();
            $table->time('waktu_selesai_tes')->nullable();
            $table->integer('jumlah_siswa_jad_det')->nullable(); // jumlah siswa yang mengikuti tes
            $table->enum('status_jad_det', ['Belum Dimulai','Sedang Berlangsung', 'Sudah Selesai'])->default('Belum Dimulai');
            $table->timestamps();

            $table->foreign('id_jadwal_jad_det')->references('id')->on('jadwals')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_tester_jad_det')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_ruang_jad_det')->references('id')->on('ruangs')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwal_details');
    }
}
