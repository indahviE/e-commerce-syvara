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
     * Many-to-many relationship dengan Products
     * Satu kategori bisa punya banyak produk
     */
    public function products()
    {
        return $this->belongsToMany(
            Products::class,
            'product_categories',
            'category_id',
            'product_id'
        );
    }
}
