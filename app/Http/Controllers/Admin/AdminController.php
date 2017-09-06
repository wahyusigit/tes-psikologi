<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Jadwal;
use Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use DB;


class AdminController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }

    public function index(){
    	return view('pages.admin.index');
    }

    public function profile(){
        $admin = Auth::user();
        return view('pages.admin.profile', compact('admin'));
    }

    public function postProfile(Request $req){
        $admin = Auth::user();

        if ($req->hasFile('avatar')) {
            $avatar = $req->file('avatar');
            $filename = $admin->name . '.' . $avatar->getClientOriginalExtension();
            $upload_path = "img/avatar/" . $filename;
            Image::make($avatar)->resize(250,250)->save($upload_path);

            $admin -> avatar = $upload_path ;
            $admin -> nama = $req -> nama ;
            $admin -> alamat = $req -> alamat ;
            $admin -> email = $req -> email ;
            $admin -> no_hp = $req -> no_hp ;
            $admin -> no_telp = $req -> no_telp ;
            $admin -> save();

        } else {
            $admin -> nama = $req -> nama ;
            $admin -> alamat = $req -> alamat ;
            $admin -> email = $req -> email ;
            $admin -> no_hp = $req -> no_hp ;
            $admin -> no_telp = $req -> no_telp ;
            $admin -> save();
        }

        return redirect(route('adminProfile'));
    }

    public function chart(){
        // $month = Carbon::now()->month ;
        // $year = Carbon::now()->year ; 

        // return Jadwal::select('tanggal_jad as name',DB::raw('count(id) as data'))->whereYear('created_at',$year)->whereMonth('created_at',$month)->groupBy('tanggal_jad')->get()->toJson();
        // $month = Carbon::now()->month ;
        // $year = Carbon::now()->year ; 
        // $test = Jadwal::select(DB::raw('DATE_FORMAT(tanggal_jad, "%d") as tanggal'),DB::raw('count(id) as data'))->groupBy('tanggal_jad')->get();
        
        // foreach ($test as $key => $value) {
        //     // $data[] = $value->data;
        //     $data['tanggal'][] = $value->tanggal;
        //     $data['jumlah'][] = $value->data;
        // }
        $test = Jadwal::select(DB::raw('(unix_timestamp(tanggal_jad) * 1000) as tanggal'),DB::raw('count(id) as data'))->groupBy('tanggal_jad')->get();
        foreach ($test as $value) {
            $data[] = array($value->tanggal, $value->data);
        }
        return str_replace('"', '', json_encode($data, true));
    }
}
