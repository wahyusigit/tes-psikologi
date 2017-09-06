<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Sekolah;

use DB;

class SekolahController extends Controller
{
    public function index(){
    	$sekolahs = Sekolah::orderBy('id','desc')->paginate(20);
    	return view('pages.admin.sekolah.index', compact('sekolahs'));
    }

    public function getAjaxSearchSekolah(Request $req){
    	if ($req->ajax()) {
            $sekolahs = DB::table('sekolahs')->where('nama_sek','like','%' . $req->search . '%')->paginate(20);
            return response()->view('pages.partials.table',compact('sekolahs'));    
        }
    }

    public function postAddSekolah(Request $req){
    	$sekolah = new Sekolah();
		$sekolah -> nama_sek = $req->nama_sek;
		$sekolah -> alamat_sek = $req->alamat_sek;
		$sekolah -> no_telp_sek = $req->no_telp_sek;
		$sekolah->save();

		return redirect()->back();
    }

    public function getShowSekolah($id){
        $sekolah = Sekolah::find($id);
        return view('pages.admin.sekolah.show',compact('sekolah'));
    }
    public function postAjaxDeleteSekolah(Request $req){
    	if ($req->ajax()) {
    		if(Sekolah::find($req->id_sek)->delete()){
    			return "success";
    		} else {
    			return "error";
    		}
    	}
    }

    public function postAjaxUpdateSekolah(Request $req){
    	if ($req->ajax()) {
    		$sekolah = Sekolah::find($req->id_sek);
    		$sekolah -> nama_sek = $req->nama_sek;
    		$sekolah -> alamat_sek = $req->alamat_sek;
    		$sekolah -> no_telp_sek = $req->no_telp_sek;

    		if($sekolah->save()){
    			return response()->json($sekolah);
    		} else {
    			return "error";
    		}

    	}
    }
}
