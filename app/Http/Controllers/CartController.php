<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Tampilkan halaman wishlist
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        return view('cart_view', ['products' => [["price" => 30000], ["price" => 25000]]]);
    }
    // Tampilkan halaman wishlist
    public function history()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        return view('history_view', ['orders' => []]);
    }
}
