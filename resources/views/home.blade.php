@extends('layouts.app')

@section('content')
<div class="container py-4">
    {{-- Header Section --}}
    <div class="row align-items-center text-start mb-5">
        <div class="col-6 d-flex justify-content-center align-items-center">
            <h1 class="fw-bold display-5">
                Kelola <span style="color: #F4A261;">Keuanganmu</span>,<br>
                <span style="color: #F4A261;">Capai</span> <span class="text-dark">Mimpimu</span>
            </h1>
        </div>
        <div class="col-6">
            <img src="{{ asset('images/elementhome.png') }}" alt="Ilustrasi Keuangan" style="max-width: 100%; height: auto;">
        </div>
    </div>
</div>


    {{-- Saldo Section --}}
    <div class="mb-5 p-4 rounded bg-gradient text-dark shadow" style="background: linear-gradient(to right, #2dd4bf, #3b82f6);">
        <h2 class="h6 fw-semibold">Saldo</h2>
        <p class="h3 mt-2">Rp {{ number_format($balance ?? 0, 0, ',', '.') }}</p>
    </div>

    {{-- Forms Section --}}
    <div class="row g-4">
        {{-- Form Pemasukan --}}
        <div class="col-md-6">
            <div class="bg-light p-4 rounded shadow">
                <h3 class="h6 fw-bold mb-4">Tambah Pemasukan</h3>
                <form action="{{ url('/pemasukans/store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="nama" class="form-control" placeholder="Nama" required>
                    </div>
                    <div class="mb-3">
                        <select name="kategori_id" class="form-select" required>
                            <option value="" disabled selected>Pilih Jenis</option>
                            @foreach(App\Models\Kategori::where('jenis', 'pemasukan')->get() as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="number" name="nominal" class="form-control" placeholder="Nominal" required>
                    </div>
                    <div class="mb-3">
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <input type="file" name="foto" class="form-control" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-warning text-white fw-semibold">Tambah</button>
                </form>
            </div>
        </div>

        {{-- Form Pengeluaran --}}
        <div class="col-md-6">
            <div class="bg-light p-4 rounded shadow">
                <h3 class="h6 fw-bold mb-4">Tambah Pengeluaran</h3>
                <form action="{{ url('/pengeluarans/store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="nama" class="form-control" placeholder="Nama" required>
                    </div>
                    <div class="mb-3">
                        <select name="kategori_id" class="form-select" required>
                            <option value="" disabled selected>Pilih Jenis</option>
                            @foreach(App\Models\Kategori::where('jenis', 'pengeluaran')->get() as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="number" name="nominal" class="form-control" placeholder="Nominal" required>
                    </div>
                    <div class="mb-3">
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <input type="file" name="foto" class="form-control" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-warning text-white fw-semibold">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
