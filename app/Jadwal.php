<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    public function detail()
    {
    	return $this->hasMany(JadwalDetail::class,'id_jadwal_jad_det','id');
    }

    public function sekolah()
    {
    	return $this->belongsTo(Sekolah::class,'id_jad_sek','id');
    }
}
