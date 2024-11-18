<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\Masyarakat;
use Illuminate\Http\Request;
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
    public function create(Request $request)
    {
        //


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
    public function update(Request $request, string $id)
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

    public function login(Request $request)
    {
        $request->validate([
            'ghazwanUsername' => 'required',
            'ghazwanPassword' => 'required',
        ]);

        $ghazwanUsername = $request->ghazwanUsername;
        $ghazwanPassword = $request->ghazwanPassword;

        $ghazwanUser1 = Masyarakat::where('username', $ghazwanUsername)->first();
        $ghazwanUser2 = Petugas::where('username', $ghazwanUsername)->first();

        if($ghazwanUser1){
            if(Hash::check($ghazwanPassword, $ghazwanUser1->password)){
                // session(['ghazwanUser' => $ghazwanUser1]);
                return redirect('/dashboard');
            }else{
                notify()->error('Login Gagal');

                return redirect('/login');
            }
        }else{
            if($ghazwanUser2->level == 'admin'){
                if(Hash::check($ghazwanPassword, $ghazwanUser2->password)){
                    // session(['ghazwanUser' => $ghazwanUser1]);
                    return redirect('/dashboard');
                }else{
                    notify()->error('Login Gagal');

                    return redirect('/login');
                }
            }else if($ghazwanUser2->level == 'petugas'){
                if(Hash::check($ghazwanPassword, $ghazwanUser2->password)){
                    // session(['ghazwanUser' => $ghazwanUser1]);
                    return redirect('/petugas/dashboard');
                }else{

                    notify()->error('Login Gagal');

                    return redirect('/login');
                }
            }

        }


    }
}
