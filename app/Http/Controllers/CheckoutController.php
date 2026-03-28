<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Orders;
use App\Models\Products;
use App\Models\Vouchers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $product = Products::where("id", $request->produk_id)->get();
        $product[0]["qty"] = $request->qty;
        // dd($product);
        return view('payment_view', ["products" => $product]);
    }

    public function order_view(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $query = Orders::with(['orderDetails.product', 'voucher', 'user'])
            ->latest();

        // Filter nama
        if ($request->filled('nama')) {
            $query->where('nama_penerima', 'like', '%' . $request->nama . '%');
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status_order', $request->status);
        }

        // Filter tanggal
        if ($request->filled('dari')) {
            $query->whereDate('created_at', '>=', $request->dari);
        }
        if ($request->filled('sampai')) {
            $query->whereDate('created_at', '<=', $request->sampai);
        }

        $orders    = $query->paginate(15);
        $allOrders = Orders::all(); // untuk stat card


        return view('orderAdmin', compact('orders', 'allOrders'));
    }

    public function show_payment(Request $request)
    {
        $products = [];

        foreach ($request->id as $produkid) {
            $products[] = Products::where('id', $produkid)->first();
        }
        // $products = Products::whereIn('id', $request->id)->get();
        // dd($request->all(), $products);

        $i = 0;
        foreach ($products as $data) {
            $data['qty'] = $request->qtys[$i];
            $i++;
        }

        // dd($products, $request->qtys);
        return view('payment_cart_view', ["products" => $products]);
    }

    public function CheckPromo(Request $request)
    {
        $voucher = Vouchers::where('kode', $request->kode)->first();
        if (!$voucher)  return response()->json(["success" => 0]);
        if ($voucher->is_expired) return response()->json(["success" => 0]);

        return response()->json(["success" => 1, "discount" => $voucher->discount]);
    }

    public function Checkout(Request $request)
    {

        $request["user_id"] = Auth::user()->id;
        $request["tanggal_waktu"] = Carbon::now();

        // Diproses, Dikemas, Dikirim, Diterima 
        $request["status_order"] = "Diproses";

        // hitung total harga
        $request["total_price"] = 0;

        for ($i = 0; $i < count($request->id); $i++) {
            # code...
            $product = Products::findOrFail($request->id[$i]);
            $request["total_price"] += $product->price * $request->qtys[$i];
        }

        if ($request->voucher) {
            $voucher = Vouchers::where('kode', $request->voucher)->first();
            if ($voucher) {
                $request["voucher_id"] = $voucher->id;
                $request["total_price"] = $request["total_price"] - ($request["total_price"] * ($voucher->discount / 100));
            }
        } else {
            $request["voucher_id"] = null;
        }

        $request["payment_method"] = $request['payment'];

        $order = Orders::create($request->all());

        // order DETAIL :)

        for ($i = 0; $i < count($request->id); $i++) {
            # code...
            $product = Products::findOrFail($request->id[$i]);
            $order_detail = OrderDetail::create([
                "order_id" => $order->id,
                "product_id" => $product->id,
                "subtotal_price" => $product->price * $request->qtys[$i],
                "harga_saat_ini" => $product->price,
                "qty" => $request->qtys[$i]
            ]);
        }

        // dd($request->all());
        return redirect(route('history'));
    }

    public function updateStatus(Request $request, Orders $order)
    {
        $request->validate(['status_order' => 'required|in:Diproses,Dikemas,Dikirim,Diterima,Dibatalkan']);
        $order->update(['status_order' => $request->status_order]);
        return back()->with('success', 'Status pesanan #' . $order->id . ' berhasil diperbarui.');
    }
}
