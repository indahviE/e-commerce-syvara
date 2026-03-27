<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
     protected $table = 'order_detail';

    protected $fillable = [
        'order_id',
        'product_id',
        'subtotal_price',
        'harga_saat_ini',
        'qty'
    ];

    public function order()
    {
        return $this->belongsTo(Orders::class);
    }

    public function product() {
        return $this->belongsTo(Products::class);
    }
}
