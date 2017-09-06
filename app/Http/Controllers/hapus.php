<?php

namespace App\Http\Controllers;
use Excel;
use Illuminate\Http\Request;

use App\Jadwal;


class hapus extends Controller
{
    public function index(){
    	$data = Jadwal::get()->toArray();
		return Excel::create('itsolutionstuff_example', function($excel) use ($data) {
			$excel->sheet('mySheet', function($sheet) use ($data)
	        {
				$sheet->fromArray($data);
	        });
		})->download($type);
    }
}
