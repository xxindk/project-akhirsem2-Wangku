<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Pengeluaran;
use App\Models\Kategori;

class PengeluaranChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        $data = Kategori::with('pengeluaran')->get();

        $labels = $data->pluck('nama')->toArray();
        $values = $data->map(function ($kategori) {
            return $kategori->pengeluaran->sum('jumlah');
        });

        return $this->chart->donutChart()
            ->setTitle('Pengeluaran per Kategori')
            ->addData($values->toArray())
            ->setLabels($labels);
    }
}
