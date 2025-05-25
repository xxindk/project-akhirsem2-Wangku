@extends('layouts.appgreen')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-white">Target Wangku</h2>
<<<<<<< HEAD
        
=======
>>>>>>> 5c365eb (Simpan perubahan lokal sebelum pull)
        {{-- Tombol modal versi dengan ikon dan styling tambahan --}}
        <div class="text-end mb-3">
            <button type="button" onclick="openModal()" class="btn text-white fw-semibold" style="background:#F4A261;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-plus-circle me-1"></i>
                    <span>Tambah</span>
                </div>
            </button>
        </div>
    </div>

    @if($targets->isEmpty())
        <div class="alert alert-info">Belum ada target tabungan. Yuk tambahkan!</div>
    @else
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($targets as $target)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('storage/' . $target->gambar) }}" class="card-img-top" alt="Target Image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $target->nama_target }}</h5>
                            <p class="card-text">Target: Rp{{ number_format($target->jumlah_target, 0, ',', '.') }}</p>
                            <p class="card-text">Terkumpul: Rp{{ number_format($target->jumlah_terkumpul, 0, ',', '.') }}</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            {{-- Tombol Edit --}}
                            <a href="{{ route('target.edit', $target->id) }}" class="btn btn-warning btn-sm d-flex align-items-center gap-1">
                                <i class="bi bi-pencil-fill"></i> Edit
                            </a>

                            {{-- Tombol Hapus --}}
                            <form action="{{ route('target.destroy', $target->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm d-flex align-items-center gap-1">
                                    <i class="bi bi-trash-fill"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Banner Motivasi Nabung --}}
    <div class="mt-5 text-center">
        <img src="{{ asset('images/motivasi-nabung.png') }}" alt="Motivasi Nabung" class="img-fluid" style="max-width: 100%;">
    </div>
</div>

{{-- Modal Overlay --}}
<div id="overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; 
    background-color: rgba(0, 0, 0, 0.5); z-index: 999;">
</div>

{{-- Modal Content --}}
<div id="modalForm" class="position-fixed top-50 start-50 translate-middle bg-white p-4 rounded shadow" 
     style="display: none; z-index: 1000; width: 400px;">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Tambah Target Baru</h5>
        <button class="btn-close" onclick="closeModal()"></button>
    </div>
    <form action="{{ route('target.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Target:</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="target" class="form-label">Nominal Target:</label>
            <input type="number" name="target" class="form-control" required>
        </div>
        <div class="mb-3">
    <label for="jumlah_terkumpul" class="form-label">Jumlah Terkumpul:</label>
    <input type="number" name="jumlah_terkumpul" class="form-control" required min="0">
         </div>
        <div class="mb-3">
            <label for="gambar" class="form-label">Upload Foto:</label>
            <input type="file" name="gambar" class="form-control">
        </div>
        <button type="submit" class="btn btn-warning text-white">Simpan</button>
    </form>
</div>

<script>
    function openModal() {
        document.getElementById('modalForm').style.display = 'block';
        document.getElementById('overlay').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('modalForm').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
    }

    // Opsional: tutup modal kalau klik luar
    document.getElementById('overlay').addEventListener('click', closeModal);
</script>

@endsection
