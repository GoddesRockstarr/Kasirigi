<?php

     namespace App\Http\Controllers;

     use App\Models\Pelanggan;
     use App\Models\Produk;
     use App\Models\Penjualan;
     use App\Models\PenjualanDetail;
     use Illuminate\Http\Request;
     use Illuminate\Support\Facades\DB;

     class PenjualanController extends Controller
     {
         public function index()
         {
             $penjualan = Penjualan::with('pelanggan')->get();
             $pelanggans = Pelanggan::all();
             $produks = Produk::all();
             return view('penjualan.index', compact('penjualan', 'pelanggans', 'produks'));
         }

         public function store(Request $request)
         {
             $request->validate([
                 'pelanggan_id' => 'required|exists:pelanggan,id',
                 'produks' => 'required|array',
                 'produks.*.id' => 'required|exists:produk,id',
                 'produks.*.quantity' => 'required|integer|min:1',
             ]);

             DB::beginTransaction();
             try {
                 $penjualan = Penjualan::create([
                     'pelanggan_id' => $request->pelanggan_id,
                     'total_price' => 0,
                     'sale_date' => now(),
                 ]);

                 $totalPrice = 0;
                 foreach ($request->produks as $produkData) {
                     $produk = Produk::find($produkData['id']);
                     if ($produk->stock < $produkData['quantity']) {
                         throw new \Exception("Stok produk {$produk->name} tidak cukup.");
                     }

                     PenjualanDetail::create([
                         'penjualan_id' => $penjualan->id,
                         'produk_id' => $produk->id,
                         'quantity' => $produkData['quantity'],
                         'price' => $produk->price,
                         'subtotal' => $produk->price * $produkData['quantity'],
                     ]);

                     $produk->decrement('stock', $produkData['quantity']);
                     $totalPrice += $produk->price * $produkData['quantity'];
                 }

                 $penjualan->update(['total_price' => $totalPrice]);
                 DB::commit();

                 return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil disimpan.');
             } catch (\Exception $e) {
                 DB::rollBack();
                 return redirect()->back()->with('error', 'Gagal menyimpan penjualan: ' . $e->getMessage());
             }
         }

         public function edit($id)
         {
             // Tambahkan logika edit jika diperlukan
             return view('penjualan.edit', ['penjualan' => Penjualan::findOrFail($id)]);
         }

         public function destroy($id)
         {
             $penjualan = Penjualan::findOrFail($id);
             $penjualan->delete();
             return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil dihapus.');
         }
     }