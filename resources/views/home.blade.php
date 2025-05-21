@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">

   
    <div class="mb-6 p-4 bg-blue-100 border border-blue-300 rounded text-blue-800 font-semibold text-lg">
        Saldo Saat Ini: Rp {{ number_format($balance ?? 0, 0, ',', '.') }}
    </div>
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-6">Tambah Data Keuangan</h1>

    <div class="grid grid-cols-2 gap-8">
        {{-- Form Pemasukan --}}
        <div class="border p-4 rounded shadow">
            <h2 class="text-xl font-semibold mb-4 text-green-600">Tambah Pemasukan</h2>
            <form action="{{ url('/pemasukans/store') }}" method="POST" enctype="multipart/form-data" >
                @csrf
                <div class="mb-3">
                    <label for="nama_pemasukan" class="block font-medium">Nama </label>
                    <input type="text" name="nama" id="nama_pemasukan" class="w-full border rounded p-2" required>
                </div>
                <div class="mb-3">
                    <label for="kategori_pemasukan" class="block font-medium">Kategori</label>
                    <select name="kategori_id" id="kategori_pemasukan" class="w-full border rounded p-2" required>
                        <option value="" disabled selected>Pilih kategori</option>
                        @foreach(App\Models\Kategori::where('jenis', 'pemasukan')->get() as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="nominal_pemasukan" class="block font-medium">Jumlah (Rp)</label>
                    <input type="number" name="nominal" id="nominal_pemasukan" class="w-full border rounded p-2" required min="0">
                </div>
                <div class="mb-3">
                    <label for="tanggal_pemasukan" class="block font-medium">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal_pemasukan" class="w-full border rounded p-2" required>
                </div>
                <div class="mb-3">
                     
    <label for="foto_pemasukan">Foto</label>
    <input type="file" name="foto" id="foto_pemasukan" accept="image/*">
</div>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Tambah Pemasukan</button>
            </form>
        </div>

        {{-- Form Pengeluaran --}}
        <div class="border p-4 rounded shadow">
            <h2 class="text-xl font-semibold mb-4 text-red-600">Tambah Pengeluaran</h2>
            <form action="{{ url('/pengeluarans/store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nama_pengeluaran" class="block font-medium">Nama </label>
                    <input type="text" name="nama" id="nama_pengeluaran" class="w-full border rounded p-2" required>
                </div>
                <div class="mb-3">
                    <label for="kategori_pengeluaran" class="block font-medium">Kategori</label>
                    <select name="kategori_id" id="kategori_pengeluaran" class="w-full border rounded p-2" required>
                        <option value="" disabled selected>Pilih kategori</option>
                        @foreach(App\Models\Kategori::where('jenis', 'pengeluaran')->get() as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="nominal_pengeluaran" class="block font-medium">Jumlah (Rp)</label>
                    <input type="number" name="nominal" id="nominal_pengeluaran" class="w-full border rounded p-2" required min="0">
                </div>
                <div class="mb-3">
                    <label for="tanggal_pengeluaran" class="block font-medium">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal_pengeluaran" class="w-full border rounded p-2" required>
                </div>
                <div class="mb-3">
                     
    <label for="foto_pengeluaran">Foto</label>
    <input type="file" name="foto" id="foto_pengeluaran" accept="image/*">
</div>
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Tambah Pengeluaran</button>
            </form>
        </div>
    </div>
</div>
@endsection

