<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    public function submitComplaint(Request $ghazwanReq)
    {
        $ghazwanReq->validate([
            'ghazwanComplaint' => 'required',
            'ghazwanImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ], [
            'ghazwanComplaint.required' => 'Masukkan Laporan Anda!',
            'ghazwanImage.required' => 'Sertakan Bukti Laporan Anda!',
            'ghazwanImage.image' => 'Anda hanya bisa mengunggah foto!',
            'ghazwanImage.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif!',
            'ghazwanImage.max' => 'Ukuran gambar tidak boleh lebih dari 5MB!',
        ]);

        $ghazwanComplaint = new Pengaduan();
        $ghazwanComplaint->tgl_pengaduan = Carbon::now();
        $ghazwanComplaint->nik = Auth::guard('masyarakat')->user()->nik;
        $ghazwanComplaint->isi_laporan = $ghazwanReq->ghazwanComplaint;
        if ($ghazwanReq->file('ghazwanImage')) {
            $ghazwanFile = $ghazwanReq->file('ghazwanImage');
            $ghazwanExtension = $ghazwanFile->getClientOriginalExtension();
            $ghazwanFilenameToStore = Auth::guard('masyarakat')->user()->id . '_' . time() . '.' . $ghazwanExtension;
            $ghazwanPath = $ghazwanFile->storeAs('bukti_laporan', $ghazwanFilenameToStore, 'public');
            $ghazwanComplaint->foto = $ghazwanPath;
        }
        $ghazwanComplaint->save();

        notify()->success('Laporan Berhasil Dikirim', 'Berhasil!');
        return redirect()->back();
    }

    public function showComplaint(){
        $ghazwanDataComplaint = Pengaduan::all();

        return view('admin.complaint', compact('ghazwanDataComplaint'));
    }

    public function showComplaintDone(){
        $ghazwanDataComplaint = Pengaduan::join('tanggapan','pengaduan.id_pengaduan','=','tanggapan.id_pengaduan')->select('pengaduan.*','tanggapan.tanggapan as tanggapan')->get();

        return view('admin.complaint-done', compact('ghazwanDataComplaint'));
    }

    public function processComplaint(Request $ghazwanReq){
        $ghazwanDataComplaint = new Tanggapan();

        $ghazwanDataComplaint->id_pengaduan = $ghazwanReq->ghazwanId;
        $ghazwanDataComplaint->tanggapan = $ghazwanReq->ghazwanTanggapan;
        $ghazwanDataComplaint->tgl_tanggapan = Carbon::now();
        $ghazwanDataComplaint->id_petugas = Auth::guard('petugas')->user()->id_petugas;

        $ghazwanDataComplaint->save();

        $ghazwanDataComplaint2 = Pengaduan::where('id_pengaduan', $ghazwanReq->ghazwanId);
        $ghazwanDataComplaint2->update(['status' => $ghazwanReq->ghazwanStatus]);

        return redirect()->back();
    }
}
