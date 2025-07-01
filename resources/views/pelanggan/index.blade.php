@<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->

    <link rel="stylesheet" href="{{ asset('assets/compiled/css/custom.css') }}">
<div class="container">
    <x-header></x-header>
    <x-navbar></x-navbar>
    <h2>Data Pelanggan</h2>
    <a href="{{ route('pelanggan.create') }}" class="btn btn-primary mb-2">Tambah Pelanggan</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>Nama</th>
            <th>No HP</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
        @foreach ($pelanggan as $p)
        <tr>
            <td>{{ $p->nama }}</td>
            <td>{{ $p->no_hp }}</td>
            <td>{{ $p->alamat }}</td>
            <td>
                <a href="{{ route('pelanggan.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('pelanggan.destroy', $p->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Yakin?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>

