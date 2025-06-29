<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('auth.login');
    }
    public function index2()
    {
        //
        notify()->error('silahkan masuk terlebih dahulu untuk membuat laporan','Anda Belum Masuk!');
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $ghazwanReq)
    {
        //


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $ghazwanReq)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $ghazwanReq, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function login(Request $ghazwanReq)
    {
        $ghazwanReq->validate([
            'ghazwanUsername' => 'required',
            'ghazwanPassword' => 'required',
        ]);

        if(Auth::guard('petugas')->attempt(['username' => $ghazwanReq->ghazwanUsername, 'password' => $ghazwanReq->ghazwanPassword])){
            activity()->causedBy(Auth::guard('petugas')->user())->log(Auth::guard('petugas')->user()->nama_petugas . ' dengan hak akses sebagai ' . Auth::guard('petugas')->user()->level . ' telah melakukan login');
            return redirect('/dashboard');
        }elseif(Auth::guard('masyarakat')->attempt(['username' => $ghazwanReq->ghazwanUsername, 'password' => $ghazwanReq->ghazwanPassword])){
            if(Auth::guard('masyarakat')->user()->status == null){
                if(Auth::guard('masyarakat')->check()){
                    Auth::guard('masyarakat')->logout();
                }
                notify()->error('Akun anda belum diverifikasi','Login Gagal');
                return redirect('/');
            }else{
                notify()->success('Anda Berhasil Login!','Sukses!');
                return redirect('/');

            }
        }

            notify()->error('akun tidak sesuai','Login Gagal!');
            return redirect()->back();
    }

    public function logout() {
        if(Auth::guard('petugas')->check()){
            activity()->causedBy(Auth::guard('petugas')->user())->log(Auth::guard('petugas')->user()->nama_petugas . ' dengan hak akses sebagai ' . Auth::guard('petugas')->user()->level . ' telah melakukan logout');
            Auth::guard('petugas')->logout();
            return redirect('/login');
        }elseif(Auth::guard('masyarakat')->check()){
            Auth::guard('masyarakat')->logout();
            return redirect('/');
        }
    }
}
