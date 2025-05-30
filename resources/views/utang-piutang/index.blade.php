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

<div class="container mx-auto p-4">
    
    {{-- Header & Tombol Tambah --}}
    <div class="d-flex justify-content-between align-items-center mb-4" style="margin-top: 50px;">
        <h2 class="fw-bold">Transaksi Utang-Piutang</h2>
        <button class="btn" style="background-color: #F4A261; color: white;" onclick="openModalTambah()">
            <i class="bi bi-plus-circle me-1"></i> Tambah
        </button> 
    </div>

    {{-- Flash Message --}}
    @if (session('success'))
        <div class="alert alert-info">{{ session('success') }}</div>
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
                <td>Rp {{ number_format($item->nominal, 0, ',', '.') }},-</td>
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
                            <i class="bi bi-trash"></i> Hapus </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


<div id="modalTambah" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.5); z-index:1000;">
  <div style="background:white; margin:100px auto; padding:20px 30px; width:450px; border-radius:10px; font-family:sans-serif; position:relative;">
    <h3 style="font-weight:600; font-size:18px; margin-bottom:20px;">Tambah Catatan Piutang</h3>
    <form method="POST" action="{{ route('store') }}">
      @csrf

      <!-- Jenis  -->
      <div style="display: flex; align-items: center; margin-bottom: 10px;">
        <label style="width: 120px;">Jenis:</label>
        <select name="jenis"
          style="flex: 1; border: 1px solid #ccc; border-radius: 5px; background-color: #f0f0f0; font-weight: 600; padding: 5px;" required>
       <option value="">-- Pilih --</option>
       <option value="Utang">Utang</option>
       <option value="Piutang">Piutang</option>
        </select>
      </div>

      <!-- Nominal -->
      <div style="display: flex; align-items: center; margin-bottom: 10px;">
        <label style="width: 120px;">Nominal:</label>
        <input type="number" name="nominal"
               style="flex: 1; border: none !important; border-bottom: 1px solid #ccc; background: transparent; font-weight: 500; outline: none;" required>
      </div>

       <!-- Bunga -->
      <div style="display: flex; align-items: center; margin-bottom: 10px;">
        <label style="width: 120px;">Bunga:</label>
        <input type="number" name="bunga"
               style="flex: 1; border: none !important; border-bottom: 1px solid #ccc; background: transparent; font-weight: 500; outline: none;">
      </div>

      <!-- Jatuh Tempo -->
      <div style="display: flex; align-items: center; margin-bottom: 10px;">
        <label style="width: 120px;">Jatuh Tempo:</label>
        <input type="date" name="jatuh_tempo"
               style="flex: 1; border: 1px solid #ccc; border-radius: 5px; background-color: #f0f0f0; font-weight: 600; padding: 5px;" required>
      </div>

      <!-- Status -->
      <div style="display: flex; align-items: center; margin-bottom: 10px;">
        <label style="width: 120px;">Status:</label>
        <select name="status"
                style="flex: 1; border: 1px solid #ccc; border-radius: 5px; background-color: #f0f0f0; font-weight: 600; padding: 5px;" required>
          <option value="">-- Pilih --</option>
          <option value="Belum Lunas">Belum Lunas</option>
          <option value="Lunas">Lunas</option>
        </select>
      </div>

      <!-- Tombol Simpan -->
      <div style="text-align:right; margin-top:15px;">
        <button type="submit"
                style="background:#F4A261; color:white; border:none; padding:7px 20px; border-radius:10px; font-weight:600; cursor:pointer;">Simpan</button>
      </div>
    </form>

    <!-- Tombol close -->
    <button onclick="closeModalTambah()" style="position:absolute; top:10px; right:15px; border:none; background:none; font-size:20px; font-weight:bold; cursor:pointer;">×</button>
  </div>
</div>

<script>
function openModalTambah() {
    document.getElementById('modalTambah').style.display = 'block';
}

function closeModalTambah() {
    document.getElementById('modalTambah').style.display = 'none';
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
