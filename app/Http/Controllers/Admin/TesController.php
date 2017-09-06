<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Jadwal;
use App\JadwalDetail;

use Carbon\Carbon;

class TesController extends Controller
{
    public function index(){
    	$jadwals = Jadwal::where('tanggal_jad','=',Carbon::now()->toDateString())->get();
    	return view('pages.admin.tes.index', compact('jadwals'));
    }

    public function edit($id){
    	$jadwal = JadwalDetail::where('id_jadwal_jad_det',$id)->get();
    	return view('pages.admin.tes.edit', compact('jadwal'));
    }

    public function update(Request $req, $id){

    }
}
