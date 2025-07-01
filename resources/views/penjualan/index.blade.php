
<div class="container">
    <h2>Riwayat Penjualan</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Total Harga</th>
                <th>Detail Barang</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penjualan as $p)
            <tr>
                <td>{{ $p->created_at->format('d-m-Y H:i') }}</td>
                <td>{{ $p->pelanggan->nama ?? 'Umum' }}</td>
                <td>Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
                <td>
                    <ul>
                        @foreach ($p->items as $item)
                            <li>{{ $item->produk->nama }} x {{ $item->jumlah }} = Rp {{ number_format($item->subtotal, 0, ',', '.') }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

