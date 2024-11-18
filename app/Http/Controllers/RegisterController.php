<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('auth.register');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $request->validate([
            'ghazwanNik' => ['required', Rule::unique('masyarakat', 'nik')],
            'ghazwanName' => 'required',
            'ghazwanUsername' => [
                'required',
                Rule::unique('masyarakat', 'username'),
                Rule::unique('petugas', 'username')
            ],
            'ghazwanPassword' => 'required',
            'ghazwanPhone' => 'required',
        ], [
            'ghazwanNik.unique' => 'NIK tersebut telah terdaftar',
            'ghazwanUsername.unique' => 'Username tersebut telah terdaftar',
        ]);



        $ghazwanMasyarakat = new Masyarakat();
        $ghazwanMasyarakat->nik = $request->ghazwanNik;
        $ghazwanMasyarakat->nama = $request->ghazwanName;
        $ghazwanMasyarakat->username = $request->ghazwanUsername;
        $ghazwanMasyarakat->password = Hash::make($request->ghazwanPassword);
        $ghazwanMasyarakat->telp = $request->ghazwanPhone;
        $ghazwanMasyarakat->save();

        notify()->success('silahkan masuk ke akun anda', 'Akun Berhasil Dibuat!');
        return redirect()->route('ghazwanView.login');
    }
    public function makeUserAccount(Request $request)
    {
        //
        $request->validate([
            'ghazwanNik' => ['required', Rule::unique('masyarakat', 'nik')],
            'ghazwanName' => 'required',
            'ghazwanUsername' => [
                'required',
                Rule::unique('masyarakat', 'username'),
                Rule::unique('petugas', 'username')
            ],
            'ghazwanPassword' => 'required',
            'ghazwanPhone' => 'required',
        ], [
            'ghazwanNik.unique' => 'NIK tersebut telah terdaftar',
            'ghazwanUsername.unique' => 'Username tersebut telah terdaftar',
        ]);



        $ghazwanMasyarakat = new Masyarakat();
        $ghazwanMasyarakat->nik = $request->ghazwanNik;
        $ghazwanMasyarakat->nama = $request->ghazwanName;
        $ghazwanMasyarakat->username = $request->ghazwanUsername;
        $ghazwanMasyarakat->password = Hash::make($request->ghazwanPassword);
        $ghazwanMasyarakat->telp = $request->ghazwanPhone;
        $ghazwanMasyarakat->save();

        notify()->success('Akun Berhasil Dibuat!');
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function makeOfficerAccount(Request $request)
    {
        //
        $request->validate([
            'ghazwanName' => 'required',
            'ghazwanUsername' => [
                'required',
                Rule::unique('masyarakat', 'username'),
                Rule::unique('petugas', 'username')
            ],
            'ghazwanPassword' => 'required',
            'ghazwanPhone' => 'required',
            'ghazwanLevel' => 'required',
        ], [
            'ghazwanUsername.unique' => 'Username tersebut telah terdaftar',
        ]);



        $ghazwanPetugas = new Petugas();
        $ghazwanPetugas->nama_petugas = $request->ghazwanName;
        $ghazwanPetugas->username = $request->ghazwanUsername;
        $ghazwanPetugas->password = Hash::make($request->ghazwanPassword);
        $ghazwanPetugas->telp = $request->ghazwanPhone;
        $ghazwanPetugas->level = $request->ghazwanLevel;
        $ghazwanPetugas->save();


        notify()->success('Akun Berhasil Dibuat!');
        return redirect(route('ghazwanView.admin.manage.officer'));
    }

    public function editUserAccount(Request $request, $id) {
        $request->validate([
            'ghazwanNik' => ['required', Rule::unique('masyarakat', 'nik')->ignore($id, 'id')],
            'ghazwanName' => 'required',
            'ghazwanUsername' => [
                'required',
                Rule::unique('masyarakat', 'username')->ignore($id, 'id'),
                Rule::unique('petugas', 'username')
            ],
            'ghazwanPassword' => 'nullable',
            'ghazwanPhone' => 'required',
        ], [
            'ghazwanNik.unique' => 'NIK tersebut telah terdaftar',
            'ghazwanUsername.unique' => 'Username tersebut telah terdaftar',
        ]);

        $ghazwanUser = Masyarakat::find($id);

        $ghazwanPassword = $ghazwanUser->password;
        if ($request->filled('ghazwanPassword')) {
            $ghazwanPassword = Hash::make($request->ghazwanPassword);
        }

        $ghazwanUser->update([
            'nik' => $request->ghazwanNik,
            'nama' => $request->ghazwanName,
            'username' => $request->ghazwanUsername,
            'password' => $ghazwanPassword,
            'telp' => $request->ghazwanPhone
        ]);

        notify()->success('Akun Berhasil Diperbarui!');
        return redirect()->route('ghazwanView.admin.manage.user');
    }


    public function editOfficerAccount(Request $request, $id) {
        $request->validate([
            'ghazwanName' => 'required',
            'ghazwanUsername' => [
                'required',
                Rule::unique('petugas', 'username')->ignore($id, 'id_petugas'),
            ],
            'ghazwanPassword' => 'nullable',
            'ghazwanPhone' => 'required',
            'ghazwanLevel' => 'required',
        ], [
            'ghazwanUsername.unique' => 'Username tersebut telah digunakan',
        ]);

        $officer = Petugas::where('id_petugas', $id)->first();

        $ghazwanPassword = $officer->password;
        if ($request->filled('ghazwanPassword')) {
            $ghazwanPassword = Hash::make($request->ghazwanPassword);
        }

        $officer->update([
            'nama_petugas' => $request->ghazwanName,
            'username' => $request->ghazwanUsername,
            'password' => $ghazwanPassword,
            'telp' => $request->ghazwanPhone,
            'level' => $request->ghazwanLevel
        ]);

        notify()->success('Akun Berhasil Diperbarui!');
        return redirect()->route('ghazwanView.admin.manage.officer');
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

    public function makeUserAccountView() {
        return view('admin.add-user');
    }

    public function makeOfficerAccountView() {
        return view('admin.add-officer');
    }
}
