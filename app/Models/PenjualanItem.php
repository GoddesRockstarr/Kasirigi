<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenjualanItem extends Model
{
     protected $fillable = ['penjualan_id', 'produk_id', 'jumlah', 'subtotal'];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }
}
