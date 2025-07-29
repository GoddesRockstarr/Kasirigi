<!DOCTYPE html>
<html lang="en">
    @extends('layouts.main')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjualan - Kasir</title>
</head>
<body>
    <x-header></x-header>
    <x-navbar></x-navbar>

    <div class="container">
        <h2>Data Penjualan</h2>
        <div class="mb-3">
            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#tambahPenjualanModal">Tambah Penjualan</button>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <table class="table table-bordered table-striped table-responsive" id="penjualanTable">
            <thead>
                <tr>
                    <th>Pelanggan</th>
                    <th>Total Harga</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penjualan as $p)
                <tr>
                    <td>{{ $p->pelanggan->name }}</td>
                    <td>{{ number_format($p->total_price, 0, ',', '.') }}</td>
                    <td>{{ $p->sale_date }}</td>
                    <td>
                        <a href="{{ route('penjualan.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('penjualan.destroy', $p->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

   <!-- Modal Tambah Penjualan -->
<div class="modal fade" id="tambahPenjualanModal" tabindex="-1" aria-labelledby="tambahPenjualanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPenjualanModalLabel">Tambah Penjualan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('penjualan.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="pelanggan_id" class="form-label">Pelanggan</label>
                        <select name="pelanggan_id" id="pelanggan_id" class="form-select" required>
                            <option value="">Pilih Pelanggan</option>
                            @foreach ($pelanggans as $pelanggan)
                                <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Produk</label>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="produk-rows">
                                <tr>
                                    <td>
                                        <select name="produks[0][id]" class="form-select produk-select" required>
                                            <option value="">Pilih Produk</option>
                                            @foreach ($produks as $produk)
                                                <option value="{{ $produk->id }}" data-price="{{ $produk->harga }}">{{ $produk->nama }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="produk-price"></td>
                                    <td>
                                        <input type="number" name="produks[0][quantity]" class="form-control quantity" min="1" required>
                                    </td>
                                    <td class="subtotal">0</td>
                                    <td><button type="button" class="btn btn-danger btn-sm remove-row">Hapus</button></td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-primary mt-2" id="add-produk">Tambah Produk</button>
                    </div>

                    <div class="mb-3">
                        <h5>Total: <span id="total-price" class="badge bg-danger">0</span></h5>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan Penjualan</button>
                </form>
            </div>
        </div>
    </div>
</div>



    <script src="{{ asset('mazer/assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('mazer/assets/js/app.js') }}"></script>
    <script src="{{ asset('mazer/assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('mazer/assets/extensions/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('mazer/assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('mazer/assets/js/pages/datatables.js') }}"></script>
   <script>
    let rowIndex = 1;

    document.getElementById('add-produk').addEventListener('click', function () {
        const tbody = document.getElementById('produk-rows');
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
                <select name="produks[${rowIndex}][id]" class="form-select produk-select" required>
                    <option value="">Pilih Produk</option>
                    @foreach ($produks as $produk)
                        <option value="{{ $produk->id }}" data-price="{{ $produk->harga }}">{{ $produk->nama }}</option>
                    @endforeach
                </select>
            </td>
            <td class="produk-price"></td>
            <td>
                <input type="number" name="produks[${rowIndex}][quantity]" class="form-control quantity" min="1" required>
            </td>
            <td class="subtotal">0</td>
            <td><button type="button" class="btn btn-danger btn-sm remove-row">Hapus</button></td>
        `;
        tbody.appendChild(row);
        rowIndex++;
        attachEventListeners();
        updateTotalPrice();
    });

    function attachEventListeners() {
        document.querySelectorAll('.produk-select').forEach(select => {
            select.addEventListener('change', function () {
                const price = parseFloat(this.options[this.selectedIndex].getAttribute('data-price')) || 0;
                const row = this.closest('tr');
                row.querySelector('.produk-price').textContent = price.toLocaleString('id-ID');
                updateSubtotal(row);
                updateTotalPrice();
            });
        });

        document.querySelectorAll('.quantity').forEach(input => {
            input.addEventListener('input', function () {
                const row = this.closest('tr');
                updateSubtotal(row);
                updateTotalPrice();
            });
        });

        document.querySelectorAll('.remove-row').forEach(button => {
            button.addEventListener('click', function () {
                this.closest('tr').remove();
                updateTotalPrice();
            });
        });
    }

    function updateSubtotal(row) {
        const select = row.querySelector('.produk-select');
        const price = parseFloat(select.options[select.selectedIndex].getAttribute('data-price')) || 0;
        const quantity = parseInt(row.querySelector('.quantity').value) || 0;
        const subtotal = price * quantity;
        row.querySelector('.subtotal').textContent = subtotal.toLocaleString('id-ID');
    }

    function updateTotalPrice() {
        let total = 0;
        document.querySelectorAll('.subtotal').forEach(subtotal => {
            total += parseFloat(subtotal.textContent.replace(/[^\d.-]/g, '')) || 0;
        });
        document.getElementById('total-price').textContent = total.toLocaleString('id-ID');
    }

    attachEventListeners();
</script>
</body>
</html>