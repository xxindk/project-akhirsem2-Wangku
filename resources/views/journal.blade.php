@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-6">Jurnal Keuangan</h1>

    <div class="grid grid-cols-2 gap-8">
        {{-- Tabel Pemasukan --}}
        <div>
            <h2 class="text-xl font-semibold mb-4 text-green-600">Daftar Pemasukan</h2>
            <table class="w-full border border-gray-300 rounded">
                <thead class="bg-green-100">
                    <tr>
                        <th class="border px-4 py-2">No</th>
                        <th class="border px-4 py-2">Nama</th>
                        <th class="border px-4 py-2">Kategori</th>
                        <th class="border px-4 py-2">Jumlah (Rp)</th>
                        <th class="border px-4 py-2">Tanggal</th>
                        <th class="border px-4 py-2">Foto</th>
                        <th class="border px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pemasukans as $index => $pemasukan)
                        <tr>
                            <td class="border px-4 py-2 text-center">{{ $index + 1 }}</td>
                            <td class="border px-4 py-2">{{ $pemasukan->nama }}</td>
                            <td class="border px-4 py-2">{{ $pemasukan->kategori->nama ?? '-' }}</td>
                            <td class="border px-4 py-2 text-right">{{ number_format($pemasukan->nominal, 0, ',', '.') }}</td>
                            <td class="border px-4 py-2 text-center">{{ \Carbon\Carbon::parse($pemasukan->tanggal)->format('d-m-Y') }}</td>
                            <td class="border px-4 py-2 text-center">
                                @if($pemasukan->foto)
                                    <img src="{{ asset('storage/' . $pemasukan->foto) }}" alt="Foto Pemasukan" width="80">
                                @else
                                    Tidak ada foto
                                @endif
                            </td>
                            <td class="border px-4 py-2 text-center">
<button onclick="openModalPemasukan(
    {{ $pemasukan->id }}, 
    '{{ addslashes($pemasukan->nama) }}', 
    '{{ $pemasukan->kategori_id }}', 
    '{{ $pemasukan->nominal }}', 
    '{{ $pemasukan->tanggal }}',
    '{{ $pemasukan->foto }}'
)">Edit</button>
                               <form action="{{ url('/pemasukans/' . $pemasukan->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin hapus data pemasukan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center py-4">Belum ada data pemasukan</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>




        


        {{-- Tabel Pengeluaran --}}
        <div>
            <h2 class="text-xl font-semibold mb-4 text-red-600">Daftar Pengeluaran</h2>
            <table class="w-full border border-gray-300 rounded">
                <thead class="bg-red-100">
                    <tr>
                        <th class="border px-4 py-2">No</th>
                        <th class="border px-4 py-2">Nama</th>
                        <th class="border px-4 py-2">Kategori</th>
                        <th class="border px-4 py-2">Jumlah (Rp)</th>
                        <th class="border px-4 py-2">Tanggal</th>
                        <th class="border px-4 py-2">Foto</th>
                        <th class="border px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengeluarans as $index => $pengeluaran)
                        <tr>
                            <td class="border px-4 py-2 text-center">{{ $index + 1 }}</td>
                            <td class="border px-4 py-2">{{ $pengeluaran->nama }}</td>
                            <td class="border px-4 py-2">{{ $pengeluaran->kategori->nama ?? '-' }}</td>
                            <td class="border px-4 py-2 text-right">{{ number_format($pengeluaran->nominal, 0, ',', '.') }}</td>
                            <td class="border px-4 py-2 text-center">{{ \Carbon\Carbon::parse($pengeluaran->tanggal)->format('d-m-Y') }}</td>
                            <td class="border px-4 py-2 text-center">
                                @if($pengeluaran->foto)
                                    <img src="{{ asset('storage/' . $pengeluaran->foto) }}" alt="Foto Pengeluaran" width="80">
                                @else
                                    Tidak ada foto
                                @endif
                            </td>
                            <td class="border px-4 py-2 text-center">
<button onclick="openModalPengeluaran(
    {{ $pengeluaran->id }}, 
    '{{ addslashes($pengeluaran->nama) }}', 
    '{{ $pengeluaran->kategori_id }}', 
    '{{ $pengeluaran->nominal }}', 
    '{{ $pengeluaran->tanggal }}',
    '{{ $pengeluaran->foto }}'
)">Edit</button>


                                <form action="{{ url('/pengeluarans/' . $pengeluaran->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin hapus data pengeluaran ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center py-4">Belum ada data pengeluaran</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>



   <!-- Modal Edit -->
<div id="editModalPengeluaran" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.5);">
  <div style="background:white; margin:100px auto; padding:20px; width:50%;">
    <h3>Edit Pengeluaran</h3>
    <form id="editFormPengeluaran" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      Nama: <input type="text" name="nama" id="editNamaPengeluaran"><br>
      Kategori:
       <select name="kategori_id" id="editKategoriPengeluaran" class="w-full border rounded p-2" required>
                        <option value="" disabled selected>Pilih kategori</option>
                        @foreach(App\Models\Kategori::where('jenis', 'pengeluaran')->get() as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                        @endforeach
                    </select><br>
      Nominal: <input type="number" name="nominal" id="editNominalPengeluaran"><br>
        Tanggal: <input type="date" name="tanggal" id="editTanggalPengeluaran"><br>
      Foto: <input type="file" name="foto"><br>

    <img id="fotoPreviewPengeluaran" src="" alt="Preview Foto" style="display:none; max-width:150px; margin-top:10px;"><br>

      <button type="button" onclick="closeModalPengeluaran()">Batal</button>
      <button type="submit">Simpan</button>
    </form>
  </div>
</div>

<div id="editModalPemasukan" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.5);">
  <div style="background:white; margin:100px auto; padding:20px; width:50%;">
    <h3>Edit Pemasukan</h3>
    <form id="editFormPemasukan" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      Nama: <input type="text" name="nama" id="editNamaPemasukan"><br>
      Kategori:
       <select name="kategori_id" id="editKategoriPemasukan" class="w-full border rounded p-2" required>
         <option value="" disabled selected>Pilih kategori</option>
         @foreach(App\Models\Kategori::where('jenis', 'pemasukan')->get() as $kategori)
           <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
         @endforeach
       </select><br>
      Nominal: <input type="number" name="nominal" id="editNominalPemasukan"><br>
      Tanggal: <input type="date" name="tanggal" id="editTanggalPemasukan"><br>
      Foto: <input type="file" name="foto"><br>
      <img id="fotoPreviewPemasukan" src="" alt="Preview Foto" style="display:none; max-width:150px; margin-top:10px;"><br>

      <button type="button" onclick="closeModalPemasukan()">Batal</button>
      <button type="submit">Simpan</button>
    </form>
  </div>
</div>


<script>
function openModalPemasukan(id, nama, kategori, nominal, tanggal, foto) {
  document.getElementById('editModalPemasukan').style.display = 'block';
  const form = document.getElementById('editFormPemasukan');
  form.action = '/pemasukans/' + id;
  document.getElementById('editNamaPemasukan').value = nama;
  document.getElementById('editKategoriPemasukan').value = kategori;
  document.getElementById('editNominalPemasukan').value = nominal;
  document.getElementById('editTanggalPemasukan').value = tanggal;

  const fotoPreview = document.getElementById('fotoPreviewPemasukan');
  if (foto && foto !== '') {
    fotoPreview.src = '/storage/' + foto;
    fotoPreview.style.display = 'block';
  } else {
    fotoPreview.style.display = 'none';
  }
}

function closeModalPemasukan() {
  document.getElementById('editModalPemasukan').style.display = 'none';
}

function openModalPengeluaran(id, nama, kategori, nominal, tanggal, foto) {
  document.getElementById('editModalPengeluaran').style.display = 'block';
  const form = document.getElementById('editFormPengeluaran');
  form.action = '/pengeluarans/' + id;
  document.getElementById('editNamaPengeluaran').value = nama;
  document.getElementById('editKategoriPengeluaran').value = kategori;
  document.getElementById('editNominalPengeluaran').value = nominal;
  document.getElementById('editTanggalPengeluaran').value = tanggal;
const fotoPreview = document.getElementById('fotoPreviewPengeluaran');
  if (foto && foto !== '') {
    fotoPreview.src = '/storage/' + foto;
    fotoPreview.style.display = 'block';
  } else {
    fotoPreview.style.display = 'none';
  }
}

function closeModalPengeluaran() {
  document.getElementById('editModalPengeluaran').style.display = 'none';
}

</script>

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Dashboard Keuangan</h2>

        <div class="row">
            <div class="col-md-6">
                {!! $chartPemasukan->container() !!}
            </div>
            <div class="col-md-6">
                {!! $chartPengeluaran->container() !!}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {!! $chartPemasukan->script() !!}
    {!! $chartPengeluaran->script() !!}
@endpush
