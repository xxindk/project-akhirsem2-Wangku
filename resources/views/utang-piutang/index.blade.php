@extends('layouts.appgreen') 

@section('content')

<style>
    h2.fw-bold {
        color: white;
    }

    thead.table-header th {
        background-color: #F4A261;
        color: white;
    }

    table th, table td {
        vertical-align: middle;
    }
</style>

<div class="container">
    
    {{-- Header & Tombol Tambah --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Transaksi Utang-Piutang</h2>
        <button class="btn" style="background-color: #F4A261; color: white;" onclick="openModalTambah()">
            <i class="bi bi-plus-circle me-1"></i> Tambah
        </button> 
    </div>

    {{-- Flash Message --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tabel Data --}}
    <table class="table table-bordered text-center">
        <thead class="table-header">
            <tr>
                <th>Jenis</th>
                <th>Nominal</th>
                <th>Bunga</th>
                <th>Jatuh Tempo</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{ $item->jenis }}</td>
                <td>Rp{{ number_format($item->nominal, 0, ',', '.') }},-</td>
                <td>
                    @if ($item->bunga)
                    Rp {{ number_format($item->bunga, 0, ',', '.') }},-
                    @else
                        -
                    @endif
                </td>
                <td>{{ \Carbon\Carbon::parse($item->jatuh_tempo)->format('d/m/Y') }}</td>
                <td>{{ $item->status }}</td>
                <td>
                    <button class="btn btn-sm btn-warning me-1" onclick="editTransaksi({{ $item->id }})">
                    <i class="bi bi-pencil-square"></i> Edit </button>

                    <form action="{{ url('/transaksi-utang-piutangs/' . $item->id) }}" method="POST" style="display:inline-block">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin mau hapus?')">
                            <i class="bi bi-trash-fill"></i> Hapus </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


<!-- Modal --><!-- MODAL OVERLAY -->
<div id="overlay" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background-color:rgba(0,0,0,0.5); z-index:1000; justify-content: center; align-items: center;">
  
  <!-- MODAL CONTENT -->
  <div id="modalTambah"
       style="background:white; padding:25px 35px; width:480px; border-radius:15px; font-family:sans-serif; position:relative; box-shadow: 0 8px 20px rgba(0,0,0,0.3);">

    <!-- Tombol Close -->
    <button onclick="closeModalTambah()"
            style="position:absolute; top:10px; right:15px; border:none; background:none; font-size:22px; font-weight:bold; cursor:pointer;">×</button>

    <!-- Judul Modal -->
    <h4 style="font-weight:600; font-size:20px; margin-bottom:25px;">Tambah Catatan Piutang</h4>

    <!-- FORM TAMBAH -->
    <form method="POST" action="{{ route('reminders.store') }}">
      @csrf

      <!-- Jenis Tagihan -->
      <div style="display: flex; align-items: center; margin-bottom: 15px;">
        <label style="width: 130px; font-weight: 500;">Jenis Tagihan:</label>
        <input type="text" name="jenis" required 
          style="flex: 1; padding: 5px 8px; border: none; border-bottom: 1px solid #ccc; background: transparent; outline: none;">
      </div>

      <!-- Nominal -->
      <div style="display: flex; align-items: center; margin-bottom: 15px;">
        <label style="width: 130px; font-weight: 500;">Nominal:</label>
        <input type="number" name="nominal" required 
          style="flex: 1; padding: 5px 8px; border: none; border-bottom: 1px solid #ccc; background: transparent; outline: none;">
      </div>

      <!-- Bunga -->
      <div style="display: flex; align-items: center; margin-bottom: 15px;">
        <label style="width: 130px; font-weight: 500;">Bunga:</label>
        <input type="number" name="bunga" step="0.01" required 
          style="flex: 1; padding: 5px 8px; border: none; border-bottom: 1px solid #ccc; background: transparent; outline: none;">
      </div>

      <!-- Jatuh Tempo -->
      <div style="display: flex; align-items: center; margin-bottom: 15px;">
        <label style="width: 130px; font-weight: 500;">Jatuh Tempo:</label>
        <input type="date" name="jatuh_tempo" required 
          style="flex: 1; padding: 5px 8px; border: none; border-bottom: 1px solid #ccc; background: transparent; outline: none;">
      </div>

      <!-- Status -->
      <div style="display: flex; align-items: center; margin-bottom: 25px;">
        <label style="width: 130px; font-weight: 500;">Status:</label>
        <select name="status" required 
          style="flex: 1; padding: 5px 8px; border: none; border-bottom: 1px solid #ccc; background: transparent; outline: none;">
          <option value="Belum Lunas">Belum Lunas</option>
          <option value="Lunas">Lunas</option>
        </select>
      </div>

      <!-- Tombol Simpan -->
      <div style="text-align: right;">
        <button type="submit" 
          style="background-color: #F4A261; color: white; font-weight: bold; padding: 8px 20px; border: none; border-radius: 6px; cursor: pointer;">
          Simpan
        </button>
      </div>
    </form>
  </div>
</div>

<!-- SCRIPT MODAL -->
<script>
  function openModalTambah() {
    document.getElementById('overlay').style.display = 'flex';
  }

  function closeModalTambah() {
    document.getElementById('overlay').style.display = 'none';
  }

  // Tutup modal kalau klik di luar konten
  window.onclick = function(event) {
    const overlay = document.getElementById('overlay');
    const modal = document.getElementById('modalTambah');
    if (event.target === overlay) {
      overlay.style.display = "none";
    }
  }
</script>



{{-- Modal Edit --}}
<div id="modalEdit" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.5); z-index:1000;">
  <div style="background:white; margin:100px auto; padding:20px 30px; width:400px; border-radius:10px; font-family:sans-serif; position:relative;">
    <h3 style="font-weight:600; font-size:18px; margin-bottom:15px;">Edit Transaksi</h3>
    <form id="formEdit" method="POST">
      @csrf
      @method('PUT')

      <label>Jenis:</label>
      <input type="text" name="jenis" id="editJenis" 
             style="border: none !important; border-bottom: 1px solid #ccc; background: transparent; font-weight: 500; outline: none;" required>
      <br>

      <label>Nominal:</label>
      <input type="number" name="nominal" id="editNominal" 
             style="border: none !important; border-bottom: 1px solid #ccc; background: transparent; font-weight: 500; outline: none;" required>
      <br>

      <label>Bunga:</label>
      <input type="number" step="0.01" name="bunga" id="editBunga" 
             style="border: none !important; border-bottom: 1px solid #ccc; background: transparent; font-weight: 500; outline: none;">
      <br>

      <label>Jatuh Tempo:</label>
      <input type="date" name="jatuh_tempo" id="editJatuhTempo" 
             class="w-full border rounded p-2" style="background-color: #f0f0f0; font-weight: 600;" required>
      <br>

      <label>Status:</label>
      <select name="status" id="editStatus" class="w-full border rounded p-2" 
              style="background-color: #f0f0f0; font-weight: 600;" required>
        <option value="">-- Pilih --</option>
        <option value="Belum Lunas">Belum Lunas</option>
        <option value="Lunas">Lunas</option>
      </select>
      <br>

      <div style="text-align:right; margin-top:15px;">
        <button type="submit" style="background:#F4A261; color:white; border:none; padding:7px 20px; border-radius:10px; font-weight:600; cursor:pointer;">Simpan</button>
      </div>
    </form>

    <!-- Tombol close -->
    <button onclick="closeModalEdit()" style="position:absolute; top:10px; right:15px; border:none; background:none; font-size:20px; font-weight:bold; cursor:pointer;">×</button>
  </div>
</div>

@endsection

@push('scripts')
<script>
function editTransaksi(id) {
    fetch('/transaksi-utang-piutangs/' + id + '/edit')
        .then(res => res.json())
        .then(data => {
            document.getElementById('editJenis').value = data.jenis;
            document.getElementById('editNominal').value = data.nominal ?? '';
            document.getElementById('editBunga').value = data.bunga ?? '';
            document.getElementById('editJatuhTempo').value = data.jatuh_tempo;
            document.getElementById('editStatus').value = data.status;

            document.getElementById('formEdit').action = '/transaksi-utang-piutangs/' + id;
            document.getElementById('modalEdit').style.display = 'block';
        });
}

function closeModalEdit() {
    document.getElementById('modalEdit').style.display = 'none';
}
</script>
@endpush
