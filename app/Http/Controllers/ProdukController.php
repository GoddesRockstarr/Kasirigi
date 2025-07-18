<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
   public function index() {
        $produk = Produk::all();
        if ($produk->isEmpty()) {
        \Log::info('No products found in the database.');
    } else {
        \Log::info('Products fetched:', $produk->toArray());
    }
        return view('produk.index', compact('produk'));
        
    }

    public function create() {
        return view('produk.create');
    }

    public function store(Request $request) {

        $request->validate([
            'nama' => 'required|string',
            'harga' => 'required|'
        ],[
            'nama.required' => "nama produk wajib diisi",
            'harga.required' => "Harga wajib diisi"
        ]);   

        Produk::create($request->all());
        return redirect()->route('produk.index')->with('success', 'Produk ditambahkan!');
    }

    public function edit(Produk $produk) {
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, Produk $produk) {
        $produk->update($request->all());
        return redirect()->route('produk.index')->with('success', 'Produk diupdate!');
    }

    public function destroy(Produk $produk) {
        $produk->delete();
        return redirect()->route('produk.index')->with('success', 'Produk dihapus!');
    }
}
