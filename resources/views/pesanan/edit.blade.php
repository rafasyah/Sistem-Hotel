<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pemesanan — Grand Hotel Nusantara</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind (Play CDN). For production, compile with Vite/Tailwind CLI and move the config + styles below into tailwind.config.js / app.css -->
    <script src="https://cdn.tailwindcss.com/3.4.17"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: { DEFAULT: '#0c1a2e', mid: '#162540', soft: '#1e3a5f' },
                        gold: { DEFAULT: '#c9a84c', light: '#e8c97a', pale: '#f9f3e3' },
                        muted: '#8a9ab5',
                        line: '#d8e0ed',
                        ink: '#1a2540',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['"Cormorant Garamond"', 'serif'],
                    },
                },
            },
        };
    </script>

    <style type="text/tailwindcss">
        /* Shared input style (text, date, select) */
        .field-input {
            @apply w-full rounded border border-line bg-white px-3.5 py-2.5 text-sm text-ink
                   transition focus:border-gold focus:outline-none focus:ring-4 focus:ring-gold/15;
        }
        /* Toggled from JS on invalid fields */
        .input-error {
            @apply !border-red-500 !bg-red-50;
        }
        .error-msg {
            @apply mt-1 hidden text-xs font-semibold text-red-600;
        }
    </style>
</head>
<body class="m-0 min-h-screen bg-[#f0f3f8] font-sans text-ink">

    <!-- NAVBAR -->
    <nav class="bg-navy shadow-[0_2px_24px_rgba(0,0,0,0.3)]">
        <div class="mx-auto flex h-[68px] w-full max-w-[1200px] items-center justify-between px-4 sm:px-8">
            <a href="{{ url('/') }}" class="flex items-center gap-2.5 no-underline">
                <div class="flex h-[38px] w-[38px] items-center justify-center rounded-lg bg-gradient-to-br from-gold to-gold-light text-base text-navy">
                    <i class="fa-solid fa-hotel"></i>
                </div>
                <div class="flex flex-col leading-none">
                    <span class="font-display text-xl font-bold tracking-wider text-white">Grand Nusantara</span>
                    <span class="text-[0.6rem] font-medium uppercase tracking-[2px] text-gold">Luxury Hotel &amp; Resort</span>
                </div>
            </a>
            <div class="flex items-center gap-2.5">
                <a href="{{ url('/') }}"
                   class="inline-flex items-center gap-1.5 rounded-full border border-white/15 px-[18px] py-[7px] text-[0.8rem] font-medium text-white/70 no-underline transition hover:bg-white/10 hover:text-white">
                    <i class="fa-solid fa-house"></i> <span class="hidden sm:inline">Beranda</span>
                </a>
                <a href="{{ route('pesanan.index') }}"
                   class="inline-flex items-center gap-1.5 rounded-full border border-white/15 px-[18px] py-[7px] text-[0.8rem] font-medium text-white/70 no-underline transition hover:bg-white/10 hover:text-white">
                    <i class="fa-solid fa-list"></i> <span class="hidden sm:inline">Data Pesanan</span>
                </a>
                <a href="{{ route('pesanan.show', $pesanan->id) }}"
                   class="inline-flex items-center gap-1.5 rounded-full bg-gradient-to-br from-gold to-gold-light px-[18px] py-[7px] text-[0.8rem] font-semibold text-navy no-underline">
                    <i class="fa-solid fa-eye"></i> <span class="hidden sm:inline">Lihat Bukti</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- PAGE HEADER -->
    <header class="relative overflow-hidden bg-gradient-to-br from-navy to-navy-mid pb-8 pt-10 text-center">
        <div class="absolute inset-0"
             style="background-image:url(&quot;data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23c9a84c' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E&quot;)"></div>
        <div class="relative">
            <p class="mb-2 text-[0.65rem] font-semibold uppercase tracking-[4px] text-gold">
                <i class="fa-solid fa-pen mr-1"></i> Edit Reservasi
            </p>
            <h1 class="mb-1.5 font-display text-4xl font-bold text-white">Edit Form Pemesanan</h1>
            <p class="text-[0.85rem] text-white/50">Perbarui data pemesanan kamar tamu</p>
            <div class="mx-auto mt-3.5 h-0.5 w-12 bg-gradient-to-r from-transparent via-gold to-transparent"></div>
        </div>
    </header>

    <main class="mx-auto w-full px-4">
        <div class="mx-auto mb-12 mt-8 max-w-[700px] overflow-hidden rounded-xl border border-line bg-white shadow-[0_4px_32px_rgba(12,26,46,0.10)]">

            <!-- Card header (red = edit mode) -->
            <div class="flex items-center gap-2.5 bg-gradient-to-r from-[#c0392b] to-[#96281b] px-8 py-[1.1rem]">
                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-white/15 text-[0.85rem] text-white">
                    <i class="fa-solid fa-pen-to-square"></i>
                </div>
                <h5 class="m-0 font-display text-[1.15rem] font-semibold tracking-wide text-white">Edit Data Pesanan — #{{ $pesanan->id }}</h5>
            </div>

            <div class="px-5 pb-9 pt-8 sm:px-9">

                <!-- Edit notice -->
                <div class="mb-6 flex items-center gap-2.5 rounded border border-l-[3px] border-gold/30 border-l-gold bg-amber-50 px-4 py-3 text-[0.82rem] text-[#92700a]">
                    <i class="fa-solid fa-circle-info"></i>
                    <span>Anda sedang mengedit pesanan atas nama <strong>{{ $pesanan->nama }}</strong>. Total bayar akan dihitung otomatis saat Anda mengubah data.</span>
                </div>

                @if ($errors->any())
                    <div class="mb-6 rounded border border-l-[3px] border-red-300 border-l-red-500 bg-[#fff3f3] px-5 py-4">
                        <div class="mb-1.5 text-[0.85rem] font-bold text-red-800">
                            <i class="fa-solid fa-triangle-exclamation mr-2"></i>Perbaiki kesalahan berikut:
                        </div>
                        <ul class="m-0 list-disc pl-5 text-[0.82rem] text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('pesanan.update', $pesanan->id) }}" method="POST" id="bookingForm" onsubmit="return validateFormSubmit(event)">
                    @csrf
                    @method('PUT')

                    <!-- Nama Pemesan -->
                    <div class="mb-[1.1rem] grid items-start gap-2.5 sm:grid-cols-[160px_1fr]">
                        <label for="nama" class="pt-2.5 text-[0.82rem] font-semibold uppercase tracking-wide text-navy">
                            Nama Pemesan <span class="ml-0.5 text-red-600">*</span>
                        </label>
                        <div>
                            <input type="text" class="field-input" id="nama" name="nama"
                                   value="{{ old('nama', $pesanan->nama) }}" placeholder="Masukkan nama lengkap"
                                   oninput="validateNamaInput(this)" onkeypress="return blockNumbers(event)" required>
                            <div id="namaError" class="error-msg"><i class="fa-solid fa-xmark mr-1"></i>Nama tidak boleh mengandung angka</div>
                        </div>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="mb-[1.1rem] grid items-start gap-2.5 sm:grid-cols-[160px_1fr]">
                        <div class="pt-2.5 text-[0.82rem] font-semibold uppercase tracking-wide text-navy">
                            Jenis Kelamin <span class="ml-0.5 text-red-600">*</span>
                        </div>
                        <div class="flex gap-6 pt-2">
                            <div class="flex items-center gap-[7px]">
                                <input type="radio" name="kelamin" id="kelamin_l" value="Laki-laki"
                                       class="h-4 w-4 cursor-pointer accent-gold"
                                       {{ old('kelamin', $pesanan->kelamin) == 'Laki-laki' ? 'checked' : '' }} required>
                                <label for="kelamin_l" class="cursor-pointer text-sm font-medium">Laki-laki</label>
                            </div>
                            <div class="flex items-center gap-[7px]">
                                <input type="radio" name="kelamin" id="kelamin_p" value="Perempuan"
                                       class="h-4 w-4 cursor-pointer accent-gold"
                                       {{ old('kelamin', $pesanan->kelamin) == 'Perempuan' ? 'checked' : '' }} required>
                                <label for="kelamin_p" class="cursor-pointer text-sm font-medium">Perempuan</label>
                            </div>
                        </div>
                    </div>

                    <!-- Nomor Identitas -->
                    <div class="mb-[1.1rem] grid items-start gap-2.5 sm:grid-cols-[160px_1fr]">
                        <label for="nomor_identitas" class="pt-2.5 text-[0.82rem] font-semibold uppercase tracking-wide text-navy">
                            Nomor Identitas <span class="ml-0.5 text-red-600">*</span>
                        </label>
                        <div>
                            <input type="text" class="field-input" id="nomor_identitas" name="nomor_identitas"
                                   maxlength="16" value="{{ old('nomor_identitas', $pesanan->nomor_identitas) }}"
                                   placeholder="16 digit NIK" oninput="this.value = this.value.replace(/\D/g, ''); validateIdentityInput();"
                                   onblur="validateNikBlur(this)" onkeypress="return isNumberKey(event)" required>
                            <div id="identitasError" class="error-msg"><i class="fa-solid fa-xmark mr-1"></i>isian salah..data harus 16 digit</div>
                        </div>
                    </div>

                    <!-- Tipe Kamar -->
                    <div class="mb-[1.1rem] grid items-start gap-2.5 sm:grid-cols-[160px_1fr]">
                        <label for="tipe_kamar" class="pt-2.5 text-[0.82rem] font-semibold uppercase tracking-wide text-navy">
                            Tipe Kamar <span class="ml-0.5 text-red-600">*</span>
                        </label>
                        <div>
                            <select class="field-input" id="tipe_kamar" name="tipe_kamar" onchange="updateHarga()" required>
                                <option value="">— Pilih Tipe Kamar —</option>
                                <option value="Standar" {{ old('tipe_kamar', $pesanan->tipe_kamar) == 'Standar' || old('tipe_kamar', $pesanan->tipe_kamar) == 'Standard' ? 'selected' : '' }}>STANDAR — Rp 500.000 / malam</option>
                                <option value="Deluxe"  {{ old('tipe_kamar', $pesanan->tipe_kamar) == 'Deluxe' ? 'selected' : '' }}>DELUXE — Rp 1.000.000 / malam</option>
                                <option value="Family"  {{ old('tipe_kamar', $pesanan->tipe_kamar) == 'Family' || old('tipe_kamar', $pesanan->tipe_kamar) == 'Executive' || old('tipe_kamar', $pesanan->tipe_kamar) == 'Executif' ? 'selected' : '' }}>FAMILY / EXECUTIF — Rp 1.500.000 / malam</option>
                            </select>
                        </div>
                    </div>

                    <!-- Harga -->
                    <div class="mb-[1.1rem] grid items-start gap-2.5 sm:grid-cols-[160px_1fr]">
                        <label for="harga_display" class="pt-2.5 text-[0.82rem] font-semibold uppercase tracking-wide text-navy">Harga / Malam</label>
                        <div>
                            <input type="text" class="field-input !border-gold/30 !bg-gold-pale font-semibold text-navy"
                                   id="harga_display" readonly value="{{ number_format($pesanan->harga, 0, ',', '.') }}">
                            <input type="hidden" id="harga" name="harga" value="{{ $pesanan->harga }}">
                        </div>
                    </div>

                    <!-- Tanggal Pesan -->
                    <div class="mb-[1.1rem] grid items-start gap-2.5 sm:grid-cols-[160px_1fr]">
                        <label for="tanggal_pesan" class="pt-2.5 text-[0.82rem] font-semibold uppercase tracking-wide text-navy">
                            Tanggal Pesan <span class="ml-0.5 text-red-600">*</span>
                        </label>
                        <div>
                            <input type="date" class="field-input" id="tanggal_pesan" name="tanggal_pesan"
                                   value="{{ old('tanggal_pesan', $pesanan->tanggal_pesan ? \Carbon\Carbon::parse($pesanan->tanggal_pesan)->format('Y-m-d') : date('Y-m-d')) }}"
                                   min="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>

                    <!-- Durasi Menginap -->
                    <div class="mb-[1.1rem] grid items-start gap-2.5 sm:grid-cols-[160px_1fr]">
                        <label for="durasi_menginap" class="pt-2.5 text-[0.82rem] font-semibold uppercase tracking-wide text-navy">
                            Durasi Menginap <span class="ml-0.5 text-red-600">*</span>
                        </label>
                        <div>
                            <div class="flex">
                                <input type="text" inputmode="numeric" class="field-input !rounded-r-none" id="durasi_menginap" name="durasi_menginap"
                                       value="{{ old('durasi_menginap', $pesanan->durasi_menginap) }}"
                                       oninput="this.value = this.value.replace(/\D/g, ''); validateDurasiInput(); kalkulasiTotal(false);"
                                       onkeypress="return isNumberKey(event)" required>
                                <span class="flex items-center rounded-r border border-l-0 border-line bg-gold-pale px-3.5 text-[0.82rem] font-semibold text-navy">Malam</span>
                            </div>
                            <div id="durasiError" class="error-msg"><i class="fa-solid fa-xmark mr-1"></i>harus isi angka</div>
                        </div>
                    </div>

                    <!-- Termasuk Breakfast -->
                    <div class="mb-[1.1rem] grid items-start gap-2.5 sm:grid-cols-[160px_1fr]">
                        <div class="pt-2.5 text-[0.82rem] font-semibold uppercase tracking-wide text-navy">Breakfast</div>
                        <div>
                            <div class="flex items-center gap-2.5 pt-2">
                                <input type="checkbox" id="termasuk_breakfast" name="termasuk_breakfast"
                                       class="h-[17px] w-[17px] cursor-pointer accent-gold"
                                       value="1" {{ old('termasuk_breakfast', $pesanan->termasuk_breakfast) ? 'checked' : '' }}
                                       onchange="kalkulasiTotal(false)">
                                <label for="termasuk_breakfast" class="cursor-pointer text-sm font-medium">Termasuk Sarapan Pagi</label>
                            </div>
                            <div class="mt-1 text-xs text-muted" id="breakfastNote">Tambahan Rp 80.000 / malam jika dipilih</div>
                        </div>
                    </div>

                    <hr class="my-6 border-0 border-t border-dashed border-line">

                    <!-- Total Bayar -->
                    <div class="mb-[1.1rem] grid items-center gap-2.5 sm:grid-cols-[160px_1fr]">
                        <div class="text-[0.82rem] font-semibold uppercase tracking-wide text-navy">Total Bayar</div>
                        <div>
                            <div class="flex items-center justify-between rounded-lg bg-gradient-to-br from-navy to-navy-soft px-[1.4rem] py-[1.1rem]">
                                <div>
                                    <div class="text-xs font-semibold uppercase tracking-[1.5px] text-white/60">Total Pembayaran</div>
                                    <div class="font-display text-[1.75rem] font-bold text-gold-light" id="total_display">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</div>
                                </div>
                                <i class="fa-solid fa-coins text-[1.6rem] text-gold-light opacity-60"></i>
                            </div>
                            <input type="hidden" id="total_bayar" name="total_bayar" value="{{ $pesanan->total_harga }}">
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="mt-4 flex flex-wrap items-center gap-2.5 pt-2">
                        <button type="submit"
                                class="flex items-center gap-[7px] rounded bg-gradient-to-br from-gold to-gold-light px-7 py-2.5 text-[0.85rem] font-bold text-navy transition hover:-translate-y-px hover:from-gold-light hover:to-gold">
                            <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('pesanan.show', $pesanan->id) }}"
                           class="flex items-center gap-[7px] rounded border border-line bg-transparent px-[22px] py-2.5 text-[0.85rem] font-medium text-muted no-underline transition hover:border-navy hover:text-navy">
                            <i class="fa-solid fa-xmark"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        const hargaMap = {
            'Standar':   500000,
            'Standard':  500000,
            'Deluxe':   1000000,
            'Family':   1500000,
            'Executive':1500000,
            'Executif': 1500000
        };

        function fmt(num) {
            return 'Rp ' + Math.round(num).toLocaleString('id-ID');
        }

        function isNumberKey(evt) {
            const charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }

        function blockNumbers(evt) {
            const charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode >= 48 && charCode <= 57) {
                const err = document.getElementById('namaError');
                if (err) {
                    err.style.display = 'block';
                    setTimeout(() => { if (!/\d/.test(document.getElementById('nama').value)) err.style.display = 'none'; }, 2000);
                }
                return false;
            }
            return true;
        }

        function validateNamaInput(input) {
            const err = document.getElementById('namaError');
            if (/\d/.test(input.value)) {
                if (err) err.style.display = 'block';
                input.value = input.value.replace(/\d/g, '');
            } else {
                if (err) err.style.display = 'none';
            }
        }

        function getBreakfastFee(durasi, hasBreakfast) {
            if (!hasBreakfast || durasi <= 0) return 0;
            return 80000 * durasi;
        }

        function updateHarga() {
            const tipe = document.getElementById('tipe_kamar').value;
            const harga = hargaMap[tipe] || 0;
            document.getElementById('harga').value = harga;
            document.getElementById('harga_display').value = harga > 0 ? Math.round(harga).toLocaleString('id-ID') : '';
            kalkulasiTotal(false);
        }

        function validateIdentityInput() {
            const input = document.getElementById('nomor_identitas');
            const errorDiv = document.getElementById('identitasError');
            const val = input.value.trim();
            const isNumeric = /^\d+$/.test(val);
            if (val.length === 16 && isNumeric) {
                input.classList.remove('input-error');
                errorDiv.style.display = 'none';
                return true;
            } else if (val.length > 0 && (!isNumeric || val.length > 16)) {
                input.classList.add('input-error');
                errorDiv.style.display = 'block';
                return false;
            }
            return false;
        }

        // Show NIK error when the user leaves the field with fewer than 16 digits
        function validateNikBlur(input) {
            const errorDiv = document.getElementById('identitasError');
            const val = input.value.trim();
            if (val.length > 0 && val.length < 16) {
                input.classList.add('input-error');
                errorDiv.style.display = 'block';
            } else if (val.length === 16) {
                input.classList.remove('input-error');
                errorDiv.style.display = 'none';
            }
        }

        function validateDurasiInput() {
            const input = document.getElementById('durasi_menginap');
            const errorDiv = document.getElementById('durasiError');
            const num = parseInt(input.value.trim(), 10);
            if (isNaN(num) || num <= 0) {
                input.classList.add('input-error');
                errorDiv.style.display = 'block';
                kalkulasiTotal(false);
                return false;
            }
            input.classList.remove('input-error');
            errorDiv.style.display = 'none';
            kalkulasiTotal(false);
            return true;
        }

        function kalkulasiTotal(showAlert = false) {
            const tipe   = document.getElementById('tipe_kamar').value;
            const harga  = parseInt(document.getElementById('harga').value, 10) || 0;
            const durasi = parseInt(document.getElementById('durasi_menginap').value, 10) || 0;
            const hasBreakfast = document.getElementById('termasuk_breakfast').checked;

            if (!tipe || durasi <= 0) {
                document.getElementById('total_display').textContent = 'Rp 0';
                document.getElementById('total_bayar').value = 0;
                if (showAlert) {
                    if (!tipe) alert('Peringatan: Silakan pilih Tipe Kamar terlebih dahulu!');
                    else if (durasi <= 0) alert('Peringatan: harus isi angka');
                }
                return false;
            }

            const subtotal     = harga * durasi;
            const discount     = durasi >= 3 ? subtotal * 0.10 : 0;
            const breakfastFee = getBreakfastFee(durasi, hasBreakfast);
            const total        = subtotal - discount + breakfastFee;

            document.getElementById('total_display').textContent = fmt(total);
            document.getElementById('total_bayar').value = total;

            const note = document.getElementById('breakfastNote');
            if (hasBreakfast && durasi > 0) {
                note.textContent = `Breakfast: ${fmt(breakfastFee)} (${durasi} malam × Rp 80.000)`;
            } else {
                note.textContent = 'Tambahan Rp 80.000 / malam jika dipilih';
            }

            if (showAlert) {
                const breakfastLine = hasBreakfast
                    ? `Breakfast (${durasi} malam × Rp 80.000): ${fmt(breakfastFee)}`
                    : 'Breakfast: Tidak';
                alert(
                    `✦ Rincian Total Bayar ✦\n\n` +
                    `Tarif Kamar : ${fmt(harga)} / malam\n` +
                    `Durasi      : ${durasi} malam\n` +
                    `Subtotal    : ${fmt(subtotal)}\n` +
                    `Diskon 10%  : ${durasi >= 3 ? '- ' + fmt(discount) : 'Tidak berlaku (< 3 malam)'}\n` +
                    `${breakfastLine}\n` +
                    `─────────────────────\n` +
                    `TOTAL BAYAR : ${fmt(total)}`
                );
            }
            return true;
        }

        function validateFormSubmit(e) {
            const nama = document.getElementById('nama');
            const nik  = document.getElementById('nomor_identitas');
            const dur  = document.getElementById('durasi_menginap');
            const tipe = document.getElementById('tipe_kamar');

            if (!nama.value.trim() || /\d/.test(nama.value)) {
                alert('Peringatan: Nama pemesan tidak boleh kosong dan tidak boleh mengandung angka!');
                nama.classList.add('input-error');
                const errNama = document.getElementById('namaError');
                if (errNama) errNama.style.display = 'block';
                nama.focus(); e.preventDefault(); return false;
            }

            if (!tipe.value) { alert('Peringatan: Tipe Kamar harus dipilih!'); tipe.focus(); e.preventDefault(); return false; }
            const valNik = nik.value.trim();
            if (valNik.length !== 16 || !/^\d+$/.test(valNik)) {
                alert('isian salah..data harus 16 digit');
                nik.classList.add('input-error');
                document.getElementById('identitasError').style.display = 'block';
                nik.focus(); e.preventDefault(); return false;
            }
            const valDur = parseInt(dur.value, 10);
            if (isNaN(valDur) || valDur <= 0) {
                alert('harus isi angka');
                dur.classList.add('input-error');
                document.getElementById('durasiError').style.display = 'block';
                dur.focus(); e.preventDefault(); return false;
            }
            kalkulasiTotal(false);
            return true;
        }

        // Initialize on load: show the breakfast note for the saved values
        document.addEventListener('DOMContentLoaded', function() {
            const dur = parseInt(document.getElementById('durasi_menginap').value, 10) || 0;
            const hasBreakfast = document.getElementById('termasuk_breakfast').checked;
            const note = document.getElementById('breakfastNote');
            if (hasBreakfast && dur > 0) {
                const fee = 80000 * dur;
                note.textContent = `Breakfast: Rp ${Math.round(fee).toLocaleString('id-ID')} (${dur} malam × Rp 80.000)`;
            } else {
                note.textContent = 'Tambahan Rp 80.000 / malam jika dipilih';
            }
        });
    </script>
</body>
</html>