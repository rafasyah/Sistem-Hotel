<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pesanan extends Model
{
    protected $fillable = [
        'nama',
        'kelamin',
        'nomor_identitas',
        'tipe_kamar',
        'harga',
        'durasi_menginap',
        'termasuk_breakfast',
        'discount',
        'total_harga',
        'tanggal_pesan',
    ];

    /**
     * Scope to format or calculate subtotal before discount
     */
    public function getSubtotalAttribute()
    {
        return $this->harga * $this->durasi_menginap;
    }
}
