<!DOCTYPE html>
<html lang="en">
    @extends('layouts.main')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

    <!-- Custom CSS -->
      

    <x-header></x-header>
    <x-navbar></x-navbar>
    
<div class="container">
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


</body>
</html>