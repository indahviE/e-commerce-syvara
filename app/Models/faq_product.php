<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class faq_product extends Model
{
    protected $fillable = [
        'produk_id',
        'pertanyaan',
        'jawaban'
    ];

    public function product()
    {
        return $this->belongsTo(Products::class, 'produk_id');
    }
}
