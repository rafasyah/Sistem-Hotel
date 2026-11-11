<?php

namespace App\Http\Controllers;

use App\Models\pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pesanans = pesanan::orderBy('id', 'desc')->get();
        return view('pesanan.index', compact('pesanans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pesanan.create');
    }

    /**
     * Price mapping helper
     */
    private function getRoomPrice(string $tipeKamar): float
    {
        switch (strtolower(trim($tipeKamar))) {
            case 'standar':
            case 'standard':
                return 500000;
            case 'deluxe':
                return 1000000;
            case 'family':
            case 'executif':
            case 'executive':
                return 1500000;
            default:
                return 500000;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'nama.required' => 'Nama pemesan wajib diisi.',
            'nama.regex' => 'Nama tidak boleh mengandung angka.',
            'kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'nomor_identitas.required' => 'isian salah..data harus 16 digit',
            'nomor_identitas.digits' => 'isian salah..data harus 16 digit',
            'nomor_identitas.numeric' => 'isian salah..data harus 16 digit',
            'tipe_kamar.required' => 'Tipe kamar wajib dipilih.',
            'tanggal_pesan.required' => 'Tanggal pesan wajib diisi.',
            'tanggal_pesan.after_or_equal' => 'Tanggal pemesanan tidak boleh tanggal sebelum hari ini.',
            'durasi_menginap.required' => 'harus isi angka',
            'durasi_menginap.integer' => 'harus isi angka',
            'durasi_menginap.numeric' => 'harus isi angka',
            'durasi_menginap.min' => 'harus isi angka',
        ];

        $validatedData = $request->validate([
            'nama' => ['required', 'string', 'max:255', 'regex:/^[^\d]+$/'],
            'kelamin' => 'required|in:Laki-laki,Perempuan',
            'nomor_identitas' => 'required|digits:16',
            'tipe_kamar' => 'required|string|in:Standard,Standar,Deluxe,Family,Executive,Executif',
            'tanggal_pesan' => 'required|date|after_or_equal:today',
            'durasi_menginap' => 'required|integer|min:1',
            'termasuk_breakfast' => 'nullable',
        ], $messages);

        // Standardize room price based on selected type
        $harga = $this->getRoomPrice($validatedData['tipe_kamar']);
        $durasi = (int) $validatedData['durasi_menginap'];
        $hasBreakfast = $request->has('termasuk_breakfast') && ($request->termasuk_breakfast == 1 || $request->termasuk_breakfast === 'on' || $request->termasuk_breakfast === true);

        // Subtotal before discount
        $subtotal = $harga * $durasi;

        // Diskon 10% jika menginap 3 hari atau lebih (sesuai simulasi dokumen BNSP: Standar 3 hari = Diskon 10%)
        $discount = ($durasi >= 3) ? ($subtotal * 0.10) : 0;

        // Biaya breakfast: Rp 80.000 per hari (sesuai aturan BNSP: tambahan 80.000 jika pilih breakfast)
        $breakfastFee = $hasBreakfast ? (80000 * $durasi) : 0;

        // Total Bayar = (Tarif × Durasi) − Diskon + Breakfast
        $totalHarga = $subtotal - $discount + $breakfastFee;

        $pesanan = pesanan::create([
            'nama' => $validatedData['nama'],
            'kelamin' => $validatedData['kelamin'],
            'nomor_identitas' => $validatedData['nomor_identitas'],
            'tipe_kamar' => $validatedData['tipe_kamar'],
            'harga' => $harga,
            'durasi_menginap' => $durasi,
            'termasuk_breakfast' => $hasBreakfast,
            'discount' => $discount,
            'total_harga' => $totalHarga,
            'tanggal_pesan' => $validatedData['tanggal_pesan'],
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Pesanan kamar berhasil disimpan.',
                'data' => $pesanan
            ]);
        }

        return redirect()->route('pesanan.show', $pesanan->id)->with('success', 'Pesanan kamar berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pesanan = pesanan::findOrFail($id);

        if (request()->wantsJson()) {
            return response()->json($pesanan);
        }

        return view('pesanan.show', compact('pesanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pesanan = pesanan::findOrFail($id);

        if (request()->wantsJson()) {
            return response()->json($pesanan);
        }

        return view('pesanan.edit', compact('pesanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pesanan = pesanan::findOrFail($id);

        $messages = [
            'nama.required' => 'Nama pemesan wajib diisi.',
            'nama.regex' => 'Nama tidak boleh mengandung angka.',
            'kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'nomor_identitas.required' => 'isian salah..data harus 16 digit',
            'nomor_identitas.digits' => 'isian salah..data harus 16 digit',
            'nomor_identitas.numeric' => 'isian salah..data harus 16 digit',
            'tipe_kamar.required' => 'Tipe kamar wajib dipilih.',
            'tanggal_pesan.required' => 'Tanggal pesan wajib diisi.',
            'tanggal_pesan.after_or_equal' => 'Tanggal pemesanan tidak boleh tanggal sebelum hari ini.',
            'durasi_menginap.required' => 'harus isi angka',
            'durasi_menginap.integer' => 'harus isi angka',
            'durasi_menginap.numeric' => 'harus isi angka',
            'durasi_menginap.min' => 'harus isi angka',
        ];

        $validatedData = $request->validate([
            'nama' => ['required', 'string', 'max:255', 'regex:/^[^\d]+$/'],
            'kelamin' => 'required|in:Laki-laki,Perempuan',
            'nomor_identitas' => 'required|digits:16',
            'tipe_kamar' => 'required|string|in:Standard,Standar,Deluxe,Family,Executive,Executif',
            'tanggal_pesan' => 'required|date|after_or_equal:today',
            'durasi_menginap' => 'required|integer|min:1',
            'termasuk_breakfast' => 'nullable',
        ], $messages);

        $harga = $this->getRoomPrice($validatedData['tipe_kamar']);
        $durasi = (int) $validatedData['durasi_menginap'];
        $hasBreakfast = $request->has('termasuk_breakfast') && ($request->termasuk_breakfast == 1 || $request->termasuk_breakfast === 'on' || $request->termasuk_breakfast === true);

        $subtotal = $harga * $durasi;
        $discount = ($durasi >= 3) ? ($subtotal * 0.10) : 0;
        $breakfastFee = $hasBreakfast ? (80000 * $durasi) : 0;
        $totalHarga = $subtotal - $discount + $breakfastFee;

        $pesanan->update([
            'nama' => $validatedData['nama'],
            'kelamin' => $validatedData['kelamin'],
            'nomor_identitas' => $validatedData['nomor_identitas'],
            'tipe_kamar' => $validatedData['tipe_kamar'],
            'harga' => $harga,
            'durasi_menginap' => $durasi,
            'termasuk_breakfast' => $hasBreakfast,
            'discount' => $discount,
            'total_harga' => $totalHarga,
            'tanggal_pesan' => $validatedData['tanggal_pesan'],
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Pesanan kamar berhasil diperbarui.',
                'data' => $pesanan
            ]);
        }

        return redirect()->route('pesanan.show', $pesanan->id)->with('success', 'Pesanan kamar berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pesanan = pesanan::findOrFail($id);
        $pesanan->delete();

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil dihapus.'
            ]);
        }

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dihapus!');
    }
}
