<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function showReport() {
        $ghazwanReport = Pengaduan::all();

        return view('admin.report', compact('ghazwanReport'));
    }

    public function filterData(Request $ghazwanReq)
    {

        $ghazwanStartDate = Carbon::parse($ghazwanReq->start)->format('Y-m-d');
        $ghazwanEndDate = Carbon::parse($ghazwanReq->end)->format('Y-m-d');

        $query = Pengaduan::query();


        if($ghazwanReq->filled('ghazwanStatus')){
            if($ghazwanReq->ghazwanStatus != 'semua'){
                $query->where('status','=', $ghazwanReq->ghazwanStatus);
                // dd();
            }

        }

        if($ghazwanReq->filled('start')){
            $query->where('tgl_pengaduan','>=', $ghazwanStartDate);
        }

        if($ghazwanReq->filled('end')){
            $query->where('tgl_pengaduan','<=', $ghazwanEndDate);

        }


        $ghazwanReport = $query->orderBy('tgl_pengaduan', 'desc') ->get();

        // dd($ghazwanReport);

        // $ghazwanReport = Pengaduan::select(DB::raw('DATE(tgl_pengaduan) as tanggal'), DB::raw('count(*) as jumlah'))
        //     ->whereBetween('tgl_pengaduan', [$ghazwanReq->start, $ghazwanReq->end])
        //     ->groupBy('tanggal')
        //     ->orderBy('tanggal', 'asc')
        //     ->get();

        return view('admin.report', compact('ghazwanReport'));
    }

    public function printData(Request $ghazwanReq) {
        // dd($ghazwanReq->ghazwanAllData);
        $ghazwanAllData = json_decode($ghazwanReq->ghazwanAllData, true);
        $statuses = array_column($ghazwanAllData, 'status'); $statusCounts = array_count_values($statuses);
        dd($statusCounts);
        // return view('report.index', compact('ghazwanAllData', 'statuses'));
    }
}
