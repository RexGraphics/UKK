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

    // Array nama bulan dalam bahasa Indonesia
    $namaBulan = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    ];

    for ($ghazwanMonth = 1; $ghazwanMonth <= 12; $ghazwanMonth++) {
        $ghazwanMonthlyReport[$ghazwanMonth] = [
            'bulan' => $namaBulan[$ghazwanMonth], // Nama bulan dalam bahasa Indonesia
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

    Session::put([
        'ghazwanMonthlyReport' => $ghazwanMonthlyReport,
        'ghazwanYear' => $ghazwanFilterYear
    ]);

    return view('admin.report', compact('ghazwanMonthlyReport', 'ghazwanFilterYear'));
}

    public function printData(Request $ghazwanReq)
    {

        $ghazwanPeriod = Session::get('ghazwanYear');
        $ghazwanReport = Session::get('ghazwanMonthlyReport');

        if (is_null($ghazwanReport)) {
            return redirect()->back()->withErrors('Data laporan tidak tersedia. Silakan pilih periode terlebih dahulu.');
        }
        if ($ghazwanReq->get('export') == 'pdf') {
            $ghazwanPdf = Pdf::loadView('report.index', ['ghazwanReport' => $ghazwanReport, 'ghazwanPeriod' => $ghazwanPeriod]);
            return $ghazwanPdf->stream('Laporan Pengaduan.pdf');
        }
    }
}
