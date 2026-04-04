<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Wishlist;
use App\Models\Category;
use App\Models\User;
use App\Models\faq_product;
use App\Models\panduan_produk;
use Illuminate\Support\Facades\Auth;

class Products extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'price',
        'stock',
        'description',
        'image',
        'category_id'
    ];

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function wishlistUsers()
    {
        return $this->belongsToMany(User::class, 'wishlists');
    }
    public function isWishlisted()
    {
        $user = Auth::user();  // Ganti auth() dengan Auth::user()

        if (!$user) {
            return false;
        }

        return Wishlist::where('user_id', $user->id)
            ->where('product_id', $this->id)
            ->exists();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories', 'product_id', 'category_id');
    }

    public function faqs()
    {
        return $this->hasMany(faq_product::class, 'produk_id');
    }

    public function discount()
    {
        return $this->hasOne(Discount::class);
    }

    public function guides()
    {
        return $this->hasMany(panduan_produk::class, 'produk_id');
    }

    public function getCategoryIdsAttribute()
    {
        return $this->categories->pluck('id')->toArray();
    }

    public function getCategoryNamesAttribute()
    {
        return $this->categories->pluck('category_name')->implode(', ');
    }
}
