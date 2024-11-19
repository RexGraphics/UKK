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
            return redirect('/dashboard');
        }elseif(Auth::guard('masyarakat')->attempt(['username' => $ghazwanReq->ghazwanUsername, 'password' => $ghazwanReq->ghazwanPassword])){
            return redirect('/');
        }

            notify()->error('akun belum terdaftar','Login Gagal!');
            return redirect()->back();



    }

    public function logout() {
        if(Auth::guard('petugas')->check()){
            Auth::guard('petugas')->logout();
            return redirect('/login');
        }elseif(Auth::guard('masyarakat')->check()){
            Auth::guard('masyarakat')->logout();
            return redirect('/');
        }
    }
}
