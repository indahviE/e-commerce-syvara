<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Models\User;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/home', function () {
        return view('home');
    })->name('home.admin');
    Route::get('/product/admin', [
        ProductController::class,
        'viewAdminProduct'
    ])->name('ProductAdmin');
    Route::get('/product/create', [
        ProductController::class,
        'view_create_product'
    ])->name('view_create_product');
    Route::get('/product/update/{id}', [
        ProductController::class,
        'view_update_product'
    ])->name('view_update_product');
    Route::post('/product/create', [
        ProductController::class,
        'create_product'
    ])->name('product_create');

    Route::post('/product/update/{id}', [
        ProductController::class,
        'update_product'
    ])->name('product_update');

    Route::post('/product/delete/{id}', [
        ProductController::class,
        'delete_product'
    ])->name('product_delete');

    Route::get('/admin/category', [
        CategoryController::class,
        'viewAdminCategory'
    ])->name('categoryAdmin');
    Route::get('/category/create', [
        CategoryController::class,
        'view_create'
    ])->name('view_create_category');
    Route::get('/category/update/{id}', [
        CategoryController::class,
        'view_update'
    ])->name('view_update_category');
    Route::post('/category/create', [
        CategoryController::class,
        'create_category'
    ])->name('category_create');
    Route::post('/category/update/{id}', [
        CategoryController::class,
        'update_category'
    ])->name('category_update');
    Route::post('/category/delete/{id}', [
        CategoryController::class,
        'delete_category'
    ])->name('category_delete');
});

Route::middleware(['auth', 'member'])->group(function () {
    Route::get('/member/home', function () {
        return view('home');
    })->name('home.member');
    Route::get('/member/product', [
        ProductController::class,
        'view_product'
    ])->name('productMember');
    Route::get('/product/{id}/detail', [
        ProductController::class,
        'product_detail'
    ])->name('product_detail');

    Route::get('/member/category', [
        CategoryController::class,
        'view_category'
    ])->name('categoryMember');
    Route::get('/category/{id}', [
        CategoryController::class,
        'show_products'
    ])->name('category.products');
    Route::get('/member/pemesanan', function () {
        return view('pemesanan');
    });
});

Route::middleware('auth', 'member')->group(function () {
    Route::get('/wishlist', [
        WishlistController::class,
        'index'
    ])->name('wishlist_view');
    Route::post('/wishlist/toggle/{productId}', [
        WishlistController::class,
        'toggle'
    ])->name('wishlist_toggle');
    Route::get('/wishlist/check/{productId}', [
        WishlistController::class,
        'check'
    ])->name('wishlist_check');
});

// cart, order, , history
Route::middleware('auth', 'member')->group(function () {
    Route::get('/my-orders', [
        CartController::class,
        'index'
    ])->name('cart_view');

    Route::post('/cart/add', [
        CartController::class,
        'cart_add_product'
    ])->name('cart_product_add');

    Route::post('/my-orders/delete/{id}', [
        CartController::class,
        'cart_remove_product'
    ])->name('cart_product_delete');
});

// orders
Route::middleware('auth', 'admin')->group(function () {
    Route::get('/orders', [CheckoutController::class, 'order_view'])->name('order_view');
    Route::patch('/orders/{order}/status', [CheckoutController::class, 'updateStatus'])->name('admin.orders.status');
});

// checkout(payment)
Route::middleware('auth', 'member')->group(function () {
    Route::post('/my-orders/payment', [CheckoutController::class, 'show_payment'])->name('show_payment');
    Route::post('/apply/discount', [CheckoutController::class, 'CheckPromo'])->name('check_promo');
    Route::post('/checkout', [CheckoutController::class, 'Checkout'])->name('checkout');
    Route::post('/payment', [CheckoutController::class, 'index'])->name('show_single_payment');
});

Route::middleware('auth', 'member')->group(function () {
    Route::get('/history', [CartController::class, 'history'])->name('history');
    Route::patch('/history/{order}', [CartController::class, 'cancelOrder'])->name('cancelOrder');
});

Route::get("/product", function () {
    $user = Auth::user();

    if (!$user) return redirect()->route('productMember');

    if ($user && $user->role === 'admin') {
        return redirect()->route('ProductAdmin');
    } elseif ($user && $user->role === 'member') {
        return redirect()->route('productMember');
    }
});
Route::get("/category", function () {
    $user = Auth::user();

    if ($user && $user->role === 'admin') {
        return redirect()->route('categoryAdmin');
    } elseif ($user && $user->role === 'member') {
        return redirect()->route('categoryMember');
    }
});

require __DIR__ . '/auth.php';
