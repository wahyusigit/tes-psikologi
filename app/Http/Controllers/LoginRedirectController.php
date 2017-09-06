<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginRedirectController extends Controller
{
    public function check(){
        if (Auth::user()->hasRole('root')) {
            return redirect(route('rootIndex'));
        } elseif (Auth::user()->hasRole('admin')) {
            return redirect(route('adminIndex'));
        } elseif (Auth::user()->hasRole('tester')) {
            return redirect(route('testerIndex'));
        } else {
            return redirect('/logout');
        }
    }
}
