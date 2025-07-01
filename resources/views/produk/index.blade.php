<!DOCTYPE html>
<html>
<head>
    <title>Data Produk</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/iconly.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/custom.css') }}">
</head>
<body>
    <x-header></x-header>
    <x-navbar></x-navbar> <!-- Sidebar included here -->
    <div class="container mt-4">
        <a href="{{ route('produk.create') }}" class="btn btn-primary mb-3">+ Tambah Produk</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped table-responsive">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produk as $item)
                <tr>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->stok }}</td>
                    <td>{{ $item->harga }}</td>
                    <td>
                        <a href="{{ route('produk.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('produk.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin mau hapus produk ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>