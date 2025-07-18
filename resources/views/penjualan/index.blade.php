<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjualan - Kasir</title>
    <link rel="stylesheet" href="{{ asset('mazer/dist/assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('mazer/dist/assets/extensions/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('mazer/dist/assets/css/shared/iconly.css') }}">
</head>
<body>
    <div id="app">
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>Form Penjualan</h3>
            </div>

            <div class="page-content">
                <section class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Tambah Penjualan</h4>
                            </div>
                            <div class="card-body">
                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif

                                <form action="{{ route('penjualan.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="customer_id" class="form-label">Pelanggan</label>
                                        <select name="customer_id" id="customer_id" class="form-select" required>
                                            <option value="">Pilih Pelanggan</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Produk</label>
                                        <table class="table table-bordered" id="product-table">
                                            <thead>
                                                <tr>
                                                    <th>Produk</th>
                                                    <th>Harga</th>
                                                    <th>Jumlah</th>
                                                    <th>Subtotal</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="product-rows">
                                                <tr>
                                                    <td>
                                                        <select name="products[0][id]" class="form-select product-select" required>
                                                            <option value="">Pilih Produk</option>
                                                            @foreach ($products as $product)
                                                                <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td class="product-price">0</td>
                                                    <td>
                                                        <input type="number" name="products[0][quantity]" class="form-control quantity" min="1" required>
                                                    </td>
                                                    <td class="subtotal">0</td>
                                                    <td><button type="button" class="btn btn-danger remove-row">Hapus</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <button type="button" class="btn btn-primary mt-2" id="add-product">Tambah Produk</button>
                                    </div>

                                    <div class="mb-3">
                                        <h5>Total: <span id="total-price">0</span></h5>
                                    </div>

                                    <button type="submit" class="btn btn-success">Simpan Penjualan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <script src="{{ asset('mazer/dist/assets/js/app.js') }}"></script>
    <script src="{{ asset('mazer/dist/assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script>
        let rowIndex = 1;

        document.getElementById('add-product').addEventListener('click', function () {
            const tbody = document.getElementById('product-rows');
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>
                    <select name="products[${rowIndex}][id]" class="form-select product-select" required>
                        <option value="">Pilih Produk</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td class="product-price">0</td>
                <td>
                    <input type="number" name="products[${rowIndex}][quantity]" class="form-control quantity" min="1" required>
                </td>
                <td class="subtotal">0</td>
                <td><button type="button" class="btn btn-danger remove-row">Hapus</button></td>
            `;
            tbody.appendChild(row);
            rowIndex++;
            attachEventListeners();
            updateTotalPrice();
        });

        function attachEventListeners() {
            document.querySelectorAll('.product-select').forEach(select => {
                select.addEventListener('change', function () {
                    const price = this.options[this.selectedIndex].getAttribute('data-price');
                    const row = this.closest('tr');
                    row.querySelector('.product-price').textContent = price || 0;
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
            const price = parseFloat(row.querySelector('.product-price').textContent);
            const quantity = parseInt(row.querySelector('.quantity').value) || 0;
            const subtotal = price * quantity;
            row.querySelector('.subtotal').textContent = subtotal;
        }

        function updateTotalPrice() {
            let total = 0;
            document.querySelectorAll('.subtotal').forEach(subtotal => {
                total += parseFloat(subtotal.textContent) || 0;
            });
            document.getElementById('total-price').textContent = total;
        }

        attachEventListeners();
    </script>
</body>
</html>