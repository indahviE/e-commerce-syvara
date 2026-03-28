<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vouchers extends Model
{

 protected $table = "vouchers";
 protected $fillable = ['kode', 'discount', "is_expired"];
    
}
