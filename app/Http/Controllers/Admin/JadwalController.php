<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Jadwal;
use App\JadwalDetail;
use App\Sekolah;
use App\Role;
use App\Ruang;

use Carbon\Carbon;
use Validator;

class JadwalController extends Controller
{
	public function __construct(){
		$this->carbon = Carbon::now();
	}
    public function index(){
    	$jadwals = Jadwal::whereMonth('tanggal_jad', $this->carbon->month)->orderBy('tanggal_jad','asc')->paginate(100);
    	$sekolahs = Sekolah::all();
    	$testers = Role::with('users')->where('name','tester')->first()->users;

    	return view('pages.admin.jadwal.index',compact('jadwals','sekolahs','testers'));
    }

    public function postIndex(Request $req){
        $jadwals = Jadwal::where('tanggal_jad', 'LIKE', '%' . $req->bulantahun . '%')->orderBy('tanggal_jad','asc')->paginate(100);
        $sekolahs = Sekolah::all();
        $testers = Role::with('users')->where('name','tester')->first()->users;

        return view('pages.admin.jadwal.index',compact('jadwals','sekolahs','testers'));
    }
    
    public function postAddJadwal(Request $req){
        $jadwal = new Jadwal();

        $jadwal -> id_jad_sek = $req -> id_sek;
        $jadwal -> tanggal_jad = $req -> tanggal_jad;
        $jadwal -> waktu_jad = $req -> waktu_jad;
        $jadwal -> total_siswa_jad = $req -> total_siswa_jad;
        $jadwal -> save();

        foreach ($req->ruang as $value) {            
            $ruang =  new Ruang();    
            $ruang -> nama_rng = $value['nama_rng'];
            $ruang -> jumlah_siswa_rng = $value['jumlah_siswa_rng'];
            $ruang -> save();
            $id_ruang[] = $ruang->id;
        }
        
        // Untuk Testser
        foreach ($req->id_tsr as $numb => $value) {
            $jadwalDetail = new JadwalDetail();    
            $jadwalDetail -> id_jadwal_jad_det = $jadwal -> id ;
            $jadwalDetail -> id_tester_jad_det = $value ;
            $jadwalDetail -> id_ruang_jad_det = $id_ruang[$numb] ;
            $jadwalDetail -> save();
        }
        flash('Jadwal untuk Sekolah ' .  $jadwal->sekolah->nama_sek . ' berhasil ditambahkan', 'success');
        return redirect(route('adminJadwalIndex'));
    }

    public function getEditJadwal($id){
        $jadwal = Jadwal::find($id);
        $testers = Role::with('users')->where('name','tester')->first()->users;
        return view('pages.admin.jadwal.edit',compact('jadwal','testers'));
    }

    public function postUpdateJadwal(Request $req, $id){
        $jadwal = Jadwal::find($id);
        $jadwal -> tanggal_jad = $req -> tanggal_jad;
        $jadwal -> waktu_jad = $req -> waktu_jad;
        $jadwal -> save();

        if (isset($req->nama_rng_new)) {
            foreach ($req->nama_rng_new as $value) {
                $ruang =  new Ruang();    
                $ruang -> nama_rng = $value;
                $ruang -> save();

                $id_ruang[] = $ruang->id;
            }
            foreach ($req->id_tsr_new as $no => $value) {
                $jadwalDetail =  new JadwalDetail();    
                $jadwalDetail -> id_jadwal_jad_det = $jadwal -> id;
                $jadwalDetail -> id_tester_jad_det = $value;
                $jadwalDetail -> id_ruang_jad_det = $id_ruang[$no];
                $jadwalDetail -> save();
            }
        }
        flash('Jadwal Berhasil Disimpan', 'success');
        return redirect(route('adminEditJadwal', $id ));
    }

    public function postDeleteJadwal(Request $req){
    	if ($req->ajax()) {
            if(Jadwal::find($req->id_jad)->delete()){
                return "success";
            } else {
                return "error";
            }
        }
    }

    public function postAjaxDeleteJadwalDetail(Request $req){
        if ($req->ajax()) {
            if(JadwalDetail::find($req->id_jad_det)->delete()){
                return "success";
            } else {
                return "error";
            }
        }
    }
}
