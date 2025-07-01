<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualan = Penjualan::with('items.produk')->latest()->get();
        return view('penjualan.index', compact('penjualan'));
    }

    public function create()
    {
        $produk = Produk::all();
        $pelanggan = Pelanggan::all();
        return view('penjualan.create', compact('produk', 'pelanggan'));
    }

    public function store(Request $request)
    {
        $penjualan = Penjualan::create([
            'pelanggan_id' => $request->pelanggan_id,
            'total_harga' => array_sum($request->subtotal),
        ]);

        foreach ($request->produk_id as $key => $produk_id) {
            PenjualanItem::create([
                'penjualan_id' => $penjualan->id,
                'produk_id' => $produk_id,
                'jumlah' => $request->jumlah[$key],
                'subtotal' => $request->subtotal[$key],
            ]);
        }

        return redirect()->route('penjualan.index')->with('success', 'Transaksi berhasil disimpan!');
    }
}
