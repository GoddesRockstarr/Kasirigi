<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $fillable = ['pelanggan_id', 'total_harga'];

    public function items()
    {
        return $this->hasMany(PenjualanItem::class);
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
}
