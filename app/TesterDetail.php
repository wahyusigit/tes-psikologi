<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TesterDetail extends Model
{
    public function tester(){
    	return $this->belongsTo(Tester::class,'id_tester_det','id');
    }

    public function jadwal(){
    	return $this->belongsTo(Jadwal::class,'id_jadwal_tester_det','id');
    }

    public function jadwalToday(){
    	return $this->belongsTo(Jadwal::class,'id_jadwal_tester_det','id')->where('tanggal_jad',Carbon::now()->toDateString());
    }

    public function sekolah(){
    	return $this->belongsTo(Sekolah::class,'id_sekolah_tester_det','id');
    }
    
    public function ruang(){
    	return $this->belongsTo(Ruang::class,'id_ruang_tester_det','id');
    }

    public function tes(){
    	return $this->belongsTo(Tes::class,'id_tes_tester_det','id');
    }
}
