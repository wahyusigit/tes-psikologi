<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Carbon\Carbon;

use App\Jadwal;

class LaporanController extends Controller
{
    public function index(){
    	$carbon = Carbon::now();
    	$yearmonth = $carbon->year . '-' . $carbon->month;

    	$laporans = Jadwal::where('tanggal_jad','LIKE','%' . $yearmonth . '%')->paginate(30);
    	return view('pages.admin.laporan.index', compact('laporans'));
    }

    public function postIndex(Request $req){
    	$laporans = Jadwal::where('tanggal_jad','LIKE','%' . $req->yearmonth . '%')->paginate(30);
    	return view('pages.admin.laporan.index', compact('laporans'));
    }

    public function print(Request $req){
    	$carbon = Carbon::now();
    	$yearmonth = $carbon->year . '-' . $carbon->month;
    	$laporans = Jadwal::where('tanggal_jad','LIKE','%' . $yearmonth . '%')->get();
    	return view('pages.admin.laporan.table_laporan', compact('laporans'));
    }
}
