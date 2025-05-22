@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    {{-- Header Section --}}
    <div class="text-center mb-10">
        <div class="flex justify-center mb-4">
            <img src="{{ asset('images/elementhome.png') }}" alt="Ilustrasi Keuangan" class="w-48">
        </div>
        <h1 class="text-2xl md:text-3xl font-bold">
            Kelola <span class="text-orange-500">Keuanganmu</span>, <span class="text-red-400">Capai</span> <span class="text-black">Mimpimu</span>
        </h1>
    </div>

    {{-- Saldo Section --}}
    <div class="mb-8 bg-gradient-to-r from-teal-400 to-blue-600 text-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold">Saldo</h2>
        <p class="text-2xl mt-2">Rp {{ number_format($balance ?? 0, 0, ',', '.') }}</p>
    </div>

    {{-- Forms Section --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        {{-- Form Pemasukan --}}
        <div class="bg-gradient-to-b from-slate-200 to-slate-400 p-6 rounded-lg shadow">
            <h3 class="text-lg font-bold mb-4">Tambah Pemasukan</h3>
            <form action="{{ url('/pemasukans/store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="nama" placeholder="Nama" class="w-full mb-3 p-2 rounded border" required>
                <select name="kategori_id" class="w-full mb-3 p-2 rounded border" required>
                    <option value="" disabled selected>Pilih Jenis</option>
                    @foreach(App\Models\Kategori::where('jenis', 'pemasukan')->get() as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                    @endforeach
                </select>
                <input type="number" name="nominal" placeholder="Nominal" class="w-full mb-3 p-2 rounded border" required>
                <input type="date" name="tanggal" class="w-full mb-3 p-2 rounded border" required>
                <input type="file" name="foto" accept="image/*" class="mb-3">
                <button class="bg-orange-400 hover:bg-orange-500 text-white font-semibold px-4 py-2 rounded" type="submit">Tambah</button>
            </form>
        </div>

        {{-- Form Pengeluaran --}}
        <div class="bg-gradient-to-b from-slate-200 to-slate-400 p-6 rounded-lg shadow">
            <h3 class="text-lg font-bold mb-4">Tambah Pengeluaran</h3>
            <form action="{{ url('/pengeluarans/store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="nama" placeholder="Nama" class="w-full mb-3 p-2 rounded border" required>
                <select name="kategori_id" class="w-full mb-3 p-2 rounded border" required>
                    <option value="" disabled selected>Pilih Jenis</option>
                    @foreach(App\Models\Kategori::where('jenis', 'pengeluaran')->get() as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                    @endforeach
                </select>
                <input type="number" name="nominal" placeholder="Nominal" class="w-full mb-3 p-2 rounded border" required>
                <input type="date" name="tanggal" class="w-full mb-3 p-2 rounded border" required>
                <input type="file" name="foto" accept="image/*" class="mb-3">
                <button class="bg-orange-400 hover:bg-orange-500 text-white font-semibold px-4 py-2 rounded" type="submit">Tambah</button>
            </form>
        </div>
    </div>
</div>
@endsection
