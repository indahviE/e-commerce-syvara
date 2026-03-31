<?php

namespace App\Http\Controllers;

use App\Models\panduan_produk;
use App\Models\Products;
use Illuminate\Http\Request;

class PanduanProdukController extends Controller
{
    public function index()
    {
        $guides = panduan_produk::with('product')->latest()->paginate(20);
        return view('admin.guides.index', compact('guides'));
    }

    public function create()
    {
        $products = Products::all();
        return view('admin.guides.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:products,id',
            'frekuensi' => 'required|string|max:255',
            'cara_pakai' => 'required|string|max:1000',
            'waktu_terbaik' => 'required|string|max:255',
            'hasil' => 'required|string|max:1000',
        ]);

        panduan_produk::create($request->only(['produk_id', 'frekuensi', 'cara_pakai', 'waktu_terbaik', 'hasil']));

        return redirect()->route('admin.guides.index')->with('success', 'Panduan produk berhasil disimpan.');
    }

    public function edit(panduan_produk $guide)
    {
        $products = Products::all();
        return view('admin.guides.edit', compact('guide', 'products'));
    }

    public function update(Request $request, panduan_produk $guide)
    {
        $request->validate([
            'produk_id' => 'required|exists:products,id',
            'frekuensi' => 'required|string|max:255',
            'cara_pakai' => 'required|string|max:1000',
            'waktu_terbaik' => 'required|string|max:255',
            'hasil' => 'required|string|max:1000',
        ]);

        $guide->update($request->only(['produk_id', 'frekuensi', 'cara_pakai', 'waktu_terbaik', 'hasil']));

        return redirect()->route('admin.guides.index')->with('success', 'Panduan produk berhasil diperbarui.');
    }

    public function destroy(panduan_produk $guide)
    {
        $guide->delete();
        return redirect()->route('admin.guides.index')->with('success', 'Panduan produk berhasil dihapus.');
    }
}
