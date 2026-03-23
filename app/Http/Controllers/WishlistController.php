<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    // Tampilkan halaman wishlist
public function index()
{
    if (!Auth::check()) {
        return redirect('/login');
    }

    // Query langsung ke database
    $wishlistIds = Wishlist::where('user_id', Auth::id())
        ->pluck('product_id');

    $products = Products::whereIn('id', $wishlistIds)->get();

    return view('wishlist_view', compact('products'));
}

    // Toggle wishlist (add/remove)
    public function toggle($productId)
    {
        $product = Products::findOrFail($productId);

        $exists = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->exists();

        if ($exists) {
            // Hapus dari wishlist
            Wishlist::where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->delete();

            return response()->json([
                'status' => 'removed',
                'message' => 'Dihapus dari favorit'
            ]);
        } else {
            // Tambah ke wishlist
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $productId
            ]);

            return response()->json([
                'status' => 'added',
                'message' => 'Ditambahkan ke favorit'
            ]);
        }
    }

    // Check apakah produk sudah di-wishlist
    public function check($productId)
    {
        $isWishlisted = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->exists();

        return response()->json(['wishlisted' => $isWishlisted]);
    }
}
