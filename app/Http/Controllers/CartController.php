<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Tampilkan halaman 
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();

        // kalau belum punya cart, kembalikan keranjang kosong
        if (!$cart) {
            return view('cart_view', ['products' => []]);
        }

        $cartDetails = CartDetail::where('cart_id', $cart->id)
            ->with('product.category') // eager load relasi product
            ->get();

        // ambil product nya aja (fungsi map.js di laravl)
        $products = $cartDetails->pluck('product');

        return view('cart_view', ['products' => $products]);
    }
    // Tampilkan halaman
    public function history()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $orders = Orders::where('user_id', Auth::id())
            ->with([
                'orderDetails.product.category',
                'voucher'
            ])
            ->latest()
            ->when(request('status'), fn($q, $s) => $q->where('status_order', $s))
            ->paginate(10);

        // dd($orders);
        return view('history_view', ['orders' => $orders]);
    }

    public function cart_add_product(Request $request)
    {

        if (!Auth::check()) {
            // return redirect('/login');

            return response()->json(['success' => false, 'message' => 'UnAuth'], 400);
        }

        $cart = Cart::where('user_id', Auth::user()->id)->first();
        if (!$cart) $cart = Cart::create(['user_id' => Auth::user()->id]);

        //cek udah ada blm produk ini dikeranjang user
        $isHasItemOnCart = CartDetail::where('product_id', $request->id_produk)->where('cart_id', $cart->id)->first();

        if ($isHasItemOnCart) {
            return response()->json(['success' => false, 'message' => 'Aksi berhenti. Barang sudah ada dikeranjangmu!'], 500);
        }

        CartDetail::create(['product_id' => $request->id_produk, 'cart_id' => $cart->id]);

        // logic tambah ke cart...

        return response()->json(['success' => true, 'message' => 'Berhasil masuk ke keranjang!'], 200);
    }

    public function cart_remove_product(Request $request, $produk_id)
    {
        if (!Auth::check()) {
            // return redirect('/login');
            return response()->json(['success' => false, 'message' => 'UnAuth'], 400);
        }

        $cart = Cart::where('user_id', Auth::user()->id)->first();
        CartDetail::where('cart_id', $cart->id)->where('product_id', $produk_id)->delete();

        //  return redirect('/my-orders');
        return response()->json(['success' => true, 'message' => 'ok'], 200);
    }

    public function cancelOrder(Request $request, Orders $order){
        $request->validate(['status_order' => 'required|in:Dibatalkan']);
        $order->update(['status_order' => $request->status_order]);
        // dd("ok");
        return back()->with('success', 'Status pesanan #' . $order->id . ' berhasil diperbarui.');
    }
}
