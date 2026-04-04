<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = [
        'products_id',
        'discount_type',
        'discount_value',
        'valid_until',
    ];

    protected $casts = [
        'valid_until' => 'date',
    ];

    public function product()
    {
        return $this->belongsTo(Products::class, 'products_id', 'id');
    }

    /**
     * Get the discount label for display
     */
    public function getDiscountLabelAttribute()
    {
        if ($this->discount_type === 'percentage') {
            return $this->discount_value . '%';
        }

        return 'Rp ' . number_format($this->discount_value, 0, ',', '.');
    }

    /**
     * Check if discount is still active
     */
    public function getIsActiveAttribute()
    {
        return $this->valid_until >= now()->toDateString();
    }
}
