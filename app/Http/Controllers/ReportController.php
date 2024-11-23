<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ReportController extends Controller
{
    protected $ghazwanReportPrint;

    public function showReport()
    {
        $ghazwanMonthlyReport = 'Pilih tahun untuk menampilkan data';
        $ghazwanFilterYear = 'Pilih tahun untuk menampilkan data';

        return view('admin.report', compact('ghazwanMonthlyReport', 'ghazwanFilterYear'));
    }

    public function filterData(Request $request)
    {
        $ghazwanFilterYear = $request->filled('ghazwanPeriod') ? $request->ghazwanPeriod : null;

        for ($ghazwanMonth = 1; $ghazwanMonth <= 12; $ghazwanMonth++) {
            $ghazwanMonthlyReport[$ghazwanMonth] = [
                'bulan' => \DateTime::createFromFormat('!m', $ghazwanMonth)->format('F'), // Nama ghazwanMonth
                'baru' => Pengaduan::whereYear('tgl_pengaduan', $ghazwanFilterYear)
                    ->whereMonth('tgl_pengaduan', $ghazwanMonth)
                    ->where('status', '0')
                    ->count(),
                'proses' => Pengaduan::whereYear('tgl_pengaduan', $ghazwanFilterYear)
                    ->whereMonth('tgl_pengaduan', $ghazwanMonth)
                    ->where('status', 'proses')
                    ->count(),
                'selesai' => Pengaduan::whereYear('tgl_pengaduan', $ghazwanFilterYear)
                    ->whereMonth('tgl_pengaduan', $ghazwanMonth)
                    ->where('status', 'selesai')
                    ->count(),
            ];
        }


        return view('admin.report', compact('ghazwanMonthlyReport', 'ghazwanFilterYear'));
    }

    // public function filterData(Request $ghazwanReq)
    // {

    //     $ghazwanStartDate = Carbon::parse($ghazwanReq->start)->format('Y-m-d');
    //     $ghazwanEndDate = Carbon::parse($ghazwanReq->end)->format('Y-m-d');

    //     $query = Pengaduan::query();


    //     if($ghazwanReq->filled('ghazwanStatus')){
    //         if($ghazwanReq->ghazwanStatus != 'semua'){
    //             $query->where('status','=', $ghazwanReq->ghazwanStatus);
    //         }

    //     }

    //     if($ghazwanReq->filled('start')){
    //         $query->where('tgl_pengaduan','>=', $ghazwanStartDate);
    //     }

    //     if($ghazwanReq->filled('end')){
    //         $query->where('tgl_pengaduan','<=', $ghazwanEndDate);

    //     }


    //     $ghazwanReport = $query->orderBy('tgl_pengaduan', 'desc') ->get();
    //     Session::put('ghazwanReportPrint', $ghazwanReport);

    //     return view('admin.report', compact('ghazwanReport'));
    // }

    public function printData(Request $ghazwanReq)
    {

        $ghazwanReport = Session::get('ghazwanReportPrint');
        // dd($ghazwanReport);
        if ($ghazwanReq->get('export') == 'pdf') {
            $ghazwanPdf = Pdf::loadView('report.index', ['ghazwanReport' => $ghazwanReport]);
            return $ghazwanPdf->stream('Laporan Pengaduan.pdf');
        }
    }
}
