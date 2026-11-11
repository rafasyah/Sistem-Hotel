<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pemesanan — Grand Hotel Nusantara</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --navy: #0c1a2e;
            --navy-mid: #162540;
            --gold: #c9a84c;
            --gold-light: #e8c97a;
            --gold-pale: #f9f3e3;
            --cream: #fdfaf4;
            --muted: #8a9ab5;
            --border: #d8e0ed;
            --text: #1a2540;
            --radius: 4px;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f3f8;
            color: var(--text);
            margin: 0;
            min-height: 100vh;
        }

        /* ── NAVBAR ── */
        .navbar-luxury {
            background: var(--navy);
            padding: 0;
            box-shadow: 0 2px 24px rgba(0,0,0,0.3);
        }
        .navbar-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            height: 68px;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }
        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }
        .brand-icon {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            color: var(--navy);
        }
        .brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1;
        }
        .brand-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.25rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: 1px;
        }
        .brand-sub {
            font-size: 0.6rem;
            color: var(--gold);
            letter-spacing: 2px;
            text-transform: uppercase;
            font-weight: 500;
        }
        .nav-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .btn-nav {
            padding: 7px 18px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
        }
        .btn-nav-ghost {
            background: transparent;
            color: rgba(255,255,255,0.7);
            border: 1px solid rgba(255,255,255,0.15);
        }
        .btn-nav-ghost:hover {
            background: rgba(255,255,255,0.08);
            color: #fff;
        }
        .btn-nav-gold {
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            color: var(--navy);
            font-weight: 600;
        }
        .btn-nav-gold:hover {
            background: linear-gradient(135deg, var(--gold-light), var(--gold));
            color: var(--navy);
        }

        /* ── PAGE HEADER ── */
        .page-header {
            background: linear-gradient(135deg, var(--navy) 0%, var(--navy-mid) 100%);
            padding: 2.5rem 0 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .page-header::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23c9a84c' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .page-header-label {
            font-size: 0.65rem;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--gold);
            font-weight: 600;
            margin-bottom: 8px;
        }
        .page-header h1 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: #fff;
            margin: 0 0 6px;
        }
        .page-header p {
            color: rgba(255,255,255,0.5);
            font-size: 0.85rem;
            margin: 0;
        }
        .gold-divider {
            width: 48px;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
            margin: 14px auto 0;
        }

        /* ── FORM CARD ── */
        .form-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 32px rgba(12,26,46,0.10);
            overflow: hidden;
            max-width: 700px;
            margin: 2rem auto 3rem;
        }
        .form-card-header {
            background: linear-gradient(90deg, var(--navy) 0%, #1e3a5f 100%);
            padding: 1.1rem 2rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .form-card-header .header-icon {
            width: 32px;
            height: 32px;
            background: rgba(201,168,76,0.15);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold);
            font-size: 0.85rem;
        }
        .form-card-header h5 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.15rem;
            color: #fff;
            margin: 0;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .form-card-body {
            padding: 2rem 2.25rem 2.25rem;
        }

        /* ── FORM FIELDS ── */
        .field-row {
            display: grid;
            grid-template-columns: 160px 1fr;
            align-items: start;
            gap: 10px;
            margin-bottom: 1.1rem;
        }
        .field-label {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--navy);
            padding-top: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .field-label .req {
            color: var(--gold);
            margin-left: 2px;
        }
        .form-control, .form-select {
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 9px 13px;
            font-size: 0.88rem;
            color: var(--text);
            transition: border-color 0.2s, box-shadow 0.2s;
            background: #fff;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(201,168,76,0.12);
            outline: none;
        }
        .form-control.readonly-field {
            background: var(--gold-pale);
            border-color: rgba(201,168,76,0.3);
            color: var(--navy);
            font-weight: 600;
        }
        .input-group-text {
            background: var(--gold-pale);
            border-color: var(--border);
            color: var(--navy);
            font-size: 0.82rem;
            font-weight: 600;
        }
        .radio-group {
            display: flex;
            gap: 1.5rem;
            padding-top: 8px;
        }
        .radio-option {
            display: flex;
            align-items: center;
            gap: 7px;
            cursor: pointer;
        }
        .radio-option input[type="radio"] {
            width: 16px;
            height: 16px;
            accent-color: var(--gold);
        }
        .radio-option label {
            font-size: 0.88rem;
            cursor: pointer;
            font-weight: 500;
        }
        .checkbox-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
            padding-top: 8px;
        }
        .checkbox-wrap input[type="checkbox"] {
            width: 17px;
            height: 17px;
            accent-color: var(--gold);
            cursor: pointer;
        }
        .checkbox-label {
            font-size: 0.88rem;
            font-weight: 500;
            cursor: pointer;
        }
        .breakfast-note {
            font-size: 0.75rem;
            color: var(--muted);
            margin-top: 4px;
        }
        .error-msg {
            font-size: 0.75rem;
            color: #d94040;
            font-weight: 600;
            margin-top: 4px;
            display: none;
        }
        .input-error {
            border-color: #d94040 !important;
            background: #fff8f8 !important;
        }

        /* ── TOTAL DISPLAY ── */
        .total-display {
            background: linear-gradient(135deg, var(--navy) 0%, #1e3a5f 100%);
            border-radius: 8px;
            padding: 1.1rem 1.4rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .total-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: rgba(255,255,255,0.6);
            font-weight: 600;
        }
        .total-amount {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--gold-light);
            transition: all 0.25s ease;
        }
        .total-amount.bump {
            transform: scale(1.04);
            color: #fff;
        }
        .total-breakdown {
            font-size: 0.72rem;
            color: rgba(255,255,255,0.45);
            margin-top: 3px;
            min-height: 1em;
        }
        .total-hidden { display: none; }

        /* ── DIVIDER ── */
        .section-divider {
            border: none;
            border-top: 1px dashed var(--border);
            margin: 1.5rem 0;
        }

        /* ── BUTTONS ── */
        .btn-calculate {
            background: transparent;
            color: var(--navy);
            border: 1px solid rgba(12, 26, 46, 0.25);
            padding: 10px 20px;
            border-radius: var(--radius);
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 7px;
        }
        .btn-calculate:hover {
            border-color: var(--navy);
            background: var(--navy);
            color: #fff;
        }
        .btn-save {
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            color: var(--navy);
            border: none;
            padding: 10px 28px;
            border-radius: var(--radius);
            font-size: 0.85rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 7px;
        }
        .btn-save:hover { background: linear-gradient(135deg, var(--gold-light), var(--gold)); transform: translateY(-1px); }

        .btn-reset {
            background: transparent;
            color: var(--muted);
            border: 1px solid var(--border);
            padding: 10px 22px;
            border-radius: var(--radius);
            font-size: 0.85rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 7px;
        }
        .btn-reset:hover { border-color: var(--navy); color: var(--navy); }

        .action-bar {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            padding-top: 0.5rem;
        }

        /* ── ALERT ── */
        .alert-luxury {
            background: #fff3f3;
            border: 1px solid #fca5a5;
            border-left: 3px solid #ef4444;
            border-radius: var(--radius);
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
        }
        .alert-luxury .alert-title {
            font-weight: 700;
            color: #991b1b;
            font-size: 0.85rem;
            margin-bottom: 6px;
        }
        .alert-luxury ul {
            margin: 0;
            padding-left: 1.25rem;
            font-size: 0.82rem;
            color: #b91c1c;
        }

        /* ── ROOM PREVIEW ── */
        .room-preview {
            display: none;
            background: var(--gold-pale);
            border: 1px solid rgba(201,168,76,0.3);
            border-radius: var(--radius);
            padding: 10px 14px;
            margin-top: 8px;
            font-size: 0.8rem;
            color: var(--navy);
        }
        .room-preview.show { display: block; }
        .room-preview strong { color: var(--gold); }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar-luxury">
        <div class="navbar-inner">
            <a href="{{ url('/') }}" class="brand">
                <div class="brand-icon"><i class="fa-solid fa-hotel"></i></div>
                <div class="brand-text">
                    <span class="brand-name">Grand Nusantara</span>
                    <span class="brand-sub">Luxury Hotel & Resort</span>
                </div>
            </a>
            <div class="nav-actions">
                <a href="{{ url('/') }}" class="btn-nav btn-nav-ghost"><i class="fa-solid fa-house me-1"></i> Beranda</a>
                <a href="{{ route('pesanan.index') }}" class="btn-nav btn-nav-gold"><i class="fa-solid fa-list me-1"></i> Data Pesanan</a>
            </div>
        </div>
    </nav>

    <!-- PAGE HEADER -->
    <div class="page-header">
        <p class="page-header-label"><i class="fa-solid fa-star me-1"></i> Reservasi Eksklusif</p>
        <h1>Form Pemesanan Kamar</h1>
        <p>Lengkapi formulir di bawah untuk memesan kamar Anda</p>
        <div class="gold-divider"></div>
    </div>

    <div class="container">
        <div class="form-card">
            <div class="form-card-header">
                <div class="header-icon"><i class="fa-solid fa-clipboard-list"></i></div>
                <h5>Detail Pemesanan</h5>
            </div>

            <div class="form-card-body">
                @if ($errors->any())
                    <div class="alert-luxury">
                        <div class="alert-title"><i class="fa-solid fa-triangle-exclamation me-2"></i>Perbaiki kesalahan berikut:</div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('pesanan.store') }}" method="POST" id="bookingForm" onsubmit="return validateFormSubmit(event)">
                    @csrf

                    <!-- 1. Nama Pemesan -->
                    <div class="field-row">
                        <div class="field-label">Nama Pemesan <span class="req">*</span></div>
                        <div>
                            <input type="text" class="form-control" id="nama" name="nama"
                                   value="{{ old('nama') }}" placeholder="Masukkan nama lengkap"
                                   oninput="validateNamaInput(this)" onkeypress="return blockNumbers(event)" required>
                            <div id="namaError" class="error-msg"><i class="fa-solid fa-xmark me-1"></i>Nama tidak boleh mengandung angka</div>
                        </div>
                    </div>

                    <!-- 2. Jenis Kelamin -->
                    <div class="field-row">
                        <div class="field-label">Jenis Kelamin <span class="req">*</span></div>
                        <div class="radio-group">
                            <label class="radio-option">
                                <input type="radio" name="kelamin" id="kelamin_l" value="Laki-laki"
                                       {{ old('kelamin', 'Laki-laki') == 'Laki-laki' ? 'checked' : '' }} required>
                                <label for="kelamin_l">Laki-laki</label>
                            </label>
                            <label class="radio-option">
                                <input type="radio" name="kelamin" id="kelamin_p" value="Perempuan"
                                       {{ old('kelamin') == 'Perempuan' ? 'checked' : '' }} required>
                                <label for="kelamin_p">Perempuan</label>
                            </label>
                        </div>
                    </div>

                    <!-- 3. Nomor Identitas -->
                    <div class="field-row">
                        <div class="field-label">Nomor Identitas <span class="req">*</span></div>
                        <div>
                            <input type="text" class="form-control" id="nomor_identitas" name="nomor_identitas"
                                   maxlength="16" value="{{ old('nomor_identitas') }}"
                                   placeholder="16 digit NIK" oninput="this.value = this.value.replace(/\D/g, ''); validateIdentityInput();"
                                   onblur="validateNikBlur(this)" onkeypress="return isNumberKey(event)" required>
                            <div id="identitasError" class="error-msg"><i class="fa-solid fa-xmark me-1"></i>isian salah..data harus 16 digit</div>
                        </div>
                    </div>

                    <!-- 4. Tipe Kamar -->
                    <div class="field-row">
                        <div class="field-label">Tipe Kamar <span class="req">*</span></div>
                        <div>
                            <select class="form-select" id="tipe_kamar" name="tipe_kamar"
                                    onchange="updateHargaDanKalkulasi()" required>
                                <option value="">— Pilih Tipe Kamar —</option>
                                <option value="Standar" {{ old('tipe_kamar') == 'Standar' || old('tipe_kamar') == 'Standard' ? 'selected' : '' }}>STANDAR — Rp 500.000 / malam</option>
                                <option value="Deluxe"  {{ old('tipe_kamar') == 'Deluxe' ? 'selected' : '' }}>DELUXE — Rp 1.000.000 / malam</option>
                                <option value="Family"  {{ old('tipe_kamar') == 'Family' || old('tipe_kamar') == 'Executive' || old('tipe_kamar') == 'Executif' ? 'selected' : '' }}>FAMILY / EXECUTIF — Rp 1.500.000 / malam</option>
                            </select>
                            <div id="roomPreview" class="room-preview"></div>
                        </div>
                    </div>

                    <!-- 5. Harga -->
                    <div class="field-row">
                        <div class="field-label">Harga / Malam</div>
                        <div>
                            <input type="text" class="form-control readonly-field" id="harga_display" readonly placeholder="Rp 0">
                            <input type="hidden" id="harga" name="harga" value="{{ old('harga', 0) }}">
                        </div>
                    </div>

                    <!-- 6. Tanggal Pesan -->
                    <div class="field-row">
                        <div class="field-label">Tanggal Pesan <span class="req">*</span></div>
                        <div>
                            <input type="date" class="form-control" id="tanggal_pesan" name="tanggal_pesan"
                                   value="{{ old('tanggal_pesan', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>

                    <!-- 7. Durasi Menginap -->
                    <div class="field-row">
                        <div class="field-label">Durasi Menginap <span class="req">*</span></div>
                        <div>
                            <div class="input-group">
                                <input type="text" inputmode="numeric" class="form-control" id="durasi_menginap" name="durasi_menginap"
                                       value="{{ old('durasi_menginap', 3) }}"
                                       oninput="this.value = this.value.replace(/\D/g, ''); validateDurasiInput(); kalkulasiTotal(false);"
                                       onkeypress="return isNumberKey(event)" required>
                                <span class="input-group-text">Malam</span>
                            </div>
                            <div id="durasiError" class="error-msg"><i class="fa-solid fa-xmark me-1"></i>harus isi angka</div>
                        </div>
                    </div>

                    <!-- 8. Termasuk Breakfast -->
                    <div class="field-row">
                        <div class="field-label">Breakfast</div>
                        <div>
                            <div class="checkbox-wrap">
                                <input type="checkbox" id="termasuk_breakfast" name="termasuk_breakfast"
                                       value="1" {{ old('termasuk_breakfast', '1') == '1' ? 'checked' : '' }}
                                       onchange="kalkulasiTotal(false)">
                                <label class="checkbox-label" for="termasuk_breakfast">Termasuk Sarapan Pagi</label>
                            </div>
                            <div class="breakfast-note" id="breakfastNote">Tambahan Rp 80.000 / malam jika dipilih</div>
                        </div>
                    </div>

                    <hr class="section-divider">

                    <!-- 9. Total Bayar -->
                    <div class="field-row" style="align-items:center;">
                        <div class="field-label">Total Bayar</div>
                        <div>
                            <div class="total-display">
                                <div>
                                    <div class="total-label">Total Pembayaran</div>
                                    <div class="total-amount" id="total_display">Rp 0</div>
                                </div>
                                <i class="fa-solid fa-coins" style="color:var(--gold-light);font-size:1.6rem;opacity:0.6"></i>
                            </div>
                            <input type="hidden" id="total_bayar" name="total_bayar" value="{{ old('total_bayar', 0) }}">
                        </div>
                    </div>

                    <!-- 10. Tombol Aksi -->
                    <div class="action-bar mt-3">
                        <button type="submit" class="btn-save" id="btnSimpan">
                            <i class="fa-solid fa-floppy-disk"></i> Simpan Pesanan
                        </button>
                        <button type="button" class="btn-reset" onclick="resetForm()">
                            <i class="fa-solid fa-rotate-left"></i> Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const hargaMap = {
            'Standar':   500000,
            'Standard':  500000,
            'Deluxe':   1000000,
            'Family':   1500000,
            'Executive':1500000,
            'Executif': 1500000
        };

        const roomDesc = {
            'Standar':  { desc: 'Kamar nyaman dengan fasilitas standar. Cocok untuk perjalanan bisnis.', beds: '1 Kasur Queen', size: '28 m²' },
            'Deluxe':   { desc: 'Kamar luas dengan pemandangan kota dan fasilitas premium.', beds: '1 Kasur King', size: '36 m²' },
            'Family':   { desc: 'Suite mewah dengan ruang keluarga dan fasilitas eksekutif terlengkap.', beds: '2 Kasur Queen', size: '52 m²' },
            'Executive':   { desc: 'Suite mewah dengan ruang keluarga dan fasilitas eksekutif terlengkap.', beds: '2 Kasur Queen', size: '52 m²' }
        };

        function fmt(num) {
            return 'Rp ' + Math.round(num).toLocaleString('id-ID');
        }

        function updateHargaDanKalkulasi() {
            const tipe = document.getElementById('tipe_kamar').value;
            const harga = hargaMap[tipe] || 0;
            document.getElementById('harga').value = harga;
            document.getElementById('harga_display').value = harga > 0 ? Math.round(harga).toLocaleString('id-ID') : '';

            const preview = document.getElementById('roomPreview');
            const tipeKey = tipe === 'Standard' ? 'Standar' : tipe;
            if (tipe && roomDesc[tipeKey]) {
                const r = roomDesc[tipeKey];
                preview.innerHTML = `<strong>${tipe.toUpperCase()}</strong> &mdash; ${r.desc} &nbsp;|&nbsp; ${r.beds} &nbsp;|&nbsp; ${r.size}`;
                preview.classList.add('show');
            } else {
                preview.classList.remove('show');
            }
            kalkulasiTotal(false);
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

        // Tampil error NIK saat user pindah ke field lain (blur) jika kurang dari 16 digit
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
                return false;
            }
            input.classList.remove('input-error');
            errorDiv.style.display = 'none';
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

            // Update breakfast note
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

        function resetForm() {
            document.getElementById('bookingForm').reset();
            document.getElementById('harga').value = 0;
            document.getElementById('harga_display').value = '';
            document.getElementById('total_bayar').value = 0;
            document.getElementById('total_display').textContent = 'Rp 0';
            document.getElementById('identitasError').style.display = 'none';
            document.getElementById('durasiError').style.display = 'none';
            const errNama = document.getElementById('namaError');
            if (errNama) errNama.style.display = 'none';
            document.getElementById('nama').classList.remove('input-error');
            document.getElementById('nomor_identitas').classList.remove('input-error');
            document.getElementById('durasi_menginap').classList.remove('input-error');
            document.getElementById('roomPreview').classList.remove('show');
            document.getElementById('breakfastNote').textContent = 'Tambahan Rp 80.000 / malam jika dipilih';
        }

        function validateFormSubmit(e) {
            const nama  = document.getElementById('nama');
            const nik   = document.getElementById('nomor_identitas');
            const dur   = document.getElementById('durasi_menginap');
            const tipe  = document.getElementById('tipe_kamar');

            if (!nama.value.trim() || /\d/.test(nama.value)) {
                alert('Peringatan: Nama pemesan tidak boleh kosong dan tidak boleh mengandung angka!');
                nama.classList.add('input-error');
                const errNama = document.getElementById('namaError');
                if (errNama) errNama.style.display = 'block';
                nama.focus(); e.preventDefault(); return false;
            }

            if (!tipe.value) {
                alert('Peringatan: Tipe Kamar harus dipilih!');
                tipe.focus(); e.preventDefault(); return false;
            }
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

        document.addEventListener('DOMContentLoaded', function() {
            updateHargaDanKalkulasi();
        });
    </script>
</body>
</html>
