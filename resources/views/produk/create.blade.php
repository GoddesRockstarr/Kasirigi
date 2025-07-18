@extends('layouts.main')
@section('title', 'Tambah Produk')
<x-header></x-header>
<x-navbar></x-navbar>
    

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Form Input Produk</h4>
         @if($errors->any())
                            <div class="alert alert-danger alert-dismissible show fade">
                                <ul>
                                    @foreach($errors->all() as $pesan)
                                    <li>{{ $pesan }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
    </div>
    <div class="card-content">
        <div class="card-body">
            <form class="form form-horizontal" action="{{ route('produk.store') }}" method="POST">
                @csrf
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="nama-horizontal">Nama</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="nama-horizontal" class="form-control" name="nama" placeholder="Nama Produk" >
                        </div>
                        <div class="col-md-4">
                            <label for="stok-horizontal">Stok</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" id="stok-horizontal" class="form-control" name="stok" placeholder="Stok" >
                        </div>
                        <div class="col-md-4">
                            <label for="harga-horizontal">Harga</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" id="harga-horizontal" class="form-control" name="harga" placeholder="Harga" >
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
@endsection