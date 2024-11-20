<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function submitComplaint(Request $ghazwanReq){
        $ghazwanReq->validate([
            'ghazwanComplaint' => 'required',
            'ghazwanImage' => 'required',
        ],[
            'ghazwanComplaint.required' => 'Masukkan Laporan Anda!',
            'ghazwanImage.required' => 'Sertakan Bukti Laporan Anda!',
            // 'ghazwanImage.image' => 'Anda hanya bisa mengunggah foto!',
        ]);
    }
}
