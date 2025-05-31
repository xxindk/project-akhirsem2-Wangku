<form action="{{ route('target.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="nama_target" class="form-label">Nama Target</label>
        <input type="text" class="form-control" id="nama_target" name="nama_target"
            value="{{ old('nama_target', $target->nama_target ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="jumlah_target" class="form-label">Jumlah Target (Rp)</label>
        <input type="number" class="form-control" id="jumlah_target" name="jumlah_target"
            value="{{ old('jumlah_target', $target->jumlah_target ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="jumlah_terkumpul" class="form-label">Jumlah Terkumpul (Rp)</label>
        <input type="number" class="form-control" id="jumlah_terkumpul" name="jumlah_terkumpul"
            value="{{ old('jumlah_terkumpul', $target->jumlah_terkumpul ?? 0) }}">
    </div>

    <div class="mb-3">
        <label for="gambar" class="form-label">Upload Gambar</label>
        <input type="file" class="form-control" id="gambar" name="gambar">
    </div>

    <div class="mb-3">
        <label for="catatan" class="form-label">Catatan</label>
        <textarea class="form-control" id="catatan" name="catatan" rows="3">{{ old('catatan', $target->catatan ?? '') }}</textarea>
    </div>

    <button type="submit" class="btn btn-warning">Simpan</button>
    <a href="{{ route('target.index') }}" class="btn btn-secondary">Batal</a>
</form>
