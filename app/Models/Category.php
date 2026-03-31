<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'category_name'
    ];

    /**
     * One-to-many relationship dengan Products
     * Satu kategori punya banyak produk
     */
    public function products()
    {
        return $this->hasMany(Products::class);
    }
}
