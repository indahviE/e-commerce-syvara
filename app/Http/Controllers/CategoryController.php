<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\ProductController;
use App\Models\Products;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function view_category(){
        $category = Category::has('products')->with('products')->get();
        return view('category', ['categories' => $category]);
    }
    public function viewAdminCategory() {
        $category = Category::all();
        return view('categoryAdmin', ['category' => $category]);
    }
    public function view_create(){
        return view('create_category');
    }
    public function view_update($id){
        $category = Category::findOrFail($id);

        return view('update_category', ['category' => $category]);
    }
    public function show_products($id)
    {
    $category = Category::findOrFail($id);
    $product = Products::where('category_id', $id)->get();

    return view('category-products', [
        'category' => $category,
        'products' => $product
    ]);
    }
    public function create_category(Request $request){
            $request->validate([
            'category_name' => 'required|string|max:255|unique:categories,category_name'
        ], [
            'category_name.unique' => 'Nama kategori sudah ada!'
        ]);
        Category::create([
            'category_name' =>$request->category_name
        ]);
        return redirect('/admin/category')->with('success', 'Kategori berhasil ditambahkan!');
    }
    public function update_category(Request $request, $id) {
        $request->validate([
            'category_name' => 'required|string|max:255|unique:categories,category_name'
        ], [
            'category_name.unique' => 'Nama kategori sudah ada!'
        ]);
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return redirect()->route('categoryAdmin')->with('success', 'Kategori berhasil ter-update');
    }
    public function delete_category($id){
        $category = Category::find($id);

        if($category->products()->count() > 0) {
            return redirect('/category')->with('error', 'Tidak bisa menghapus kategori! Masih ada' . $category->products()->count() . 'produk yang menggunakan kategori ini!');
        }

        $category->delete();
        return redirect()->route('categoryAdmin')->with('success', 'Kategori berhasil ter-hapus!');
    }
}
