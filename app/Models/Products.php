<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Wishlist;
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
    public function category() {
        return $this->belongsTo(Category::class);
    }
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
}
