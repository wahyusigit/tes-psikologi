<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    public function jadwal(){
    	return $this->hasMany(Jadwal::class,'id_jad_sek','id');
    }
}
