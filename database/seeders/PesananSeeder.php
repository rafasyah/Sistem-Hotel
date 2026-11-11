<?php

namespace Database\Seeders;

use App\Models\pesanan;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Avoid duplicate seeding if records exist
        if (pesanan::count() > 0) {
            return;
        }

        $sampleBookings = [
            [
                'nama' => 'Andri Santosa',
                'kelamin' => 'Laki-laki',
                'nomor_identitas' => '3275091210770004',
                'tipe_kamar' => 'Standar',
                'harga' => 500000,
                'durasi_menginap' => 3,
                'termasuk_breakfast' => true,
                'discount' => 150000, // 10% of 1.500.000 (durasi >= 3 hari)
                'total_harga' => 1590000, // (500.000 * 3) - 150.000 + (3 * 80.000) = 1.590.000 (sesuai dokumen BNSP)
                'tanggal_pesan' => Carbon::now()->subDays(2)->format('Y-m-d'),
            ],
            [
                'nama' => 'Siti Nurhaliza',
                'kelamin' => 'Perempuan',
                'nomor_identitas' => '3174055208950001',
                'tipe_kamar' => 'Deluxe',
                'harga' => 1000000,
                'durasi_menginap' => 2,
                'termasuk_breakfast' => true,
                'discount' => 0, // durasi < 3
                'total_harga' => 2160000, // (1.000.000 * 2) - 0 + (2 * 80.000) = 2.160.000
                'tanggal_pesan' => Carbon::now()->subDay()->format('Y-m-d'),
            ],
            [
                'nama' => 'Budi Pratama',
                'kelamin' => 'Laki-laki',
                'nomor_identitas' => '3578011504880002',
                'tipe_kamar' => 'Family',
                'harga' => 1500000,
                'durasi_menginap' => 5,
                'termasuk_breakfast' => false,
                'discount' => 750000, // 10% of 7.500.000
                'total_harga' => 6750000, // (1.500.000 * 5) - 750.000 + 0
                'tanggal_pesan' => Carbon::now()->format('Y-m-d'),
            ],
        ];

        foreach ($sampleBookings as $data) {
            pesanan::create($data);
        }
    }
}
