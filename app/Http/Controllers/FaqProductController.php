<?php

namespace App\Http\Controllers;

use App\Models\faq_product;
use App\Models\Products;
use Illuminate\Http\Request;

class FaqProductController extends Controller
{
    public function index()
    {
        $faqs = faq_product::with('product')->latest()->paginate(20);
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        $products = Products::all();
        return view('admin.faqs.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:products,id',
            'pertanyaan' => 'required|string|max:255',
            'jawaban' => 'required|string|max:1000',
        ]);

        faq_product::create($request->only(['produk_id', 'pertanyaan', 'jawaban']));

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ produk berhasil disimpan.');
    }

    public function edit(faq_product $faq)
    {
        $products = Products::all();
        return view('admin.faqs.edit', compact('faq', 'products'));
    }

    public function update(Request $request, faq_product $faq)
    {
        $request->validate([
            'produk_id' => 'required|exists:products,id',
            'pertanyaan' => 'required|string|max:255',
            'jawaban' => 'required|string|max:1000',
        ]);

        $faq->update($request->only(['produk_id', 'pertanyaan', 'jawaban']));

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ produk berhasil diperbarui.');
    }

    public function destroy(faq_product $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ produk berhasil dihapus.');
    }
}
