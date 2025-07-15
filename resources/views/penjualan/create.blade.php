@extends('layouts.main')
@section('title', 'Tambah Penjualan')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Form Input Penjualan</h4>
    </div>
    <div class="card-content">
        <div class="card-body">
            <form class="form form-horizontal" action="{{ route('penjualan.store') }}" method="POST" id="penjualan-form">
                @csrf
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="pelanggan-horizontal">Pelanggan</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <select id="pelanggan-horizontal" class="form-control" name="pelanggan_id">
                                <option value="">Umum</option>
                                @foreach ($pelanggans as $pelanggan)
                                    <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Items</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <div id="items-container">
                                <div class="item-row mb-3" data-index="0">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <select name="items[0][produk_id]" class="form-control produk-select" required>
                                                <option value="">Pilih Produk</option>
                                                @foreach ($produks as $produk)
                                                    <option value="{{ $produk->id }}" data-harga="{{ $produk->harga }}">{{ $produk->nama }} (Rp {{ number_format($produk->harga, 0, ',', '.') }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="number" name="items[0][jumlah]" class="form-control jumlah-input" placeholder="Jumlah" min="1" required>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control subtotal-input" placeholder="Subtotal" readonly>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-danger remove-item">X</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary mb-2" id="add-item">Tambah Item</button>
                        </div>
                        <div class="col-md-4">
                            <label for="total-harga-horizontal">Total Harga</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="total-harga-horizontal" class="form-control" name="total_harga" placeholder="Total Harga" readonly>
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

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    let itemIndex = 1;

    // Add new item row
    document.getElementById('add-item').addEventListener('click', function () {
        const container = document.getElementById('items-container');
        const newRow = document.createElement('div');
        newRow.className = 'item-row mb-3';
        newRow.dataset.index = itemIndex;
        newRow.innerHTML = `
            <div class="row">
                <div class="col-md-5">
                    <select name="items[${itemIndex}][produk_id]" class="form-control produk-select" required>
                        <option value="">Pilih Produk</option>
                        @foreach ($produks as $produk)
                            <option value="{{ $produk->id }}" data-harga="{{ $produk->harga }}">{{ $produk->nama }} (Rp {{ number_format($produk->harga, 0, ',', '.') }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="number" name="items[${itemIndex}][jumlah]" class="form-control jumlah-input" placeholder="Jumlah" min="1" required>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control subtotal-input" placeholder="Subtotal" readonly>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger remove-item">X</button>
                </div>
            </div>
        `;
        container.appendChild(newRow);
        itemIndex++;
        attachEventListeners();
    });

    // Remove item row
    function attachEventListeners() {
        document.querySelectorAll('.remove-item').forEach(button => {
            button.addEventListener('click', function () {
                if (document.querySelectorAll('.item-row').length > 1) {
                    this.closest('.item-row').remove();
                    calculateTotal();
                }
            });
        });

        document.querySelectorAll('.produk-select').forEach(select => {
            select.addEventListener('change', calculateSubtotal);
        });

        document.querySelectorAll('.jumlah-input').forEach(input => {
            input.addEventListener('input', calculateSubtotal);
        });
    }

    // Calculate subtotal for each row
    function calculateSubtotal() {
        const row = this.closest('.item-row');
        const select = row.querySelector('.produk-select');
        const jumlahInput = row.querySelector('.jumlah-input');
        const subtotalInput = row.querySelector('.subtotal-input');
        const harga = select.options[select.selectedIndex]?.dataset.harga || 0;
        const jumlah = jumlahInput.value || 0;
        const subtotal = harga * jumlah;
        subtotalInput.value = 'Rp ' + subtotal.toLocaleString('id-ID');
        calculateTotal();
    }

    // Calculate total harga
    function calculateTotal() {
        let total = 0;
        document.querySelectorAll('.subtotal-input').forEach(input => {
            const value = parseFloat(input.value.replace('Rp ', '').replace(/\./g, '').replace(',', '.')) || 0;
            total += value;
        });
        document.getElementById('total-harga-horizontal').value = 'Rp ' + total.toLocaleString('id-ID');
    }

    // Initial event listeners
    attachEventListeners();
});
</script>
@endsection