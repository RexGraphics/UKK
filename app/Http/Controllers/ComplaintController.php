<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Petugas;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            $ghazwanFilenameToStore = Auth::guard('masyarakat')->user()->id . '_' . date('His') . '.' . $ghazwanExtension;
            $ghazwanPath = $ghazwanFile->storeAs('bukti_laporan', $ghazwanFilenameToStore, 'public');
            $ghazwanComplaint->foto = $ghazwanPath;
        }
        $ghazwanComplaint->save();

        notify()->success('Laporan Berhasil Dikirim', 'Berhasil!');
        return redirect()->back();
    }

    public function showComplaint(Request $request)
    {
        $perPage = $request->get('per_page', 10);

        $perPage = is_numeric($perPage) && $perPage > 0 ? (int)$perPage : 10;

        // Urutkan data berdasarkan created_at secara descending
        $ghazwanDataComplaint = Pengaduan::paginate($perPage);
        // $ghazwanActivity = Activity::orderBy('created_at', 'desc');

        // return view('admin.activity', compact('ghazwanActivity', 'perPage'));

        return view('admin.complaint', compact('ghazwanDataComplaint', 'perPage'));
    }

    public function showComplaintDone(Request $request)
    {
        $perPage = $request->get('per_page', 10);

        $perPage = is_numeric($perPage) && $perPage > 0 ? (int)$perPage : 10;

        $ghazwanDataComplaint = Pengaduan::join('tanggapan', 'pengaduan.id_pengaduan', '=', 'tanggapan.id_pengaduan')
            ->join('petugas', 'tanggapan.id_petugas', '=', 'petugas.id_petugas')
            ->distinct('pengaduan.id_pengaduan')
            ->select('pengaduan.*', 'tanggapan.tanggapan as tanggapan', 'petugas.nama_petugas as nama_petugas')
            ->paginate($perPage);

        return view('admin.complaint-done', compact('ghazwanDataComplaint', 'perPage'));
    }

    public function processComplaint(Request $ghazwanReq)
    {


        if ($ghazwanReq->ghazwanTanggapan == '') {
            notify()->error('Tanggapan Tidak Boleh Kosong!', 'Gagal');
            return redirect()->back();
        }

        $ghazwanDataComplaint = new Tanggapan();

        $ghazwanDataComplaint->id_pengaduan = $ghazwanReq->ghazwanId;
        $ghazwanDataComplaint->tanggapan = $ghazwanReq->ghazwanTanggapan;
        $ghazwanDataComplaint->tgl_tanggapan = Carbon::now();
        $ghazwanDataComplaint->id_petugas = Auth::guard('petugas')->user()->id_petugas;

        $ghazwanDataComplaint->save();

        $ghazwanDataComplaint2 = Pengaduan::where('id_pengaduan', $ghazwanReq->ghazwanId);
        $ghazwanDataComplaint2->update(['status' => $ghazwanReq->ghazwanStatus]);

        activity()->causedBy(Auth::guard('petugas')->user())->log(Auth::guard('petugas')->user()->nama_petugas . ' dengan hak akses sebagai ' . Auth::guard('petugas')->user()->level . ' telah menanggapi pengaduan dengan id' . $ghazwanReq->id_pengaduan);
        return redirect()->back();
    }

    public function showUserComplaint()
    {
        $ghazwanDataComplaint = Pengaduan::leftJoin('tanggapan', 'pengaduan.id_pengaduan', '=', 'tanggapan.id_pengaduan')->leftJoin('petugas', 'tanggapan.id_petugas', '=', 'petugas.id_petugas')->select('pengaduan.*', 'tanggapan.tanggapan as tanggapan', 'pengaduan.status as status', 'petugas.nama_petugas as nama_petugas')->where('pengaduan.nik', '=', Auth::guard('masyarakat')->user()->nik)->get();

        return view('my-complaint', compact('ghazwanDataComplaint'));
    }

    public function updateComplaint(Request $ghazwanReq, $id)
    {
        $ghazwanReq->validate([
            'ghazwanNewComplaint' => 'required|string',
            'ghazwanImage' => 'nullable|image|max:5120',
        ], [
            'ghazwanNewComplaint.required' => 'Isi laporan tidak boleh kosong!',
            'ghazwanImage.image' => 'File harus berupa gambar!',
            'ghazwanImage.max' => 'Ukuran gambar tidak boleh lebih dari 5MB!',
        ]);

        $ghazwanUpdate = Pengaduan::where('id_pengaduan', '=', $id);

        try {

            if ($ghazwanReq->ghazwanNewComplaint != null) {
                $ghazwanUpdate->update(['isi_laporan'=>$ghazwanReq->ghazwanNewComplaint]);
            }
            if ($ghazwanReq->hasFile('ghazwanImage')) {
                if ($ghazwanReq->ghazwanImage && Storage::disk('public')->exists($ghazwanReq->ghazwanImage)) {
                    Storage::disk('public')->delete($ghazwanReq->ghazwanImage);
                }

                $file = $ghazwanReq->file('ghazwanImage');
                $extension = $file->getClientOriginalExtension();
                $filename = Auth::guard('masyarakat')->user()->id . '_' . date('His') . '.' . $extension;
                $path = $file->storeAs('bukti_laporan', $filename, 'public');
                $ghazwanUpdate->update(['foto'=>$path]);
            }

            notify()->success('Pengaduan berhasil diperbaharui', 'Sukses!');
            return redirect()->back();
        } catch (\Exception $e) {
            notify()->error('Terjadi kesalahan saat memperbarui pengaduan!' . $e, 'Gagal!');
            return redirect()->back();
        }
    }

    public function deleteComplaint($id){
        $ghazwanDelete = Pengaduan::where('id_pengaduan', '=', $id);

        try {
            $ghazwanDelete->delete();
            notify()->success('Pengaduan berhasil dihapus', 'Sukses!');
            return redirect()->back();
        } catch (\Exception $e) {
            notify()->error('Terjadi kesalahan saat menghapus pengaduan!' . $e, 'Gagal!');
            return redirect()->back();
        }
    }
}

    // if ($ghazwanUpdate->nik != Auth::guard('masyarakat')->user()->nik) {
    //     notify()->error('Anda tidak memiliki akses untuk mengubah pengaduan ini!', 'Gagal!');
    //     return redirect()->back();
    // }
