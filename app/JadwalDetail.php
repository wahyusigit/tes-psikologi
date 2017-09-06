<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JadwalDetail extends Model
{
    public function ruang(){
    	return $this->belongsTo(Ruang::class,'id_ruang_jad_det','id');
    }

    public function tester(){
    	return $this->belongsTo(User::class,'id_tester_jad_det','id');
    }

    public function jadwal()
    {
    	return $this->belongsTo(Jadwal::class,'id_jadwal_jad_det','id');
    }

    public function jenistes(){
        return $this->hasMany(TesDetail::class,'id','id_jadwal_det_tes');
    }
    // public function jadwalTester()
    // {
    // 	return $this->belongsTo(Jadwal::class,'id_jadwal_jad_det','id')->orderBy('tanggal_jad','asc');
    // }
}
