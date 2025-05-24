<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $kategoris = [
    ['nama' => 'Pemasukan utama', 'jenis' => 'pemasukan'],
    ['nama' => 'Bonus & tunjangan', 'jenis' => 'pemasukan'],
    ['nama' => 'Uang tak terduga', 'jenis' => 'pemasukan'],
    ['nama' => 'Lainnya', 'jenis' => 'pemasukan'],
    ['nama' => 'Makanan & minuman', 'jenis' => 'pengeluaran'],
    ['nama' => 'Rumah & utilitas', 'jenis' => 'pengeluaran'],
    ['nama' => 'Transportasi', 'jenis' => 'pengeluaran'],
    ['nama' => 'Kesehatan', 'jenis' => 'pengeluaran'],
    ['nama' => 'Hiburan', 'jenis' => 'pengeluaran'],
    ['nama' => 'Pakaian', 'jenis' => 'pengeluaran'],
       ['nama' => 'Perawatan diri', 'jenis' => 'pengeluaran'],
    ['nama' => 'Pendidikan', 'jenis' => 'pengeluaran'],
    ['nama' => 'Pengembangan diri', 'jenis' => 'pengeluaran'],
    ['nama' => 'Hadiah & amal', 'jenis' => 'pengeluaran'],
    ['nama' => 'Kewajiban/tagihan', 'jenis' => 'pengeluaran'],
    ['nama' => 'Tabungan & investasi', 'jenis' => 'pengeluaran'],
    ['nama' => 'Pekerjaan/Usaha', 'jenis' => 'pengeluaran'],
    ['nama' => 'Lainnya', 'jenis' => 'pengeluaran']
]; 
foreach ($kategoris as $kategori) {
    Kategori::create($kategori);
}

    }
}
