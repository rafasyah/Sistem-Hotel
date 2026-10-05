<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pemesanan Hotel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #818cf8;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --bg: #f8fafc;
            --card-bg: #ffffff;
            --text: #1e293b;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --radius: 16px;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            padding: 2rem 1rem;
            background-image: 
                radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.08) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(16, 185, 129, 0.06) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(245, 158, 11, 0.05) 0px, transparent 50%);
        }

        .container {
            max-width: 720px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
            animation: fadeInDown 0.6s ease;
        }

        .header-icon {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            box-shadow: 0 8px 24px rgba(99, 102, 241, 0.3);
        }

        .header-icon svg {
            width: 32px;
            height: 32px;
            color: white;
        }

        .header h1 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 0.25rem;
        }

        .header p {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .card {
            background: var(--card-bg);
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            animation: fadeInUp 0.6s ease 0.1s both;
            border: 1px solid rgba(226, 232, 240, 0.6);
        }

        .card-body {
            padding: 2rem;
        }

        .alert {
            padding: 1rem 1.25rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            font-size: 0.9rem;
            animation: slideIn 0.3s ease;
        }

        .alert-danger {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        .alert-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
        }

        .alert svg {
            flex-shrink: 0;
            width: 20px;
            height: 20px;
            margin-top: 1px;
        }

        .alert ul {
            margin: 0;
            padding-left: 1.2rem;
        }

        .alert ul li {
            margin-bottom: 0.25rem;
        }

        .alert ul li:last-child {
            margin-bottom: 0;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
        }

        @media (max-width: 640px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }

        .form-label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 0.5rem;
            letter-spacing: -0.01em;
        }

        .required {
            color: var(--danger);
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1.5px solid var(--border);
            border-radius: 12px;
            font-size: 0.95rem;
            font-family: inherit;
            color: var(--text);
            background: #fafbfc;
            transition: all 0.2s ease;
            outline: none;
        }

        .form-control:hover {
            border-color: #cbd5e1;
        }

        .form-control:focus {
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }

        .form-control::placeholder {
            color: #94a3b8;
        }

        .form-control[readonly] {
            background: #f1f5f9;
            color: var(--text-muted);
            cursor: default;
        }

        select.form-control {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%2364748b' viewBox='0 0 16 16'%3E%3Cpath d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            padding-right: 2.5rem;
        }

        .radio-group {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .radio-option {
            position: relative;
        }

        .radio-option input {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .radio-option label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1rem;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-muted);
            transition: all 0.2s ease;
            background: #fafbfc;
        }

        .radio-option label:hover {
            border-color: var(--primary-light);
            color: var(--primary);
        }

        .radio-option input:checked + label {
            border-color: var(--primary);
            background: rgba(99, 102, 241, 0.06);
            color: var(--primary);
            font-weight: 600;
        }

        .radio-option label svg {
            width: 18px;
            height: 18px;
        }

        .checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            border: 1.5px solid var(--border);
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            background: #fafbfc;
        }

        .checkbox-wrapper:hover {
            border-color: var(--primary-light);
        }

        .checkbox-wrapper input {
            width: 20px;
            height: 20px;
            accent-color: var(--primary);
            cursor: pointer;
            flex-shrink: 0;
        }

        .checkbox-wrapper label {
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text);
            cursor: pointer;
            user-select: none;
        }

        .checkbox-wrapper .price-tag {
            margin-left: auto;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--success);
            background: rgba(16, 185, 129, 0.1);
            padding: 0.25rem 0.6rem;
            border-radius: 6px;
        }

        .total-section {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            border: 2px solid var(--primary);
            border-radius: 14px;
            padding: 1.25rem 1.5rem;
            margin: 2rem 0;
            position: relative;
            overflow: hidden;
        }

        .total-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--primary-light));
        }

        .total-label {
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
            margin-bottom: 0.25rem;
        }

        .total-value {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--primary-dark);
            letter-spacing: -0.02em;
        }

        .btn-group {
            display: flex;
            gap: 0.75rem;
            justify-content: flex-end;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            border: none;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .btn-secondary {
            background: #f1f5f9;
            color: var(--text-muted);
            border: 1.5px solid var(--border);
        }

        .btn-secondary:hover {
            background: #e2e8f0;
            color: var(--text);
            transform: translateY(-1px);
        }

        .btn-calc {
            background: white;
            color: var(--primary);
            border: 1.5px solid var(--primary);
        }

        .btn-calc:hover {
            background: rgba(99, 102, 241, 0.06);
            transform: translateY(-1px);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            box-shadow: 0 4px 14px rgba(99, 102, 241, 0.35);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.45);
        }

        .btn:active {
            transform: translateY(0);
        }

        .room-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 0.5rem;
            padding: 0.5rem 0.75rem;
            background: rgba(99, 102, 241, 0.04);
            border-radius: 8px;
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .room-info.hidden {
            display: none;
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-10px); }
            to { opacity: 1; transform: translateX(0); }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
            </div>
            <h1>Form Pemesanan Hotel</h1>
            <p>Isi detail pemesanan Anda dengan mudah dan cepat</p>
        </div>

        <div class="card">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('pesanan.store') }}">
                    @csrf

                    <div class="form-row">
                        <div class="form-group">
                            <label for="nama" class="form-label">Nama Pemesan <span class="required">*</span></label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama lengkap" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Jenis Kelamin <span class="required">*</span></label>
                            <div class="radio-group">
                                <div class="radio-option">
                                    <input type="radio" name="kelamin" id="kelamin_laki" value="Laki-laki" {{ old('kelamin') == 'Laki-laki' ? 'checked' : '' }}>
                                    <label for="kelamin_laki">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                                        Laki-laki
                                    </label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" name="kelamin" id="kelamin_perempuan" value="Perempuan" {{ old('kelamin') == 'Perempuan' ? 'checked' : '' }}>
                                    <label for="kelamin_perempuan">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                                        Perempuan
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nomor_identitas" class="form-label">Nomor Identitas <span class="required">*</span></label>
                        <input type="text" class="form-control" id="nomor_identitas" name="nomor_identitas" value="{{ old('nomor_identitas') }}" placeholder="Contoh: 3175xxxxxxxxxxxx" required>
                    </div>

                    <div class="form-group">
                        <label for="tipe_kamar" class="form-label">Tipe Kamar <span class="required">*</span></label>
                        <select class="form-control" id="tipe_kamar" name="tipe_kamar" required>
                            <option value="">-- Pilih Tipe Kamar --</option>
                            <option value="Standard" {{ old('tipe_kamar') == 'Standard' ? 'selected' : '' }}>Standard</option>
                            <option value="Deluxe" {{ old('tipe_kamar') == 'Deluxe' ? 'selected' : '' }}>Deluxe</option>
                            <option value="Family" {{ old('tipe_kamar') == 'Family' ? 'selected' : '' }}>Family</option>
                        </select>
                        <div class="room-info hidden" id="roomInfo">
                            <span id="roomDesc">Pilih tipe kamar untuk melihat detail</span>
                            <span id="roomPrice" style="font-weight:600;color:var(--primary);"></span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="harga" class="form-label">Harga per Malam</label>
                            <input type="text" class="form-control" id="harga" name="harga" readonly placeholder="Rp 0">
                        </div>

                        <div class="form-group">
                            <label for="tanggal_pesan" class="form-label">Tanggal Pemesanan <span class="required">*</span></label>
                            <input type="date" class="form-control" id="tanggal_pesan" name="tanggal_pesan" value="{{ old('tanggal_pesan') }}" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="durasi_menginap" class="form-label">Durasi Menginap <span class="required">*</span></label>
                            <input type="number" class="form-control" id="durasi_menginap" name="durasi_menginap" min="1" value="{{ old('durasi_menginap') }}" placeholder="Jumlah malam" required>
                        </div>

                        <div class="form-group" style="display:flex;align-items:flex-end;">
                            <div class="checkbox-wrapper" style="width:100%;">
                                <input type="checkbox" id="termasuk_breakfast" name="termasuk_breakfast" value="1" {{ old('termasuk_breakfast') ? 'checked' : '' }}>
                                <label for="termasuk_breakfast">Termasuk Breakfast</label>
                                <span class="price-tag">+Rp 50.000</span>
                            </div>
                        </div>
                    </div>

                    <div class="total-section">
                        <div class="total-label">Total Pembayaran</div>
                        <div class="total-value" id="total_bayar">Rp 0</div>
                    </div>

                    <div class="btn-group">
                        <a href="{{ route('pesanan.index') }}" class="btn btn-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>
                            Kembali
                        </a>
                        <button type="button" class="btn btn-calc" id="btnHitung">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75l-2.489-2.489m0 0a3.375 3.375 0 10-4.773-4.773 3.375 3.375 0 004.774 4.774zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            Hitung Total
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            Simpan Pesanan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const hargaInput = document.getElementById('harga');
        const tipeKamarSelect = document.getElementById('tipe_kamar');
        const durasiInput = document.getElementById('durasi_menginap');
        const breakfastCheckbox = document.getElementById('termasuk_breakfast');
        const totalDisplay = document.getElementById('total_bayar');
        const hitungButton = document.getElementById('btnHitung');
        const roomInfo = document.getElementById('roomInfo');
        const roomDesc = document.getElementById('roomDesc');
        const roomPrice = document.getElementById('roomPrice');

        const hargaMap = {
            'Standard': { harga: 500000, desc: 'Kamar nyaman dengan fasilitas standar' },
            'Deluxe': { harga: 1000000, desc: 'Kamar luas dengan pemandangan indah' },
            'Family': { harga: 1500000, desc: 'Kamar besar untuk keluarga' }
        };

        function formatRupiah(angka) {
            return 'Rp ' + angka.toLocaleString('id-ID');
        }

        function setHargaFromTipeKamar() {
            const tipe = tipeKamarSelect.value;
            if (tipe && hargaMap[tipe]) {
                hargaInput.value = formatRupiah(hargaMap[tipe].harga);
                roomDesc.textContent = hargaMap[tipe].desc;
                roomPrice.textContent = formatRupiah(hargaMap[tipe].harga) + '/malam';
                roomInfo.classList.remove('hidden');
            } else {
                hargaInput.value = '';
                roomInfo.classList.add('hidden');
            }
            hitungTotal();
        }

        function hitungTotal() {
            const tipe = tipeKamarSelect.value;
            const harga = tipe && hargaMap[tipe] ? hargaMap[tipe].harga : 0;
            const durasi = parseInt(durasiInput.value) || 0;
            let total = harga * durasi;

            if (breakfastCheckbox.checked) {
                total += 50000;
            }

            totalDisplay.textContent = formatRupiah(total);
        }

        tipeKamarSelect.addEventListener('change', setHargaFromTipeKamar);
        durasiInput.addEventListener('input', hitungTotal);
        breakfastCheckbox.addEventListener('change', hitungTotal);
        hitungButton.addEventListener('click', hitungTotal);

        document.addEventListener('DOMContentLoaded', function () {
            setHargaFromTipeKamar();
        });
    </script>
</body>
</html>