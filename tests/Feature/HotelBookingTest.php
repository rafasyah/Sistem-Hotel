<?php

namespace Tests\Feature;

use App\Models\pesanan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HotelBookingTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test halaman utama beranda memuat menu dan tampilan sesuai standar BNSP.
     */
    public function test_home_page_displays_all_required_bnsp_sections(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Produk');
        $response->assertSee('Daftar Harga');
        $response->assertSee('Tentang Kami');
        $response->assertSee('Form Pemesanan');
    }

    /**
     * Test form pemesanan dapat dibuka.
     */
    public function test_create_booking_page_can_be_rendered(): void
    {
        $response = $this->get('/pesanan/create');

        $response->assertStatus(200);
        $response->assertSee('Form Pemesanan');
        $response->assertSee('Hitung Total Bayar');
        $response->assertSee('Simpan');
        $response->assertSee('Cancel');
    }

    /**
     * Test validasi nama pemesan tidak boleh mengandung angka.
     */
    public function test_validation_fails_if_name_contains_numbers(): void
    {
        $response = $this->post('/pesanan', [
            'nama' => 'Budi 123 Santoso',
            'kelamin' => 'Laki-laki',
            'nomor_identitas' => '1234567890123456',
            'tipe_kamar' => 'Standar',
            'tanggal_pesan' => '2026-11-03',
            'durasi_menginap' => 3,
            'termasuk_breakfast' => 1,
        ]);

        $response->assertSessionHasErrors(['nama' => 'Nama tidak boleh mengandung angka.']);
    }

    /**
     * Test validasi nomor identitas harus 16 digit.
     */
    public function test_validation_fails_if_identity_is_not_16_digits(): void
    {
        $response = $this->post('/pesanan', [
            'nama' => 'Budi Santoso',
            'kelamin' => 'Laki-laki',
            'nomor_identitas' => '12345', // kurang dari 16 digit
            'tipe_kamar' => 'Standar',
            'tanggal_pesan' => '2026-11-03',
            'durasi_menginap' => 3,
            'termasuk_breakfast' => 1,
        ]);

        $response->assertSessionHasErrors(['nomor_identitas' => 'isian salah..data harus 16 digit']);
    }

    /**
     * Test validasi durasi menginap harus berupa angka.
     */
    public function test_validation_fails_if_duration_is_not_valid_number(): void
    {
        $response = $this->post('/pesanan', [
            'nama' => 'Budi Santoso',
            'kelamin' => 'Laki-laki',
            'nomor_identitas' => '1234567890123456',
            'tipe_kamar' => 'Standar',
            'tanggal_pesan' => '2026-11-03',
            'durasi_menginap' => 'bukan-angka',
            'termasuk_breakfast' => 1,
        ]);

        $response->assertSessionHasErrors(['durasi_menginap' => 'harus isi angka']);
    }

    /**
     * Test simulasi presisi sesuai Dokumen BNSP Butir C.2 (Standar 3 hari + Breakfast = 1.590.000).
     */
    public function test_booking_calculation_with_exact_bnsp_sample_case(): void
    {
        // 3 hari kamar Standar (500.000 * 3 = 1.500.000)
        // Diskon 10% (>= 3 hari) = 150.000
        // Breakfast (80.000 * 3 hari) = 240.000
        // Total = 1.500.000 - 150.000 + 240.000 = 1.590.000 (sesuai screenshot PDF hal 2 & tabel hal 3)
        $response = $this->post('/pesanan', [
            'nama' => 'Andri Santosa',
            'kelamin' => 'Laki-laki',
            'nomor_identitas' => '3275091210770004',
            'tipe_kamar' => 'Standar',
            'tanggal_pesan' => '2026-11-03',
            'durasi_menginap' => 3,
            'termasuk_breakfast' => 1,
        ]);

        $pesanan = pesanan::where('nama', 'Andri Santosa')->first();
        $this->assertNotNull($pesanan);
        $this->assertEquals(500000, (float) $pesanan->harga);
        $this->assertEquals(150000, (float) $pesanan->discount);
        $this->assertEquals(1590000, (float) $pesanan->total_harga);

        $response->assertRedirect(route('pesanan.show', $pesanan->id));
    }

    /**
     * Test kalkulasi tanpa diskon jika menginap < 3 hari dengan breakfast.
     */
    public function test_booking_calculation_without_discount_for_short_stay(): void
    {
        // 2 hari kamar Deluxe (1.000.000 * 2 = 2.000.000)
        // Diskon 0 (< 3 hari)
        // Breakfast = 80.000 * 2 hari = 160.000
        // Total = 2.000.000 + 160.000 = 2.160.000
        $response = $this->post('/pesanan', [
            'nama' => 'Siti Aminah',
            'kelamin' => 'Perempuan',
            'nomor_identitas' => '3174055208950001',
            'tipe_kamar' => 'Deluxe',
            'tanggal_pesan' => '2026-11-03',
            'durasi_menginap' => 2,
            'termasuk_breakfast' => 1,
        ]);

        $pesanan = pesanan::where('nama', 'Siti Aminah')->first();
        $this->assertNotNull($pesanan);
        $this->assertEquals(1000000, (float) $pesanan->harga);
        $this->assertEquals(0, (float) $pesanan->discount);
        $this->assertEquals(2160000, (float) $pesanan->total_harga);
    }

    /**
     * Test melihat detail pesanan (Bukti Pemesanan sesuai Dokumen BNSP Butir C.2.b).
     */
    public function test_show_booking_displays_exact_bnsp_format(): void
    {
        $pesanan = pesanan::create([
            'nama' => 'Andri Santosa',
            'kelamin' => 'Laki-laki',
            'nomor_identitas' => '3275091210770004',
            'tipe_kamar' => 'Standar',
            'harga' => 500000,
            'durasi_menginap' => 3,
            'termasuk_breakfast' => true,
            'discount' => 150000,
            'total_harga' => 1590000,
            'tanggal_pesan' => '2026-11-03',
        ]);

        $response = $this->get(route('pesanan.show', $pesanan->id));

        $response->assertStatus(200);
        $response->assertSee('Nama Pemesan');
        $response->assertSee('Andri Santosa');
        $response->assertSee('3275091210770004');
        $response->assertSee('Standar');
        $response->assertSee('Durasi Penginapan');
        $response->assertSee('3 Hari');
        $response->assertSee('Discount');
        $response->assertSee('10%');
        $response->assertSee('1.590.000');
    }
}
