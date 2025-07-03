@extends('layouts.main')
@section('title', 'Tambah Pelanggan')
<x-header></x-header>
<x-navbar></x-navbar>
@section('content')
<div class="page-content">
    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Form Input Pelanggan</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal" action="{{ route('pelanggan.store') }}" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="nama-horizontal">Nama</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="nama-horizontal" class="form-control" name="nama" placeholder="Nama" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="nohp-horizontal">No HP</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="nohp-horizontal" class="form-control" name="no_hp" placeholder="No HP" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="alamat-horizontal">Alamat</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <textarea id="alamat-horizontal" class="form-control" name="alamat" rows="3" placeholder="Alamat" required></textarea>
                                        </div>
                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection