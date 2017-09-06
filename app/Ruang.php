<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    public function siswa(){
    	return $this->hasMany(Siswa::class,'id_ruang_sis','id');
    }
}
