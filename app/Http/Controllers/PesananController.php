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
        $pesanans = pesanan::all();
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'kelamin' => 'required|in:Laki-laki,Perempuan',
            'nomor_identitas' => 'required|string|max:255',
            'tipe_kamar' => 'required|in:Standard,Deluxe,Family',
            'harga' => 'required|numeric|min:0',
            'durasi_menginap' => 'required|integer|min:1',
            'termasuk_breakfast' => 'required|boolean',
            'tanggal_pesan' => 'required|date',
        ]);

        // Calculate total_harga
        $totalHarga = $validatedData['harga'] * $validatedData['durasi_menginap'];
        if ($validatedData['termasuk_breakfast']) {
            $totalHarga += 50000; // Assuming breakfast costs 50,000
        }
        $validatedData['total_harga'] = $totalHarga;

        pesanan::create($validatedData);

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(pesanan $pesanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pesanan $pesanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, pesanan $pesanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pesanan $pesanan)
    {
        //
    }
}
