<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class panduan_produk extends Model
{
    protected $table = 'panduan_products';

    protected $fillable = [
        'produk_id',
        'frekuensi',
        'cara_pakai',
        'waktu_terbaik',
        'hasil'
    ];

    public function product()
    {
        return $this->belongsTo(Products::class, 'produk_id');
    }
}
