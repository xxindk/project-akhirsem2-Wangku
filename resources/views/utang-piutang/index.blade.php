@extends('layouts.appgreen') 

@section('content')
<div class="container">
    
    {{-- Header & Tombol Tambah --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Transaksi Utang-Piutang</h2>
        <button class="btn" style="background-color: #F47C46; color: white;" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="bi bi-plus-circle me-1"></i> Tambah
        </button>
    </div>

    {{-- Flash Message --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tabel Data --}}
    <table class="table table-bordered text-center">
        <thead style="background-color: #F47C46; color: white;">
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

{{-- Modal Tambah --}}
<div class="modal fade" id="modalTambah" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" method="POST" action="{{ url('/transaksi-utang-piutangs') }}">
        @csrf
        <div class="modal-header">
            <h5 class="modal-title">Tambah Transaksi</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            @include('utang-piutang.form')
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
  </div>
</div>

{{-- Modal Edit --}}
<div class="modal fade" id="modalEdit" tabindex="-1">
  <div class="modal-dialog">
    <form id="formEdit" class="modal-content" method="POST">
        @csrf @method('PUT')
        <div class="modal-header">
            <h5 class="modal-title">Edit Transaksi</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            @include('utang-piutang.form')
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success">Update</button>
        </div>
    </form>
  </div>
</div>

@endsection

@push('scripts')
<script>
function editTransaksi(id) {
    fetch('/transaksi-utang-piutangs/' + id + '/edit')
        .then(res => res.json())
        .then(data => {
            document.querySelector('#modalEdit [name=jenis]').value = data.jenis;
            document.querySelector('#modalEdit [name=nominal]').value = data.nominal;
            document.querySelector('#modalEdit [name=bunga]').value = data.bunga ?? '';
            document.querySelector('#modalEdit [name=jatuh_tempo]').value = data.jatuh_tempo;
            document.querySelector('#modalEdit [name=status]').value = data.status;

            document.getElementById('formEdit').action = '/transaksi-utang-piutangs/' + id;
            new bootstrap.Modal(document.getElementById('modalEdit')).show();
        });
}
</script>
@endpush
