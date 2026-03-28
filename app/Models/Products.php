<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Wishlist;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class Products extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'price',
        'stock',
        'description',
        'image'
    ];

    // ====== RELATIONSHIPS ======

    /**
     * Many-to-many relationship dengan Category
     * Satu produk bisa punya banyak kategori
     */
    public function categories()
    {
        return $this->belongsToMany(
            Category::class,
            'product_categories',
            'product_id',
            'category_id'
        );
    }

    /**
     * Accessor untuk backward compatibility
     * Jika ada code lama yang pakai $product->category
     */
    public function category()
    {
        return $this->categories()->first();
    }

    /**
     * Relationship dengan Wishlist
     */
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    /**
     * Many-to-many relationship dengan User melalui Wishlist
     */
    public function wishlistUsers()
    {
        return $this->belongsToMany(User::class, 'wishlists');
    }

    // ====== METHODS ======

    /**
     * Check apakah produk sudah di-wishlist oleh user
     */
    public function isWishlisted()
    {
        $user = Auth::user();

        if (!$user) {
            return false;
        }

        return Wishlist::where('user_id', $user->id)
            ->where('product_id', $this->id)
            ->exists();
    }

    /**
     * Get kategori names sebagai string (untuk display)
     * Contoh: "Skincare, Makeup, Fragrance"
     */
    public function getCategoryNamesAttribute()
    {
        return $this->categories
            ->pluck('category_name')
            ->implode(', ');
    }

    /**
     * Get kategori IDs sebagai array
     */
    public function getCategoryIdsAttribute()
    {
        return $this->categories
            ->pluck('id')
            ->toArray();
    }

    /**
     * Scope untuk filter by multiple categories
     * Usage: Products::byCategories([1,2,3])->get()
     */
    public function scopeByCategories($query, $categoryIds)
    {
        return $query->whereHas('categories', function($q) use ($categoryIds) {
            $q->whereIn('categories.id', $categoryIds);
        });
    }

    /**
     * Scope untuk search by name
     * Usage: Products::search('vitamin')->get()
     */
    public function scopeSearch($query, $keyword)
    {
        return $query->where('name', 'like', "%$keyword%");
    }
}
