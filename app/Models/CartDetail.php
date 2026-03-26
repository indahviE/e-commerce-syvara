<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
      protected $table = 'cart_detail';

    protected $fillable = [
        'cart_id',
        'product_id'
    ];

    public function cart() {
        return $this->belongsTo(Cart::class);
    }

    public function product() {
        return $this->belongsTo(Products::class);
    }

    
}
