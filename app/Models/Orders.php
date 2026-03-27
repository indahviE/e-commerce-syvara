<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'order';

    protected $fillable = [
        'user_id',
        'tanggal_waktu',
        'status_order',
        'total_price',
        'alamat',
        'nama_penerima',
        'no_telp',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kode_pos',
        'catatan_kurir',
        'payment_method',
        'shipping',
        'voucher_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Vouchers::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
}
