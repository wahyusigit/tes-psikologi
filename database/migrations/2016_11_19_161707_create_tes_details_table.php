<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tes_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_jadwal_det_tes');
            $table->string('jenis_tes');
            $table->tinyInteger('jumlah_buku_tes')->default(0);
            $table->time('waktu_mulai_tes_det')->nullable();
            $table->time('waktu_selesai_tes_det')->nullable();
            $table->timestamps();

            $table->foreign('id_jadwal_det_tes')->references('id')->on('jadwal_details')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tes_details');
    }
}
