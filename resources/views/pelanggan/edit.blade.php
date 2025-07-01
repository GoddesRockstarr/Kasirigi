@extends('layouts.main')
@section('content')
<div class="container">
    <h2>Edit Pelanggan</h2>
    <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-2">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $pelanggan->nama }}">
        </div>
        <div class="mb-2">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" value="{{ $pelanggan->no_hp }}">
        </div>
        <div class="mb-2">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control">{{ $pelanggan->alamat }}</textarea>
        </div>
        <button class="btn btn-success">Update</button>
    </form>
</div>

