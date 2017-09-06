<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Role;
use Auth;

use Intervention\Image\ImageManagerStatic as Image;
use DB;

class TesterController extends Controller
{
    public function index(){
        // $testers = DB::table('users')
        //             ->join('role_user','role_user.user_id','=','users.id')
        //             ->where('role_user.role_id','3')
        //             ->where('users.nama','LIKE', '%' .'andi'. '%')
        //             ->get();
        //             dd($testers);
        $testers = Role::with('users')->where('name','tester')->first()->users;
    	return view('pages.admin.tester.index', compact('testers'));
    }

    public function getAddTester(){
        return view('pages.admin.tester.add');
    }

    public function getUsernameTester($nama){
        
        $nama = substr(str_slug($nama,""), 0, 8);
        $check = User::where('username',$nama)->get();
        if ($check->isEmpty()) {
            return $nama;
        } else {
            $set_nama = count($check) + 1;
            $nama = $nama . $set_nama;
            return $nama;
        }
        
    }

    public function postAddTester(Request $req){
        if ($req->hasFile('avatar')) {
            $tester = new User();

            $avatar = $req->file('avatar');
            $filename = $tester->name . '.' . $avatar->getClientOriginalExtension();
            $upload_path = "img/avatar/" . $filename;
            Image::make($avatar)->resize(250,250)->save($upload_path);

            $tester -> avatar = $upload_path;
            $tester -> username = $this->getUsernameTester($req->nama);
            $tester -> nama = $req-> nama ;
            $tester -> email = $req-> email ;
            $tester -> alamat = $req-> alamat ;
            $tester -> no_hp = $req-> no_hp ;
            $tester -> no_telp = $req-> no_telp ;
            $tester -> password = bcrypt($req->password);
            $tester -> save();
            $attach = User::find($tester->id);
            $attach->attachRole(Role::where('name','tester')->first()->id); 

        } else {
            $tester = new User();
            $tester -> username = $this->getUsernameTester($req->nama);
            $tester -> nama = $req-> nama ;
            $tester -> email = $req-> email ;
            $tester -> alamat = $req-> alamat ;
            $tester -> no_hp = $req-> no_hp ;
            $tester -> no_telp = $req-> no_telp ;
            $tester -> password = bcrypt($req->password);
            $tester -> save();
            $attach = User::find($tester->id);
            $attach->attachRole(Role::where('name','tester')->first()->id); 
        }

        return redirect(route('adminTesterIndex'));
    }

    public function postAjaxSearchTester(Request $req){
    	if ($req->ajax()) {
            // $testers = DB::table('users')->where('nama_tsr','like','%' . $req->search . '%')->paginate(20);
            $testers = DB::table('users')
                    ->join('role_user','role_user.user_id','=','users.id')
                    ->where('role_user.role_id','3')
                    ->where('users.nama','LIKE', '%' . $req->search . '%')
                    ->get();
            return response()->view('pages.admin.tester.partial_table',compact('testers'));    
        }
    }

    public function getShowTester($id){
        $tester = Tester::find($id);
        return view('pages.admin.Tester.show',compact('tester'));
    }

    public function getEditTester($id){
        $tester = User::find($id);
        return view('pages.admin.tester.edit', compact('tester'));
    }

    public function postUpdateTester(Request $req){
        if ($req->hasFile('avatar')) {
            $tester = User::find($req->id);

            $avatar = $req->file('avatar');
            $filename = $tester->name . '.' . $avatar->getClientOriginalExtension();
            $upload_path = "img/avatar/" . $filename;
            Image::make($avatar)->resize(250,250)->save($upload_path);

            $tester -> avatar = $upload_path;
            $tester -> username = $req->username;
            $tester -> nama = $req-> nama ;
            $tester -> email = $req-> email ;
            $tester -> alamat = $req-> alamat ;
            $tester -> no_hp = $req-> no_hp ;
            $tester -> no_telp = $req-> no_telp ;
            $tester -> save();

        } else {
            $tester = User::find($req->id);
            $tester -> username = $req->username;
            $tester -> nama = $req-> nama ;
            $tester -> email = $req-> email ;
            $tester -> alamat = $req-> alamat ;
            $tester -> no_hp = $req-> no_hp ;
            $tester -> no_telp = $req-> no_telp ;
            $tester -> save();
        }

        return redirect(route('adminEditTester', $tester->id));
    }
    public function postAjaxDeleteTester(Request $req){
    	if ($req->ajax()) {
    		if(User::find($req->id_tsr)->delete()){
    			return "success";
    		} else {
    			return "error";
    		}
    	}
    }
}
