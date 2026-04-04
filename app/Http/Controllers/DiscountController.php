<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Vouchers;
use App\Models\Product;
use App\Models\Products;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index()
    {
        $vouchers = Vouchers::latest()->paginate(20);
        $discounts = Discount::with('product')->latest()->paginate(20);
        // dd($discounts);
        return view('admin.vouchers.index', compact('vouchers', 'discounts'));
    }

    public function create()
    {
        $products = Products::doesntHave('discount')->get();
        return view('admin.discount.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'products_id' => 'required|exists:products,id|unique:discounts,products_id',
            'discount_type' => 'required|in:percentage,nominal',
            'discount_value' => 'required|integer|min:1',
            'valid_until' => 'required|date|after:today',
        ], [
            'products_id.unique' => 'Produk ini sudah memiliki diskon.',
            'valid_until.after' => 'Tanggal berlaku harus setelah hari ini.',
        ]);

        // dd($request->all());
        Discount::create($request->only([
            'products_id',
            'discount_type',
            'discount_value',
            'valid_until',
        ]));

        return redirect()->route('admin.vouchers.index')->with('success', 'Diskon berhasil disimpan.');
    }

    public function edit(Discount $discount)
    {
        $products = Products::where('id', $discount->product_id)
            ->orDoesntHave('discount')
            ->get();
        return view('admin.discounts.edit', compact('discount', 'products'));
    }

    public function update(Request $request, Discount $discount)
    {
        $request->validate([
            'products_id' => 'required|exists:products,id|unique:discounts,products_id,' . $discount->id,
            'discount_type' => 'required|in:percentage,nominal',
            'discount_value' => 'required|integer|min:1',
            'valid_until' => 'required|date|after:today',
        ], [
            'products_id.unique' => 'Produk ini sudah memiliki diskon.',
            'valid_until.after' => 'Tanggal berlaku harus setelah hari ini.',
        ]);

        $discount->update($request->only([
            'products_id',
            'discount_type',
            'discount_value',
            'valid_until',
        ]));

        return redirect()->route('admin.vouchers.index')->with('success', 'Diskon berhasil diperbarui.');
    }

    public function destroy(Discount $discount)
    {
        $discount->delete();
        return redirect()->route('admin.vouchers.index')->with('success', 'Diskon berhasil dihapus.');
    }
}
