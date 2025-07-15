<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
     public function index()
    {
        $pelanggan = Pelanggan::all();
        return view('pelanggan.index', compact('pelanggan'));
    }

    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'no_hp' => 'required|digits_between:10,13',
        ],[
            'nama.required' => "Nama wajib diisi",
            'nama.string' => "nama wajib berupa string",
        ]);
        try{
        Pelanggan::create($request->all());
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan ditambahkan!');

        }catch(\Exception $e){
            return redirect()->back()->withInput()->withErrors(['submit' => 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.']);
        };
    }

    public function edit(Pelanggan $pelanggan)
    {
        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $pelanggan->update($request->all());
        return redirect()->route('pelanggan.index')->with('success', 'Data diperbarui!');
    }

    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan dihapus!');
    }
}
