<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
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
    public function create(Request $ghazwanReq)
    {
        //
        $ghazwanReq->validate([
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
        $ghazwanMasyarakat->nik = $ghazwanReq->ghazwanNik;
        $ghazwanMasyarakat->nama = $ghazwanReq->ghazwanName;
        $ghazwanMasyarakat->username = $ghazwanReq->ghazwanUsername;
        $ghazwanMasyarakat->password = Hash::make($ghazwanReq->ghazwanPassword);
        $ghazwanMasyarakat->telp = $ghazwanReq->ghazwanPhone;
        $ghazwanMasyarakat->save();

        notify()->success('Tunggu verifikasi dari petugas untuk lanjut masuk ke akun anda', 'Akun Berhasil Dibuat!');
        return redirect()->route('ghazwanView.login');
    }
    public function makeUserAccount(Request $ghazwanReq)
    {
        //
        $ghazwanReq->validate([
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
        $ghazwanMasyarakat->nik = $ghazwanReq->ghazwanNik;
        $ghazwanMasyarakat->nama = $ghazwanReq->ghazwanName;
        $ghazwanMasyarakat->username = $ghazwanReq->ghazwanUsername;
        $ghazwanMasyarakat->password = Hash::make($ghazwanReq->ghazwanPassword);
        $ghazwanMasyarakat->telp = $ghazwanReq->ghazwanPhone;
        $ghazwanMasyarakat->save();

        activity()->causedBy(Auth::guard('petugas')->user())->log(Auth::guard('petugas')->user()->nama_petugas . ' dengan hak akses sebagai ' . Auth::guard('petugas')->user()->level . ' telah membuat akun masyarakat');
        notify()->success('Akun Berhasil Dibuat!');
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function makeOfficerAccount(Request $ghazwanReq)
    {
        //
        $ghazwanReq->validate([
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
        $ghazwanPetugas->nama_petugas = $ghazwanReq->ghazwanName;
        $ghazwanPetugas->username = $ghazwanReq->ghazwanUsername;
        $ghazwanPetugas->password = Hash::make($ghazwanReq->ghazwanPassword);
        $ghazwanPetugas->telp = $ghazwanReq->ghazwanPhone;
        $ghazwanPetugas->level = $ghazwanReq->ghazwanLevel;
        $ghazwanPetugas->save();

        activity()->causedBy(Auth::guard('petugas')->user())->log(Auth::guard('petugas')->user()->nama_petugas . ' dengan hak akses sebagai ' . Auth::guard('petugas')->user()->level . ' telah melakukan membuat akun petugas');
        notify()->success('Akun Berhasil Dibuat!');
        return redirect(route('ghazwanView.admin.manage.officer'));
    }

    public function editUserAccount(Request $ghazwanReq, $id) {
        $ghazwanReq->validate([
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
        if ($ghazwanReq->filled('ghazwanPassword')) {
            $ghazwanPassword = Hash::make($ghazwanReq->ghazwanPassword);
        }

        $ghazwanUser->update([
            'nik' => $ghazwanReq->ghazwanNik,
            'nama' => $ghazwanReq->ghazwanName,
            'username' => $ghazwanReq->ghazwanUsername,
            'password' => $ghazwanPassword,
            'telp' => $ghazwanReq->ghazwanPhone
        ]);

        activity()->causedBy(Auth::guard('petugas')->user())->log(Auth::guard('petugas')->user()->nama_petugas . ' dengan hak akses sebagai ' . Auth::guard('petugas')->user()->level . ' telah mengubah akun masyarakat');
        notify()->success('Akun Berhasil Diperbarui!');
        return redirect()->route('ghazwanView.admin.manage.user');
    }


    public function editOfficerAccount(Request $ghazwanReq, $id) {
        $ghazwanReq->validate([
            'ghazwanName' => 'required',
            'ghazwanUsername' => [
                'required',
                Rule::unique('petugas', 'username')->ignore($id, 'id_petugas'),
            ],
            'ghazwanPassword' => 'nullable',
            'ghazwanPhone' => 'required|digits_between:13,14',
            'ghazwanLevel' => 'required',
        ], [
            'ghazwanUsername.unique' => 'Username tersebut telah digunakan',
            'ghazwanPhone.digits_between' => 'No telepon tidak valid',
        ]);

        $officer = Petugas::where('id_petugas', $id)->first();

        $ghazwanPassword = $officer->password;
        if ($ghazwanReq->filled('ghazwanPassword')) {
            $ghazwanPassword = Hash::make($ghazwanReq->ghazwanPassword);
        }

        $officer->update([
            'nama_petugas' => $ghazwanReq->ghazwanName,
            'username' => $ghazwanReq->ghazwanUsername,
            'password' => $ghazwanPassword,
            'telp' => $ghazwanReq->ghazwanPhone,
            'level' => $ghazwanReq->ghazwanLevel
        ]);

        activity()->causedBy(Auth::guard('petugas')->user())->log(Auth::guard('petugas')->user()->nama_petugas . ' dengan hak akses sebagai ' . Auth::guard('petugas')->user()->level . ' telah mengubah akun petugas');
        notify()->success('Akun Berhasil Diperbarui!');
        return redirect()->route('ghazwanView.admin.manage.officer');
    }

    public function viewUserAccount()
    {
        $ghazwanVerify = Masyarakat::Where('status',null)->get();
        // if($ghazwanVerify ){
        //     $yaya = $ghazwanVerify;
        // }
        // dd($yaya);
        return view('admin.verify', compact('ghazwanVerify'));
    }

    public function verifyUserAccount($ghazwanNik)
    {
        $ghazwanVerify = Masyarakat::find($ghazwanNik)->where('status',null)->first();
        $ghazwanVerify->status = 'verified';
        $ghazwanVerify->save();
        return redirect()->back();
    }

    public function rejectUserAccount($ghazwanNik)
    {
        $ghazwanVerify = Masyarakat::find($ghazwanNik)->where('status',null)->first();
        $ghazwanVerify->delete();
        return redirect()->back();
    }

    public function makeUserAccountView() {
        return view('admin.add-user');
    }

    public function makeOfficerAccountView() {
        return view('admin.add-officer');
    }
}
