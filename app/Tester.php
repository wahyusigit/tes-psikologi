<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tester extends Model
{
	protected $fillable = ['nama_tsr', 'no_hp_tsr', 'created_at', 'updated_at'];

    public function detail(){
    	return $this->hasMany(JadwalDetail::class,'id_tester_jad_det','id');
    }

    // public function detail(){
    // 	return $this->hasMany(TesterDetail::class,'id_tester_det','id');
    // }
    public function user(){
    	return $this->hasOne(User::class,'id_tester','id');
    }
}
