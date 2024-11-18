<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    function index(){
        if(session('level') == 'admin'){

        }else if(session('level') == 'petugas'){

        }else {
            return view('user.dashboard');
        }

        // if(Auth::guard('petugas')->()){

        // }
    }
}
