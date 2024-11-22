<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\ReportDataChart;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    function index(ReportDataChart $chart){
        // if(session('level') == 'admin'){

        // }else if(session('level') == 'petugas'){

        // }else {
        //     return view('user.dashboard');
        // }

        $data = $chart->build();

        if(Auth::guard('petugas')->user()->level == 'admin'){
            return view('admin.dashboard', compact('data'));
        }elseif(Auth::guard('petugas')->user()->level == 'petugas'){
            return view('admin.dashboard', compact('data'));
        }
        // return view('user.dashboard');
    }
}
