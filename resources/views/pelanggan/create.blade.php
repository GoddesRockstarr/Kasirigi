

<div class="container">
    <h2>Tambah Pelanggan</h2>
    <form action="{{ route('pelanggan.store') }}" method="POST">
        @csrf
        <div class="mb-2">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control">
        </div>
        <div class="mb-2">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control">
        </div>
        <div class="mb-2">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control"></textarea>
        </div>
        <button class="btn btn-success">Simpan</button>
    </form>
</div>
