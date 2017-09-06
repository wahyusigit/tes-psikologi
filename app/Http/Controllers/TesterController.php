<?php

namespace App\Http\Controllers;


// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use DB;
use Carbon\Carbon;

use App\User;
use App\JadwalDetail;
use App\Jadwal;
// use App\Tes;
use App\TesDetail;

class TesterController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    	// $this->middleware('role:tester');
    }

    public function getIdtester(){
    	return Auth::user()->id;
    }

    public function index(){
    	$carbon = Carbon::now();
    	$details = JadwalDetail::where('id_tester_jad_det','=', $this->getIdtester())->paginate(20);
    	return view('pages.tester.index',compact('details','carbon'));
    }

    public function form(){
        $carbon = Carbon::now()->toDateString();
        $tester = Auth::user();
        //$jadwal = JadwalDetail::where('id_tester_jad_det', $tester->id)->whereDate('created_at',$carbon)->get();
        $jadwals = DB::table('jadwals')
                                ->join('jadwal_details','jadwal_details.id_jadwal_jad_det','=','jadwals.id')
                                ->join('sekolahs','sekolahs.id','jadwals.id_jad_sek')
                                ->join('ruangs','ruangs.id','jadwal_details.id_ruang_jad_det')
                                // ->join('tes_details','tes_details.id_jadwal_det_tes','=','jadwal_details.id')
                                ->whereDate('jadwals.tanggal_jad',$carbon)
                                ->where('jadwal_details.id_tester_jad_det', $tester->id)
                                ->get();
                                // dd($jadwals);
        foreach ($jadwals as $i => $jadwal) {
            if (is_null($jadwals)) {
                $tesdetails[$i] = "";
            } else {
                $tesdetails[$i] = TesDetail::where('id_jadwal_det_tes','=',$jadwal->id)->get();    
            }    
        }
        
        // dd($jadwals);                                
        return view('pages.tester.forms', compact('tester','jadwals','tesdetails'));
    }

    public function postForm(Request $req, $id){
        $jadwaldetail = JadwalDetail::find($id);
        if (empty($req -> waktu_mulai_tes)) {
            $jadwaldetail -> waktu_mulai_tes = Carbon::now()->toTimeString();
        } else {
            $jadwaldetail -> waktu_mulai_tes = $req -> waktu_mulai_tes;
        }
        $jadwaldetail -> jumlah_siswa_jad_det = $req -> jumlah_siswa_jad_det;
        // $jadwaldetail -> waktu_selesai_tes = Carbon::now()->toTimeString();
        $jadwaldetail -> save();

        TesDetail::where('id_jadwal_det_tes','=',$jadwaldetail -> id)->delete();

        foreach ($req->data as $val) {
            if (!empty($val['jenis_tes'])) {
                $tesdetail = new TesDetail();
                $tesdetail -> id_jadwal_det_tes = $jadwaldetail->id;
                $tesdetail -> jenis_tes = $val['jenis_tes'];
                $tesdetail -> jumlah_buku_tes = $val['jumlah_buku_tes'];
                $tesdetail -> waktu_mulai_tes_det = $val['waktu_mulai_tes_det'];
                $tesdetail -> waktu_selesai_tes_det = $val['waktu_selesai_tes_det'];
                $tesdetail -> save();
            }
        }

        return redirect()->back();
    }

    public function statusTes($id,$status){

        if ($status == "1") {
            $jadwaldetail = JadwalDetail::find($id);
            $jadwaldetail -> status_jad_det = "Sedang Berlangsung";
            $jadwaldetail -> waktu_mulai_tes = Carbon::now()->toTimeString();
            $jadwaldetail -> save();
        } elseif ($status == "2") {
            $jadwaldetail = JadwalDetail::find($id);
            $jadwaldetail -> status_jad_det = "Sudah Selesai";
            $jadwaldetail -> waktu_selesai_tes = Carbon::now()->toTimeString();
            $jadwaldetail -> save();
        }
        return redirect(route('testerForm'));
    }

    public function profile(){
        $tester = Auth::user();
        return view('pages.tester.profile', compact('tester'));
    }

    public function postProfile(Request $req){
        $tester = Auth::user();
        if ($req->hasFile('avatar')) {
            $avatar = $req->file('avatar');
            $filename = $tester->name . '.' . $avatar->getClientOriginalExtension();
            $upload_path = "img/avatar/" . $filename;
            Image::make($avatar)->resize(250,250)->save($upload_path);

            $tester -> avatar = $upload_path ;
            $tester -> nama = $req -> nama ;
            $tester -> alamat = $req -> alamat ;
            $tester -> email = $req -> email ;
            $tester -> no_hp = $req -> no_hp ;
            $tester -> no_telp = $req -> no_telp ;
            $tester -> save();

        } else {
            $tester -> nama = $req -> nama ;
            $tester -> alamat = $req -> alamat ;
            $tester -> email = $req -> email ;
            $tester -> no_hp = $req -> no_hp ;
            $tester -> no_telp = $req -> no_telp ;
            $tester -> save();
        }

        return redirect(route('testerProfile'));
    }


}
