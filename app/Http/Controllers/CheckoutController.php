<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
     public function index()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        return view('payment_view');
    }

    public function show_payment(Request $request){
        // dd($request->all());
        $products = Products::whereIn('id', $request->id)->get();

        $i = 0;
        foreach ($products as $data) {
            $data['qty'] = $request->qtys[$i];
            $i++;
        }

        // dd($products, $request->qtys);
        return view('payment_cart_view', ["products" => $products]);
    }
}
