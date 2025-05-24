@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    {{-- Header Section --}}
    <div class="row align-items-center text-start mb-5">
        <div class="col-12 col-md-6 d-flex justify-content-center align-items-center">
            <h1 class="fw-bold display-5 text-start">
                Kelola <span style="color: #F4A261;">Keuanganmu</span>,<br>
                <span style="color: #F4A261;">Capai</span> <span class="text-dark">Mimpimu</span>
            </h1>
        </div>
        <div class="col-12 col-md-6 text-center">
            <img src="{{ asset('images/elementhome.png') }}" alt="Ilustrasi Keuangan" style="max-width: 100%; height: auto;">
        </div>
    </div>

    {{-- Saldo Section --}}
{{-- Saldo Section --}}
<div class="mb-5 p-4  rounded shadow text-white text-start" style="background: linear-gradient(to bottom, #80A4A7, #486A6E);">
    <h2 class="h6 fw-semibold mb-1 opacity-100">Saldo</h2>
    <hr class="opacity-100 my-2 ms-0" style="width: auto; border-top: 2px solid #ffffff;">
    <p class=" h6 mt-2 fw-semibold opacity-100">Rp {{ number_format($balance ?? 0, 0, ',', '.') }}</p>
</div>


    {{-- Forms Section --}}
    <div class="row g-10-rem opacity-100">
        {{-- Form Pemasukan --}}
        <div class="col-md-6 opacity-100">
            <div class="p-4 rounded shadow text-white" style="background: linear-gradient(to bottom, #80A4A7, #486A6E);">
                <h3 class="h4 fw-bold mb-4 mt-4 text-start opacity-100">Tambah Pemasukan</h3>
                <form action="{{ url('/pemasukans/store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="nama_pemasukan" class="form-label">Nama</label>
        <input type="text" id="nama_pemasukan" name="nama" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="kategori_pemasukan" class="form-label">Kategori</label>
        <select id="kategori_pemasukan" name="kategori_id" class="form-select" required>
            <option value="" disabled selected>Pilih Jenis</option>
            @foreach(App\Models\Kategori::where('jenis', 'pemasukan')->get() as $kategori)
                <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="nominal_pemasukan" class="form-label">Nominal</label>
        <input type="number" id="nominal_pemasukan" name="nominal" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="tanggal_pemasukan" class="form-label">Tanggal</label>
        <input type="date" id="tanggal_pemasukan" name="tanggal" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="foto_pemasukan" class="form-label">Upload Foto (Opsional)</label>
        <input type="file" id="foto_pemasukan" name="foto" class="form-control" accept="image/*">
    </div>
<div class="text-end">
    <button type="submit" class="btn fw-semibold text-white mb-4 mt-3" style="background-color: #F4A261;">Tambah</button>
</div>
</form>

            </div>
        </div>

        {{-- Form Pengeluaran --}}
        <div class="col-md-6 opacity-100">
            <div class="p-4 rounded shadow text-white" style="background: linear-gradient(to bottom, #80A4A7, #486A6E);">
                <h3 class="h4 fw-bold mb-4 mt-4 text-start opacity-100">Tambah Pengeluaran</h3>
                <form action="{{ url('/pengeluarans/store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="nama_pengeluaran" class="form-label">Nama</label>
        <input type="text" id="nama_pengeluaran" name="nama" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="kategori_pengeluaran" class="form-label">Kategori</label>
        <select id="kategori_pengeluaran" name="kategori_id" class="form-select" required>
            <option value="" disabled selected>Pilih Jenis</option>
            @foreach(App\Models\Kategori::where('jenis', 'pengeluaran')->get() as $kategori)
                <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="nominal_pengeluaran" class="form-label">Nominal</label>
        <input type="number" id="nominal_pengeluaran" name="nominal" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="tanggal_pengeluaran" class="form-label">Tanggal</label>
        <input type="date" id="tanggal_pengeluaran" name="tanggal" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="foto_pengeluaran" class="form-label">Upload Foto (Opsional)</label>
        <input type="file" id="foto_pengeluaran" name="foto" class="form-control" accept="image/*">
    </div>
<div class="text-end">
    <button type="submit" class="btn fw-semibold text-white mb-4 mt-3" style="background-color: #F4A261;">Tambah</button>
</div>
</form>

            </div>
        </div>
    </div>
</div>
@endsection
