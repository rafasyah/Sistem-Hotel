<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pemesanan — Grand Hotel Nusantara</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind (Play CDN). For production, compile with Vite/Tailwind CLI and move the config + styles below into tailwind.config.js / app.css -->
    <script src="https://cdn.tailwindcss.com/3.4.17"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: { DEFAULT: '#0c1a2e', mid: '#162540', soft: '#1a3356' },
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
        /* Guest info table: label | value rows */
        .info-row { @apply flex items-stretch border-b border-line last:border-b-0; }
        .info-label {
            @apply flex w-[140px] min-w-[140px] items-center gap-2 border-r border-line bg-black/[0.015] px-3.5 py-[11px]
                   text-xs font-bold uppercase tracking-[0.5px] text-muted sm:w-[190px] sm:min-w-[190px];
        }
        .info-label i { @apply text-xs text-gold; }
        .info-value { @apply flex flex-1 flex-wrap items-center px-3.5 py-[11px] text-sm font-semibold text-navy; }

        /* Financial summary rows */
        .fin-row { @apply flex items-center justify-between gap-4 border-b border-dashed border-gold/30 py-[7px] text-[0.85rem] last:border-b-0; }
        .fin-label { @apply text-[#6b5a2e]; }
        .fin-value { @apply whitespace-nowrap font-semibold text-navy; }

        /* Action buttons */
        .btn-receipt { @apply inline-flex items-center gap-[7px] rounded px-5 py-[9px] text-[0.84rem] font-semibold no-underline transition; }
    </style>
</head>
<body class="m-0 min-h-screen bg-[#f0f3f8] font-sans text-ink print:bg-white">

    <!-- NAVBAR -->
    <nav class="bg-navy shadow-[0_2px_24px_rgba(0,0,0,0.3)] print:hidden">
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
                <a href="{{ route('pesanan.create') }}"
                   class="inline-flex items-center gap-1.5 rounded-full bg-gradient-to-br from-gold to-gold-light px-[18px] py-[7px] text-[0.8rem] font-semibold text-navy no-underline">
                    <i class="fa-solid fa-plus"></i> <span class="hidden sm:inline">Pesan Baru</span>
                </a>
            </div>
        </div>
    </nav>

    <main class="mx-auto w-full px-4">

        @if (session('success'))
            <div class="mx-auto mt-6 flex max-w-[680px] items-center gap-2.5 rounded border border-l-[3px] border-green-200 border-l-green-500 bg-green-50 px-5 py-3.5 text-[0.85rem] print:hidden">
                <i class="fa-solid fa-circle-check text-lg text-green-600"></i>
                <span><strong>Berhasil!</strong> {{ session('success') }}</span>
            </div>
        @endif

        <div class="mx-auto mb-12 mt-10 max-w-[680px] overflow-hidden rounded-xl border border-line bg-white shadow-[0_4px_32px_rgba(12,26,46,0.10)] print:m-0 print:rounded-none print:border-black print:shadow-none">

            <!-- HEADER -->
            <div class="relative bg-gradient-to-br from-navy to-navy-soft px-6 py-8 text-center sm:px-9">
                <div class="mb-1 font-display text-[1.8rem] font-bold tracking-wider text-white">GRAND <span class="text-gold-light">NUSANTARA</span></div>
                <div class="mb-3 text-xs text-white/50">Jl. Jend. Sudirman No. 88, Jakarta Pusat &nbsp;|&nbsp; Telp: (021) 555-0199</div>
                <span class="inline-block rounded-full bg-gradient-to-br from-gold to-gold-light px-[18px] py-[5px] text-[0.65rem] font-extrabold uppercase tracking-[2.5px] text-navy">
                    <i class="fa-solid fa-star mr-1"></i> Bukti Pemesanan Kamar
                </span>
                <div class="absolute inset-x-0 bottom-0 h-[3px] bg-gradient-to-r from-transparent via-gold to-transparent"></div>
            </div>

            <!-- BODY -->
            <div class="px-5 py-8 sm:px-9">

                <!-- Guest Info -->
                <div class="mb-6 overflow-hidden rounded-lg border border-line bg-slate-50">
                    <div class="info-row">
                        <div class="info-label"><i class="fa-solid fa-user"></i> Nama Pemesan</div>
                        <div class="info-value">{{ $pesanan->nama }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label"><i class="fa-solid fa-id-card"></i> Nomor Identitas</div>
                        <div class="info-value font-mono tracking-wide">{{ $pesanan->nomor_identitas }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label"><i class="fa-solid fa-venus-mars"></i> Jenis Kelamin</div>
                        <div class="info-value">{{ $pesanan->kelamin }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label"><i class="fa-solid fa-bed"></i> Tipe Kamar</div>
                        <div class="info-value !font-bold text-blue-700">{{ $pesanan->tipe_kamar }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label"><i class="fa-solid fa-clock"></i> Durasi Penginapan</div>
                        <div class="info-value">{{ $pesanan->durasi_menginap }} Hari</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label"><i class="fa-solid fa-tag"></i> Discount</div>
                        <div class="info-value {{ $pesanan->discount > 0 ? '!font-bold text-red-600' : '' }}">
                            @if ($pesanan->discount > 0)
                                10% <span class="ml-1 text-[0.8rem] font-normal text-muted">(− Rp {{ number_format($pesanan->discount, 0, ',', '.') }})</span>
                            @else
                                0%
                            @endif
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="info-label"><i class="fa-solid fa-utensils"></i> Breakfast</div>
                        <div class="info-value">
                            @if ($pesanan->termasuk_breakfast)
                                @php
                                    $dur = $pesanan->durasi_menginap;
                                    $bfFee = 80000 * $dur;
                                @endphp
                                <span class="font-bold text-emerald-600">Ya — Rp {{ number_format($bfFee, 0, ',', '.') }}</span>
                                <span class="ml-1.5 text-[0.78rem] font-semibold text-muted">({{ $dur }} hari × Rp 80.000)</span>
                            @else
                                <span class="text-muted">Tidak</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Financial Summary -->
                <div class="mb-6 rounded-lg border border-gold/30 bg-gold-pale px-6 py-5">
                    <div class="fin-row">
                        <span class="fin-label">Tarif per Malam</span>
                        <span class="fin-value">Rp {{ number_format($pesanan->harga, 0, ',', '.') }}</span>
                    </div>
                    <div class="fin-row">
                        <span class="fin-label">Durasi × Tarif (Subtotal)</span>
                        <span class="fin-value">Rp {{ number_format($pesanan->harga * $pesanan->durasi_menginap, 0, ',', '.') }}</span>
                    </div>
                    @if ($pesanan->termasuk_breakfast)
                        @php $bfFee = 80000 * $pesanan->durasi_menginap; @endphp
                        <div class="fin-row">
                            <span class="fin-label">Biaya Breakfast ({{ $pesanan->durasi_menginap }} hari × Rp 80.000)</span>
                            <span class="fin-value">+ Rp {{ number_format($bfFee, 0, ',', '.') }}</span>
                        </div>
                    @endif
                    <div class="fin-row">
                        <span class="fin-label">Diskon 10% {{ $pesanan->discount > 0 ? '(durasi >= 3 hari)' : '(tidak berlaku)' }}</span>
                        @if ($pesanan->discount > 0)
                            <span class="fin-value !text-red-600">− Rp {{ number_format($pesanan->discount, 0, ',', '.') }}</span>
                        @else
                            <span class="fin-value !font-medium !text-muted">Rp 0</span>
                        @endif
                    </div>
                </div>

                <!-- Total -->
                <div class="mt-4 flex items-center justify-between rounded-lg bg-navy px-6 py-[1.1rem]">
                    <div>
                        <div class="text-[0.7rem] font-semibold uppercase tracking-[2px] text-white/50">Total Pembayaran</div>
                        <div class="font-display text-[2rem] font-bold text-gold-light">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</div>
                    </div>
                    <i class="fa-solid fa-coins text-[2rem] text-gold-light opacity-50"></i>
                </div>

                <!-- Meta -->
                <div class="mb-6 mt-5 grid gap-2.5 sm:grid-cols-2">
                    <div class="rounded-md border border-line bg-slate-50 px-3.5 py-2.5">
                        <div class="mb-[3px] text-[0.7rem] font-semibold uppercase tracking-[0.5px] text-muted"><i class="fa-solid fa-calendar mr-1"></i> Tanggal Pemesanan</div>
                        <div class="text-[0.85rem] font-semibold text-navy">{{ $pesanan->tanggal_pesan ? \Carbon\Carbon::parse($pesanan->tanggal_pesan)->format('d/m/Y') : '—' }}</div>
                    </div>
                    <div class="rounded-md border border-line bg-slate-50 px-3.5 py-2.5">
                        <div class="mb-[3px] text-[0.7rem] font-semibold uppercase tracking-[0.5px] text-muted"><i class="fa-solid fa-clock mr-1"></i> Waktu Transaksi</div>
                        <div class="text-[0.85rem] font-semibold text-navy">{{ $pesanan->created_at ? $pesanan->created_at->format('d/m/Y H:i') : '—' }} WIB</div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex flex-wrap items-center justify-between gap-2.5 print:hidden">
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('pesanan.create') }}" class="btn-receipt border border-line text-navy hover:border-navy hover:bg-navy hover:text-white">
                            <i class="fa-solid fa-arrow-left"></i> Form Baru
                        </a>
                        <a href="{{ route('pesanan.index') }}" class="btn-receipt border border-line text-navy hover:border-navy hover:bg-navy hover:text-white">
                            <i class="fa-solid fa-list"></i> Data Tabel
                        </a>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('pesanan.edit', $pesanan->id) }}" class="btn-receipt border border-gold/40 text-[#92700a] hover:border-gold hover:bg-gold-pale">
                            <i class="fa-solid fa-pen"></i> Edit
                        </a>
                        <button type="button" onclick="window.print()"
                                class="btn-receipt bg-gradient-to-br from-green-500 to-green-600 text-white hover:-translate-y-px hover:from-green-600 hover:to-green-700">
                            <i class="fa-solid fa-print"></i> Cetak Bukti
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>