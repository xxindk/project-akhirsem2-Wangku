@extends('layouts.appgreen')

@section('content')
<div class="container mx-auto p-4">
    
<h2 class="h3 fw-semibold text-white mb-4 mt-4 opacity-100">Catatan Pengeluaran</h2>       
        <div class="rounded overflow-hidden">
           {{-- Tabel Pengeluaran --}}
        <table class="table table-bordered text-center w-full">
<thead>
    <tr>
        <th style="background-color: #F4A261 !important; color: white !important;">Nama</th>
        <th style="background-color: #F4A261 !important; color: white !important;">Kategori</th>
        <th style="background-color: #F4A261 !important; color: white !important;">Jumlah (Rp)</th>
        <th style="background-color: #F4A261 !important; color: white !important;">Tanggal</th>
        <th style="background-color: #F4A261 !important; color: white !important;">Foto</th>
        <th style="background-color: #F4A261 !important; color: white !important;">Aksi</th>
    </tr>
</thead>



                <tbody>
                    @forelse($pengeluarans as $index => $pengeluaran)
                        <tr>
                            <td class="border px-4 py-2">{{ $pengeluaran->nama }}</td>
                            <td class="border px-4 py-2">{{ $pengeluaran->kategori->nama ?? '-' }}</td>
                            <td class="border px-4 py-2 text-right">{{ number_format($pengeluaran->nominal, 0, ',', '.') }}</td>
                            <td class="border px-4 py-2 text-center">{{ \Carbon\Carbon::parse($pengeluaran->tanggal)->format('d-m-Y') }}</td>
                            <td class="border px-4 py-2 text-center">
                                @if($pengeluaran->foto)
<img src="{{ asset('storage/' . $pengeluaran->foto) }}" width="80">
                                @else
                                    Tidak ada foto
                                @endif
                            </td>
                            <td class="border px-4 py-2 text-center">
<button class="btn btn-sm btn-warning me-1" onclick="openModalPengeluaran(
    {{ $pengeluaran->id }}, 
    '{{ addslashes($pengeluaran->nama) }}', 
    '{{ $pengeluaran->kategori_id }}', 
    '{{ $pengeluaran->nominal }}', 
    '{{ $pengeluaran->tanggal }}',
    '{{ $pengeluaran->foto }}'
)"> <i class="bi bi-pencil-square"></i> Edit </button>


                                <form action="{{ url('/pengeluarans/' . $pengeluaran->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Yakin ingin hapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center py-4">Belum ada data pengeluaran</td></tr>
                    @endforelse
                </tbody>
            </table>

           
        </div>

      


    <h2 class="h3 fw-semibold text-white mb-4 mt-4 opacity-100">Catatan Pemasukan</h2>       
        <div class="rounded overflow-hidden">
           {{-- Tabel Pemasukan --}}
 <table class="table table-bordered text-center ">
<thead>
    <tr>
        <th style="background-color: #F4A261 !important; color: white !important;">Nama</th>
        <th style="background-color: #F4A261 !important; color: white !important;">Kategori</th>
        <th style="background-color: #F4A261 !important; color: white !important;">Jumlah (Rp)</th>
        <th style="background-color: #F4A261 !important; color: white !important;">Tanggal</th>
        <th style="background-color: #F4A261 !important; color: white !important;">Foto</th>
        <th style="background-color: #F4A261 !important; color: white !important;">Aksi</th>
    </tr>
</thead>
              <tbody>
                    @forelse($pemasukans as $index => $pemasukan)
                        <tr>
                            <td class="border px-4 py-2">{{ $pemasukan->nama }}</td>
                            <td class="border px-4 py-2">{{ $pemasukan->kategori->nama ?? '-' }}</td>
                            <td class="border px-4 py-2 text-right">{{ number_format($pemasukan->nominal, 0, ',', '.') }}</td>
                            <td class="border px-4 py-2 text-center">{{ \Carbon\Carbon::parse($pemasukan->tanggal)->format('d-m-Y') }}</td>
                            <td class="border px-4 py-2 text-center">
                                @if($pemasukan->foto)
<img src="{{ asset('storage/' . $pemasukan->foto) }}" width="80">
                                @else
                                    Tidak ada foto
                                @endif
                            </td>
                            <td class="border px-4 py-2 text-center">
<button class="btn btn-sm btn-warning me-1" onclick="openModalPemasukan(
    {{ $pemasukan->id }}, 
    '{{ addslashes($pemasukan->nama) }}', 
    '{{ $pemasukan->kategori_id }}', 
    '{{ $pemasukan->nominal }}', 
    '{{ $pemasukan->tanggal }}',
    '{{ $pemasukan->foto }}'
)"><i class="bi bi-pencil-square"></i> Edit</button>
                               <form action="{{ url('/pemasukans/' . $pemasukan->id) }}" method="POST" style="display:inline-block"  onsubmit="return confirm('Yakin ingin hapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center py-4">Belum ada data pemasukan</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>


<div class="row g-10-rem  mt-4 opacity-100">
      <!-- Chart -->
        <div class="col-md-6 opacity-100">
        <div class="p-4 rounded text-white" style="background: white;">
            <h2 class="h6 fw-semibold text-black mb-4 opacity-100">Total Pemasukan</h2> 
            {!! $chartPemasukan->container() !!}
            <div class="text-center text-xl font-bold mt-4">
                Rp {{ number_format($totalPemasukan, 0, ',', '.') }},-
            </div>
        </div>
    </div>

    <!-- Chart -->
        <div class="col-md-6 opacity-100">
        <div class="p-4 rounded text-white" style="background: white;">
            <h2 class="h6 fw-semibold text-black mb-4 opacity-100">Total Pengeluaran</h2> 
            {!! $chartPengeluaran->container() !!}
            <div class="text-center text-xl font-bold mt-4">
                Rp {{ number_format($totalPengeluaran, 0, ',', '.') }},-
            </div>
        </div>
    </div>
</div>

<div class="flex justify-center mt-5">
    <img src="{{ asset('images/journalbawah.png') }}" alt="Gambar Akhir" class="w-100 mt-5" style=" object-fit: cover;">
</div>





        


       


   <!-- Modal Edit -->
<div id="editModalPengeluaran" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.5); z-index:1000;">
  <div style="background:white; margin:100px auto; padding:20px 30px; width:400px; border-radius:10px; font-family:sans-serif; position:relative;">
    <h3 style="font-weight:600; font-size:18px; margin-bottom:15px;">Edit Catatan Pengeluaran</h3>
    <form id="editFormPengeluaran" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <label>Nama: </label>
<input type="text" name="nama" id="editNamaPengeluaran" 
       style="border: none !important; border-bottom: 1px solid #ccc; background: transparent; font-weight: 500; outline: none; !important">
<br>
      <label>Kategori:</label>
<select name="kategori_id" id="editKategoriPengeluaran" 
        class="w-full border rounded p-2" 
        style="background-color: #f0f0f0; font-weight: 600;" required>
  <option value="" disabled selected>Pilih kategori</option>
  @foreach(App\Models\Kategori::where('jenis', 'pengeluaran')->get() as $kategori)
    <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
  @endforeach
</select><br>

      Nominal: <input type="number" name="nominal" id="editNominalPengeluaran" style="border: none !important; border-bottom: 1px solid #ccc; background: transparent; font-weight: 500; outline: none; !important">
<br>
      Tanggal: <input type="date" name="tanggal" id="editTanggalPengeluaran" class="w-full border rounded p-2" 
        style="background-color: #f0f0f0; font-weight: 600;" required><br>
      Foto: <input type="file" name="foto"><br>
      <img id="fotoPreviewPengeluaran" src="" alt="Preview Foto" style="display:none; max-width:150px; margin-top:10px;"><br>

      <div style="text-align:right;">
        <button type="submit" style="background:#F4A261; color:white; border:none; padding:10px 20px; border-radius:10px; font-weight:600; cursor:pointer;">Simpan</button>
      </div>
    </form>

    <!-- Tombol close (x) -->
    <button onclick="document.getElementById('editModalPengeluaran').style.display='none'" style="position:absolute; top:10px; right:15px; border:none; background:none; font-size:20px; font-weight:bold; cursor:pointer;">×</button>
  </div>
</div>


<div id="editModalPemasukan" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.5); z-index:1000;">
  <div style="background:white; margin:100px auto; padding:20px 30px; width:400px; border-radius:10px; font-family:sans-serif; position:relative;">
    <h3 style="font-weight:600; font-size:18px; margin-bottom:15px;">Edit Catatan Pemasukan</h3>
    <form id="editFormPemasukan" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <label>Nama: </label>
<input type="text" name="nama" id="editNamaPemasukan" 
       style="border: none !important; border-bottom: 1px solid #ccc; background: transparent; font-weight: 500; outline: none; !important">
<br>
      <label>Kategori:</label>
<select name="kategori_id" id="editKategoriPemasukan" 
        class="w-full border rounded p-2" 
        style="background-color: #f0f0f0; font-weight: 600;" required>
  <option value="" disabled selected>Pilih kategori</option>
  @foreach(App\Models\Kategori::where('jenis', 'pemasukan')->get() as $kategori)
    <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
  @endforeach
</select><br>

      Nominal: <input type="number" name="nominal" id="editNominalPemasukan" style="border: none !important; border-bottom: 1px solid #ccc; background: transparent; font-weight: 500; outline: none; !important">
<br>
      Tanggal: <input type="date" name="tanggal" id="editTanggalPemasukan" class="w-full border rounded p-2" 
        style="background-color: #f0f0f0; font-weight: 600;" required><br>
      Foto: <input type="file" name="foto"><br>
      <img id="fotoPreviewPemasukan" src="" alt="Preview Foto" style="display:none; max-width:150px; margin-top:10px;"><br>

      <div style="text-align:right;">
        <button type="submit" style="background:#F4A261; color:white; border:none; padding:10px 20px; border-radius:10px; font-weight:600; cursor:pointer;">Simpan</button>
      </div>
    </form>

    <!-- Tombol close (x) -->
    <button onclick="document.getElementById('editModalPemasukan').style.display='none'" style="position:absolute; top:10px; right:15px; border:none; background:none; font-size:20px; font-weight:bold; cursor:pointer;">×</button>
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
@push('scripts')
    {!! $chartPemasukan->script() !!}
    {!! $chartPengeluaran->script() !!}
@endpush
@endsection