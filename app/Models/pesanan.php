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
        'total_harga',
        'tanggal_pesan',
    ];
}
