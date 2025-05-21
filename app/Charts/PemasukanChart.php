<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Pemasukan;
use App\Models\Kategori;

class PemasukanChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        $data = Kategori::with('pemasukan')->get();

        $labels = $data->pluck('nama')->toArray();
        $values = $data->map(function ($kategori) {
            return $kategori->pemasukan->sum('jumlah');
        });

        return $this->chart->donutChart()
            ->setTitle('Pemasukan per Kategori')
            ->addData($values->toArray())
            ->setLabels($labels);
    }
}
