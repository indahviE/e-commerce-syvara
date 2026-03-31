<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Products;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\disk;

class ProductController extends Controller
{
    public function view_product(Request $request)
    {
        $s            = $request->s ?? '';
        $categoryName = $request->category_name;
        $categoryId   = $request->id;

        $products = Products::with('categories')
            ->when($s, fn($q) => $q->where('name', 'like', "%$s%"))
            ->when($categoryId, fn($q) => $q->whereHas('categories', fn($q2) =>
                $q2->where('categories.id', $categoryId)
            ))
            ->when($categoryName, fn($q) => $q->whereHas(
                'categories',
                fn($q2) =>
                $q2->where('category_name', $categoryName)
            ))
            ->get();

        $categories = Category::has('products')->get();

        // dd($products);
        return view('product', [
            'categories' => $categories,
            'products'   => $products,
            'search'     => $s,
        ]);
    }
    public function viewAdminProduct()
    {
        $products = Products::with('categories')->get();
        return view('productAdmin', ['products' => $products]);
    }
    public function product_detail($id)
    {
        $product = Products::with('categories')->findOrFail($id);
        $categories = Category::all();

        $relatedProducts = Products::whereHas('categories', function ($q) use ($product) {
                $q->whereIn('categories.id', $product->categories->pluck('id'));
            })
            ->where('id', '!=', $id)
            ->limit(5)
            ->get();

        return view('productMain', [
            'product' => $product,
            'categories' => $categories,
            'relatedProducts' => $relatedProducts
        ]);
    }
    public function view_create_product()
    {
        $categories = Category::all();
        return view('create_product', compact('categories'));
    }
    public function view_update_product($id)
    {
        $product = Products::findOrFail($id);
        $categories = Category::all();
        return view('update_product', [
            "product" => $product,
            "categories" => $categories
        ]);
    }

    public function create_product(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'category_ids' => 'required|array|min:1',
            'category_ids.*' => 'exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048'
        ], [
            'price.numeric' => 'Harga harus berupa angka!',
            'price.min' => 'Harga tidak boleh negatif!',
            'stock.integer' => 'Stock harus berupa angka!',
            'stock.min' => 'Stock tidak boleh negatif!',
            'category_ids.required' => 'Pilih minimal satu kategori!',
            'category_ids.array' => 'Format kategori tidak valid!',
            'category_ids.*.exists' => 'Kategori tidak ditemukan!',
            'image.mimes' => 'Format foto tidak mendukung!',
            'image.max' => 'Ukuran gambar maksimal 2mb!'
        ]);

        $exists = Products::where('name', $request->name)
            ->whereHas('categories', fn($q) => $q->whereIn('categories.id', $request->category_ids))
            ->exists();

        if ($exists) {
            return back()->withErrors(['name' => 'Produk dengan nama kategori ini sudah ada!']);
        }

        if ($request->hasFile('image')) {
            $image = $request->image->store('images', 'public');
        } else {
            $image = null;
        }

        $product = Products::create([
            'name' => $request->name,
            'category_id' => $request->category_ids[0],
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'image' => $image,
        ]);

        $product->categories()->sync($request->category_ids);

        return redirect('/product')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function update_product(Request $request, $id)
    {
        $product = Products::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
            'category_ids' => 'required|array|min:1',
            'category_ids.*' => 'exists:categories,id',
            'gambar' => 'nullable|image|mimes:jpeg,jpg,png|max:2048'
        ], [
            'price.numeric' => 'Harga harus berupa angka!',
            'price.min' => 'Harga tidak boleh negatif!',
            'stock.integer' => 'Stock harus berupa angka!',
            'stock.min' => 'Stock tidak boleh negatif!',
            'category_ids.required' => 'Pilih minimal satu kategori!',
            'category_ids.array' => 'Format kategori tidak valid!',
            'category_ids.*.exists' => 'Kategori tidak ditemukan!',
            'gambar.mimes' => 'Format foto tidak mendukung!',
            'gambar.max' => 'Ukuran gambar maksimal 2mb!'
        ]);

        $exists = Products::where('name', $request->name)
            ->whereHas('categories', fn($q) => $q->whereIn('categories.id', $request->category_ids))
            ->where('id', '!=', $product->id)
            ->exists();

        if ($exists) {
            return back()->withErrors(['name' => 'Produk dengan nama kategori ini sudah ada!']);
        }

        if ($request->hasFile('gambar')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $image = $request->gambar->store('images', 'public');
        } else {
            $image = $product->image;
        }

        $product->update([
            'name' => $request->name,
            'category_id' => $request->category_ids[0],
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'image' => $image,
        ]);

        $product->categories()->sync($request->category_ids);

        return redirect()->route('ProductAdmin')->with('success', 'Produk telah ter-update');
    }

    public function delete_product($id)
    {
        $product = Products::find($id);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('ProductAdmin')->with('success', 'Produk berhasil dihapus!');
    }
}
