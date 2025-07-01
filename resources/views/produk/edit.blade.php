<h1>Edit Produk</h1>
<form action="{{ route('produk.update', $produk->id) }}" method="POST">
  @csrf @method('PUT')
  Nama: <input type="text" name="nama" value="{{ $produk->nama }}"><br>
  Stok: <input type="number" name="stok" value="{{ $produk->stok }}"><br>
  Harga: <input type="number" name="harga" value="{{ $produk->harga }}"><br>
  <button type="submit">Update</button>
</form>
