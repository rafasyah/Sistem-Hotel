<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('nomor_identitas');
            $table->enum('tipe_kamar', ['Standard', 'Deluxe', 'Family']);
            $table->decimal('harga', 10, 2);
            $table->integer('durasi_menginap');
            $table->boolean('termasuk_breakfast');
            $table->decimal('total_harga', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
