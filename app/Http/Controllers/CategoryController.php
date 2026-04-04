<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\ProductController;
use App\Models\Products;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function view_category(){
    // ✅ PENTING: Ini harus ganti dari has('products') ke whereHas + orWhereHas
    $category = Category::whereHas('productCategories')
        ->orWhereHas('products')
        ->with(['productCategories', 'products'])
        ->get();

    return view('category', ['categories' => $category]);
}
    // public function view_category(){
    //     // Ambil kategori yang punya produk (dari kedua relasi)
    //     $category = Category::whereHas('productCategories')
    //         ->orWhereHas('products')
    //         ->with(['productCategories', 'products'])
    //         ->get();

    //     // Jika masih kosong, ambil semua kategori + hitung produk
    //     if($category->isEmpty()) {
    //         $category = Category::all()->load(['productCategories', 'products']);
    //     }

    //     return view('category', ['categories' => $category]);
    // }

    /**
     * Menampilkan kategori untuk admin
     */
    public function viewAdminCategory() {
        $category = Category::paginate(5);
        return view('categoryAdmin', ['category' => $category]);
    }

    /**
     * Menampilkan form create kategori
     */
    public function view_create(){
        return view('create_category');
    }

    /**
     * Menampilkan form update kategori
     */
    public function view_update($id){
        $category = Category::findOrFail($id);
        return view('update_category', ['category' => $category]);
    }

    /**
     * Menampilkan produk berdasarkan kategori
     * Support untuk kategori dengan relasi one-to-many dan many-to-many
     */
    public function show_products($id)
    {
        $category = Category::findOrFail($id);

        // Ambil produk dari kedua relasi (one-to-many dan many-to-many)
        $productFromOneToMany = Products::where('category_id', $id)->pluck('id')->toArray();
        $productFromManyToMany = Products::whereHas('categories', fn($q) => $q->where('categories.id', $id))->pluck('id')->toArray();

        // Merge dan hilangkan duplikat
        $productIds = array_unique(array_merge($productFromOneToMany, $productFromManyToMany));

        // Ambil semua produk berdasarkan ID yang sudah dikumpulkan
        $product = Products::whereIn('id', $productIds)->get();

        return view('category-products', [
            'category' => $category,
            'products' => $product
        ]);
    }

    /**
     * Create kategori baru
     */
    public function create_category(Request $request){
        $request->validate([
            'category_name' => 'required|string|max:255|unique:categories,category_name'
        ], [
            'category_name.unique' => 'Nama kategori sudah ada!'
        ]);

        Category::create([
            'category_name' => $request->category_name
        ]);

        return redirect('/admin/category')->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Update kategori
     */
    public function update_category(Request $request, $id) {
        $request->validate([
            'category_name' => 'required|string|max:255|unique:categories,category_name,'.$id
        ], [
            'category_name.unique' => 'Nama kategori sudah ada!'
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('categoryAdmin')->with('success', 'Kategori berhasil ter-update');
    }

    /**
     * Delete kategori
     */
    public function delete_category($id){
        $category = Category::find($id);

        // Hitung produk dari kedua relasi
        $productCount = $category->products()->count() + $category->productCategories()->count();

        if($productCount > 0) {
            return redirect('/category')->with('error', 'Tidak bisa menghapus kategori! Masih ada ' . $productCount . ' produk yang menggunakan kategori ini!');
        }

        $category->delete();
        return redirect()->route('categoryAdmin')->with('success', 'Kategori berhasil ter-hapus!');
    }
}
