@extends('layouts.appgreen')

@section('content')
<div class="container mx-auto p-4">

<div class="d-flex justify-content-between align-items-center mb-4" style="margin-top: 50px;">
    <h2 class="fw-bold text-white mb-0">Target Wangku</h2>
    <button class="btn" style="background-color: #F4A261; color: white;" type="button" onclick="openModalTambahTarget()">
        <i class="bi bi-plus-circle me-1"></i> Tambah 
    </button>
</div>




    @if($targets->isEmpty())
        <div class="alert alert-info">Belum ada target tabungan. Yuk tambahkan!</div>
    @else
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($targets as $target)
                <div class="col">
                    <div class="card h-100 shadow-sm">
<<<<<<< HEAD
                       <div class="card h-100 shadow-sm p-3">
    <div class="d-flex align-items-center">
        {{-- Gambar di kiri --}}
        <img src="{{ asset('storage/' . $target->gambar) }}" 
             alt="Target Image" 
             style="width: 120px; height: 120px; object-fit: cover; border-radius: 10px; margin-right: 15px;">
=======
                        <img src="{{ asset('storage/' . $target->gambar) }}" class="card-img-top" alt="Target Image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $target->nama_target }}</h5>
                            <p class="card-text">Target: Rp {{ number_format($target->jumlah_target, 0, ',', '.') }},-</p>
                            <p class="card-text">Terkumpul: Rp {{ number_format($target->jumlah_terkumpul, 0, ',', '.') }},-</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            
{{-- Modal Edit Target --}}
<button class="btn btn-warning btn-sm" 
    onclick="editTarget({{ $target->id }}, '{{ $target->nama_target }}', {{ $target->jumlah_target }}, {{ $target->jumlah_terkumpul }})">
    <i class="bi bi-pencil-fill"></i> Edit
</button>
>>>>>>> 0897911613d8a94a460143a4b8fc74e7452f3e03

        {{-- Info target di kanan --}}
        <div class="flex-grow-1">
            <h5 class="mb-1">{{ $target->nama_target }}</h5>
            <p class="mb-1">Target: Rp{{ number_format($target->jumlah_target, 0, ',', '.') }}</p>
            <p class="mb-2">Terkumpul: Rp{{ number_format($target->jumlah_terkumpul, 0, ',', '.') }}</p>

            {{-- Progress Bar --}}
            @php
                $progres = min(100, ($target->jumlah_terkumpul / max($target->jumlah_target, 1)) * 100);
            @endphp
            <div class="progress" style="height: 10px;">
            <div class="progress-bar bg-primary" role="progressbar" 
                    style="width: {{ $progres }}%;" 
                    aria-valuenow="{{ $progres }}" aria-valuemin="0" aria-valuemax="100">
                </div>
            </div>
        </div>
    </div>


                            
{{-- Modal Edit Target --}}
<div id="modalEditTarget" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.5); z-index:1000;">
  <div style="background:white; margin:100px auto; padding:20px 30px; width:500px; border-radius:10px; font-family:sans-serif; position:relative;">
    <h3 style="font-weight:600; font-size:18px; margin-bottom:20px;">Edit Target</h3>
    
    
    <form id="formEditTarget" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      {{-- Row: Nama Target --}}
      <div style="display:flex; align-items:center; margin-bottom:15px;">
        <label for="editNama" style="width:150px;">Nama Target:</label>
        <input type="text" name="nama" id="editNama" 
               style="flex:1; border: none !important; border-bottom:1px solid #ccc; background:transparent; font-weight:500; outline:none;" required>
      </div>

      {{-- Row: Nominal Target --}}
      <div style="display:flex; align-items:center; margin-bottom:15px;">
        <label for="editTarget" style="width:150px;">Nominal Target:</label>
        <input type="number" name="target" id="editTarget" 
               style="flex:1; border: none !important; border-bottom:1px solid #ccc; background:transparent; font-weight:500; outline:none;" required>
      </div>

      {{-- Row: Jumlah Terkumpul --}}
      <div style="display:flex; align-items:center; margin-bottom:15px;">
        <label for="editTerkumpul" style="width:150px;">Jumlah Terkumpul:</label>
        <input type="number" name="jumlah_terkumpul" id="editTerkumpul" 
               style="flex:1; border: none !important; border-bottom:1px solid #ccc; background:transparent; font-weight:500; outline:none;" required>
      </div>

      {{-- Row: Gambar --}}
      <div style="display:flex; align-items:center; margin-bottom:15px;">
        <label for="editGambar" style="width:150px;">Ganti Gambar:</label>
        <input type="file" name="gambar" id="editGambar" onchange="previewGambarEdit()"
               style="flex:1;">
      </div>

      {{-- Preview Gambar --}}
      <div style="text-align:center;">
        <img id="previewGambarEdit" src="" alt="Preview Gambar" 
             style="display:none; max-width:100%; margin-top:10px; border-radius:10px;">
      </div>

      {{-- Tombol --}}
      <div style="text-align:right; margin-top:20px;">
        <button type="submit" style="background:#F4A261; color:white; border:none; padding:7px 20px; border-radius:10px; font-weight:600;">Simpan</button>
      </div>
    </form>

    {{-- Tombol Close --}}
    <button onclick="closeModalTarget()" style="position:absolute; top:10px; right:15px; border:none; background:none; font-size:20px; font-weight:bold; cursor:pointer;">×</button>
  </div>
</div>

{{-- Script --}}
<script>
function editTarget(id, nama, target, terkumpul) {
    document.getElementById('editNama').value = nama;
    document.getElementById('editTarget').value = target;
    document.getElementById('editTerkumpul').value = terkumpul;

    document.getElementById('previewGambarEdit').style.display = 'none';
    document.getElementById('previewGambarEdit').src = '';

    document.getElementById('formEditTarget').action = '/target/' + id;
    document.getElementById('modalEditTarget').style.display = 'block';
}

function closeModalTarget() {
    document.getElementById('modalEditTarget').style.display = 'none';
}

function previewGambarEdit() {
    const input = document.getElementById('editGambar');
    const preview = document.getElementById('previewGambarEdit');

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>






<<<<<<< HEAD
{{-- Baris tombol Edit & Hapus di sebelah kanan --}}
<div class="d-flex justify-content-end gap-3 mt-3">
    <button class="btn text-primary p-0 border-0 fw-regular" onclick="editTarget({{ $target->id }})">
        Edit
    </button>

    <form action="{{ route('target.destroy', $target->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn text-primary p-0 border-0 fw-regular">
            Hapus
        </button>
    </form>
</div>


=======
                            {{-- Tombol Hapus --}}
                            <form action="{{ route('target.destroy', $target->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm d-flex align-items-center gap-1">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
>>>>>>> 0897911613d8a94a460143a4b8fc74e7452f3e03
                    </div>
                </div>
            
            @endforeach
        </div>
    @endif

    {{-- Banner Motivasi Nabung --}}
    <div class="w-100 mt-5 text-center">
        <img src="{{ asset('images/motivasi-nabung.png') }}" alt="Motivasi Nabung" 
             class="img-fluid" style="max-width: 1000px;">
    </div>
<<<<<<< HEAD

=======
</div>
</div>
>>>>>>> 0897911613d8a94a460143a4b8fc74e7452f3e03


<!-- Modal Tambah Target Tabungan -->
{{-- Modal Tambah Target Tabungan --}}
<div id="modalTambah" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.5); z-index:1000;">
  <div style="background:white; margin:100px auto; padding:20px 30px; width:450px; border-radius:10px; font-family:sans-serif; position:relative;">
    <h3 style="font-weight:600; font-size:18px; margin-bottom:20px;">Tambah Target Tabungan</h3>

    <form method="POST" action="{{ route('target.store') }}" enctype="multipart/form-data">
      @csrf

      <!-- Nama Target -->
       <div style="display: flex; align-items: center; margin-bottom: 10px;">
        <label style="width: 120px;">Nama Target:</label>
        <input type="text" name="nama_target"
               style="flex: 1; border: none !important; border-bottom: 1px solid #ccc; background: transparent; font-weight: 500; outline: none;" required>
      </div>

      <!-- Nominal Target -->
       <div style="display: flex; align-items: center; margin-bottom: 10px;">
        <label style="width: 120px;">Nominal Target:</label>
        <input type="number" name="jumlah_target"
               style="flex: 1; border: none !important; border-bottom: 1px solid #ccc; background: transparent; font-weight: 500; outline: none;" required>
      </div>

      <!-- Jumlah Terkumpul -->
       <div style="display: flex; align-items: center; margin-bottom: 10px;">
        <label style="width: 150px;">Jumlah Terkumpul: </label>
        <input type="number" name="jumlah_terkumpul"
               style="flex: 1; border: none !important; border-bottom: 1px solid #ccc; background: transparent; font-weight: 500; outline: none;" required>
      </div>

      <!-- Foto -->
      <input type="file" name="gambar"><br>
      <img id="fotoPreviewPengeluaran" src="" alt="Preview Foto" style="display:none; max-width:150px; margin-top:10px;"><br>

      <!-- Tombol Simpan -->
      <div style="text-align:right; margin-top:15px;">
        <button type="submit"
                style="background:#F4A261; color:white; border:none; padding:7px 20px; border-radius:10px; font-weight:600; cursor:pointer;">Simpan</button>
      </div>
    </form>

    <!-- Tombol Close -->
    <button onclick="closeModalTambahTarget()" style="position:absolute; top:10px; right:15px; border:none; background:none; font-size:20px; font-weight:bold; cursor:pointer;">×</button>
  </div>
</div>

<script>
function openModalTambahTarget() {
    document.getElementById('modalTambah').style.display = 'block';
}

function closeModalTambahTarget() {
    document.getElementById('modalTambah').style.display = 'none';
}
</script>
@endsection
