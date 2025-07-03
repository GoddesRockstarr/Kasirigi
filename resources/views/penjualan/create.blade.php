@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Transaksi Baru</h2>
    <form action="{{ route('penjualan.store') }}" method="POST">
        @csrf
        <div class="mb-2">
            <label>Pelanggan</label>
            <select name="pelanggan_id" class="form-control">
                <option value="">Umum</option>
                @foreach ($pelanggan as $p)
                    <option value="{{ $p->id }}">{{ $p->nama }}</option>
                @endforeach
            </select>
        </div>

        <table class="table" id="produk-table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th><button type="button" onclick="tambahRow()" class="btn btn-sm btn-primary">+</button></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select name="produk_id[]" class="form-control" onchange="hitungSubtotal(this)">
                            @foreach ($produk as $p)
                                <option value="{{ $p->id }}" data-harga="{{ $p->harga }}">{{ $p->nama }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="jumlah[]" class="form-control" oninput="hitungSubtotal(this)" value="1"></td>
                    <td><input type="number" name="subtotal[]" class="form-control" readonly></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <button class="btn btn-success">Simpan Transaksi</button>
    </form>
</div>

<script>
function hitungSubtotal(el) {
    let row = el.closest('tr');
    let select = row.querySelector('select');
    let harga = select.options[select.selectedIndex].dataset.harga;
    let jumlah = row.querySelector('input[name="jumlah[]"]').value;
    let subtotal = row.querySelector('input[name="subtotal[]"]');
    subtotal.value = harga * jumlah;
}

function tambahRow() {
    let table = document.querySelector('#produk-table tbody');
    let newRow = table.rows[0].cloneNode(true);
    newRow.querySelectorAll('input').forEach(input => input.value = '');
    table.appendChild(newRow);
}
</script>
@endsection
