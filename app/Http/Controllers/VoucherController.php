<?php

namespace App\Http\Controllers;

use App\Models\Vouchers;
use App\Models\Discount;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function index()
    {
        $vouchers = Vouchers::latest()->paginate(20);
        $discounts = Discount::with('product')->latest()->paginate(20);
        return view('admin.vouchers.index', compact('vouchers', 'discounts'));
    }

    public function create()
    {
        return view('admin.vouchers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|max:255|unique:vouchers,kode',
            'discount' => 'required|integer|min:0|max:100',
            'is_expired' => 'required|boolean',
        ]);

        Vouchers::create($request->only(['kode', 'discount', 'is_expired']));

        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher berhasil disimpan.');
    }

    public function edit(Vouchers $voucher)
    {
        return view('admin.vouchers.edit', compact('voucher'));
    }

    public function update(Request $request, Vouchers $voucher)
    {
        $request->validate([
            'kode' => 'required|string|max:255|unique:vouchers,kode,' . $voucher->id,
            'discount' => 'required|integer|min:0|max:100',
            'is_expired' => 'required|boolean',
        ]);

        $voucher->update($request->only(['kode', 'discount', 'is_expired']));

        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher berhasil diperbarui.');
    }

    public function destroy(Vouchers $voucher)
    {
        $voucher->delete();
        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher berhasil dihapus.');
    }
}
