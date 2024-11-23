<?php

namespace App\Charts;

use Carbon\Carbon;
use App\Models\Pengaduan;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class ReportDataChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $monthlyPengaduan = Pengaduan::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Nama bulan
        $months = collect(range(1, 12))->map(function ($month) {
            return Carbon::create()->month($month)->translatedFormat('F');
        });

        // Format data untuk chart
        return $chart = (new LarapexChart)->barChart()
            ->setTitle('Statistik Pengaduan Per Bulan')
            ->setXAxis($months->toArray()) // Semua nama bulan
            ->setDataset([
                [
                    'name' => 'Jumlah Pengaduan',
                    'data' => $months->map(function ($_, $key) use ($monthlyPengaduan) {
                        $month = $key + 1;
                        $data = $monthlyPengaduan->firstWhere('month', $month);
                        return $data ? $data->total : 0; // Jika tidak ada data, isi dengan 0
                    })->toArray()
                ]
            ]);
    }
}
