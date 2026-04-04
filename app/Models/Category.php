<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['category_name'];

    // METHOD 1: One-to-many (via category_id di products table)
    public function products()
    {
        return $this->hasMany(Products::class, 'category_id', 'id');
    }

    // METHOD 2: Many-to-many (via product_categories junction table)
    public function productCategories()
    {
        return $this->belongsToMany(
            Products::class,
            'product_categories',
            'category_id',
            'product_id'
        );
    }
}
