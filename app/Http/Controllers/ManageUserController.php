<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\Masyarakat;
use Illuminate\Http\Request;

class ManageUserController extends Controller
{
    //
    public function index(){


        return view('admin.manage-user');
    }

    public function showUsers(){
        $ghazwanUsers = Masyarakat::all();

        return view('admin.manage-user', compact('ghazwanUsers'));
    }

    public function showOfficers(){
        $ghazwanOfficers = Petugas::all();

        return view('admin.manage-officer', compact('ghazwanOfficers'));
    }

    public function editUser($id){
        $ghazwanUser = Masyarakat::find($id);

        return view('admin.edit-user', compact('ghazwanUser'));
    }

    public function editOfficer($id){
        $ghazwanOfficer = Petugas::where('id_petugas',$id)->first();

        return view('admin.edit-officer', compact('ghazwanOfficer'));
    }
}
