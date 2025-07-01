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
    <x-navbar></x-navbar> 
<h1>Tambah Produk</h1>
<form action="{{ route('produk.store') }}" method="POST">
  @csrf
  Nama: <input type="text" name="nama"><br>
  Stok: <input type="number" name="stok"><br>
  Harga: <input type="number" name="harga"><br>
  <button type="submit">Simpan</button>
</form>
</body>
</html>