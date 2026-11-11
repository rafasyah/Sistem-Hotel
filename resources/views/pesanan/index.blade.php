<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan — Grand Hotel Nusantara</title>

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
        /* Pill button used for "Form Pemesanan" / "Buat Pesanan Pertama" */
        .btn-add {
            @apply inline-flex items-center gap-1.5 rounded-full bg-gradient-to-br from-gold to-gold-light px-[18px] py-2 text-[0.8rem] font-bold
                   text-navy no-underline transition hover:-translate-y-px hover:from-gold-light hover:to-gold;
        }
        /* Square icon buttons in the table's action column */
        .btn-action {
            @apply flex h-[30px] w-[30px] cursor-pointer items-center justify-center rounded-md border bg-white text-xs no-underline transition hover:-translate-y-px;
        }
        /* Table header / cell basics */
        .th { @apply whitespace-nowrap border-b-2 border-line px-3.5 py-[11px] text-left text-[0.72rem] font-bold uppercase tracking-[0.8px] text-muted; }
        .td { @apply px-3.5 py-3 align-middle text-[0.84rem]; }
        /* Invoice modal rows */
        .inv-row { @apply flex items-center justify-between border-b border-gold/20 py-[7px] text-[0.85rem] last:border-b-0; }
    </style>

    <style>
        /* Print only the invoice when "Cetak Nota" is clicked */
        @media print {
            body * { visibility: hidden; }
            #printableInvoice, #printableInvoice * { visibility: visible; }
            #printableInvoice { position: absolute; left: 0; top: 0; width: 100%; }
        }
    </style>
</head>
<body class="m-0 min-h-screen bg-[#f0f3f8] font-sans text-ink">

    <!-- NAVBAR -->
    <nav class="bg-navy shadow-[0_2px_24px_rgba(0,0,0,0.3)]">
        <div class="mx-auto flex h-[68px] w-full max-w-[1300px] items-center justify-between px-4 sm:px-8">
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
                <a href="{{ route('pesanan.create') }}"
                   class="inline-flex items-center gap-1.5 rounded-full bg-gradient-to-br from-gold to-gold-light px-[18px] py-[7px] text-[0.8rem] font-semibold text-navy no-underline transition hover:from-gold-light hover:to-gold">
                    <i class="fa-solid fa-plus"></i> <span class="hidden sm:inline">Tambah Pesanan</span>
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
                <i class="fa-solid fa-list-check mr-1"></i> Manajemen Reservasi
            </p>
            <h1 class="mb-1.5 font-display text-4xl font-bold text-white">Daftar Pesanan Kamar</h1>
            <p class="text-[0.85rem] text-white/50">Kelola seluruh data pemesanan tamu hotel</p>
            <div class="mx-auto mt-3.5 h-0.5 w-12 bg-gradient-to-r from-transparent via-gold to-transparent"></div>
        </div>
    </header>

    <main class="mx-auto w-full max-w-[1250px] px-4 pb-12 pt-8 sm:px-6">

        @if (session('success'))
            <div id="successAlert" class="mb-5 flex items-center gap-2.5 rounded border border-l-[3px] border-green-200 border-l-green-500 bg-green-50 px-5 py-3.5 text-[0.85rem]">
                <i class="fa-solid fa-circle-check text-lg text-green-600"></i>
                <span><strong>Berhasil!</strong> {{ session('success') }}</span>
                <button type="button" class="ml-auto text-base text-muted hover:text-ink" aria-label="Tutup" onclick="document.getElementById('successAlert').remove()">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        @endif

        <!-- Stats -->
        <div class="mb-7 grid gap-4 sm:grid-cols-3">
            <div class="flex items-center gap-4 rounded-[10px] border border-line bg-white px-[1.4rem] py-5 shadow-[0_2px_12px_rgba(12,26,46,0.07)]">
                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-[10px] bg-blue-600/10 text-[1.1rem] text-blue-600"><i class="fa-solid fa-receipt"></i></div>
                <div>
                    <div class="mb-[3px] text-[0.72rem] font-semibold uppercase tracking-[0.8px] text-muted">Total Transaksi</div>
                    <div class="font-display text-2xl font-bold leading-none text-navy">{{ $pesanans->count() }} <span class="font-sans text-[0.9rem] font-normal text-muted">Pesanan</span></div>
                </div>
            </div>
            <div class="flex items-center gap-4 rounded-[10px] border border-line bg-white px-[1.4rem] py-5 shadow-[0_2px_12px_rgba(12,26,46,0.07)]">
                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-[10px] bg-emerald-500/10 text-[1.1rem] text-emerald-600"><i class="fa-solid fa-money-bill-wave"></i></div>
                <div>
                    <div class="mb-[3px] text-[0.72rem] font-semibold uppercase tracking-[0.8px] text-muted">Total Pendapatan</div>
                    <div class="font-display text-[1.1rem] font-bold leading-none text-emerald-600">Rp {{ number_format($pesanans->sum('total_harga'), 0, ',', '.') }}</div>
                </div>
            </div>
            <div class="flex items-center gap-4 rounded-[10px] border border-line bg-white px-[1.4rem] py-5 shadow-[0_2px_12px_rgba(12,26,46,0.07)]">
                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-[10px] bg-gold/10 text-[1.1rem] text-gold"><i class="fa-solid fa-tags"></i></div>
                <div>
                    <div class="mb-[3px] text-[0.72rem] font-semibold uppercase tracking-[0.8px] text-muted">Total Potongan Diskon</div>
                    <div class="font-display text-[1.1rem] font-bold leading-none text-red-600">Rp {{ number_format($pesanans->sum('discount'), 0, ',', '.') }}</div>
                </div>
            </div>
        </div>

        <!-- Table Card -->
        <div class="mb-8 overflow-hidden rounded-xl border border-line bg-white shadow-[0_4px_24px_rgba(12,26,46,0.08)]">
            <div class="flex flex-wrap items-center justify-between gap-3 bg-gradient-to-r from-navy to-navy-soft px-6 py-[1.1rem]">
                <h5 class="m-0 font-display text-[1.15rem] font-semibold text-white"><i class="fa-solid fa-table-list mr-2 text-gold"></i> Riwayat Pesanan Kamar</h5>
                <a href="{{ route('pesanan.create') }}" class="btn-add"><i class="fa-solid fa-plus"></i> Form Pemesanan</a>
            </div>

            @if ($pesanans->isEmpty())
                <div class="px-8 py-16 text-center">
                    <div class="mx-auto mb-4 flex h-[72px] w-[72px] items-center justify-center rounded-full bg-slate-100 text-[1.75rem] text-muted"><i class="fa-solid fa-inbox"></i></div>
                    <h6 class="mb-1.5 font-display text-[1.3rem] text-navy">Belum Ada Pesanan</h6>
                    <p class="mb-5 text-[0.85rem] text-muted">Belum ada data pemesanan kamar yang tersimpan.</p>
                    <a href="{{ route('pesanan.create') }}" class="btn-add"><i class="fa-solid fa-plus"></i> Buat Pesanan Pertama</a>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="th w-10">#</th>
                                <th class="th">Nama Pemesan</th>
                                <th class="th">NIK</th>
                                <th class="th">Kelamin</th>
                                <th class="th">Tipe Kamar</th>
                                <th class="th">Harga/Malam</th>
                                <th class="th">Durasi</th>
                                <th class="th">Breakfast</th>
                                <th class="th">Diskon 10%</th>
                                <th class="th">Total Bayar</th>
                                <th class="th">Tgl Pesan</th>
                                <th class="th !text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($pesanans as $item)
                                @php
                                    $tipeKey = strtolower($item->tipe_kamar);
                                    $badgeClass = str_contains($tipeKey, 'standar') || str_contains($tipeKey, 'standard')
                                        ? 'bg-blue-600/10 text-blue-600'
                                        : (str_contains($tipeKey, 'deluxe') ? 'bg-gold/15 text-[#92700a]' : 'bg-purple-800/10 text-purple-800');
                                @endphp
                                <tr class="transition hover:bg-[#fafbff]">
                                    <td class="td text-xs font-bold text-muted">{{ $loop->iteration }}</td>
                                    <td class="td"><strong class="text-navy">{{ $item->nama }}</strong></td>
                                    <td class="td"><span class="font-mono text-[0.8rem] tracking-wide text-muted">{{ $item->nomor_identitas }}</span></td>
                                    <td class="td">
                                        <span class="inline-block rounded-full px-2.5 py-0.5 text-[0.7rem] font-semibold {{ $item->kelamin == 'Laki-laki' ? 'bg-blue-600/[0.08] text-blue-800' : 'bg-pink-500/10 text-pink-700' }}">
                                            {{ $item->kelamin }}
                                        </span>
                                    </td>
                                    <td class="td">
                                        <span class="inline-block rounded-full px-2.5 py-[3px] text-[0.7rem] font-bold uppercase tracking-[0.5px] {{ $badgeClass }}">{{ $item->tipe_kamar }}</span>
                                    </td>
                                    <td class="td whitespace-nowrap">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                    <td class="td whitespace-nowrap">{{ $item->durasi_menginap }} malam</td>
                                    <td class="td">
                                        @if ($item->termasuk_breakfast)
                                            <span class="inline-flex items-center gap-1 rounded-full bg-emerald-500/10 px-2.5 py-[3px] text-[0.72rem] font-bold text-emerald-600"><i class="fa-solid fa-utensils"></i> Ya</span>
                                        @else
                                            <span class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-2.5 py-[3px] text-[0.72rem] text-muted"><i class="fa-solid fa-xmark"></i> Tidak</span>
                                        @endif
                                    </td>
                                    <td class="td whitespace-nowrap">
                                        @if ($item->discount > 0)
                                            <span class="text-[0.82rem] font-semibold text-red-600">−Rp {{ number_format($item->discount, 0, ',', '.') }}</span>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td class="td whitespace-nowrap"><span class="text-[0.92rem] font-bold text-emerald-600">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</span></td>
                                    <td class="td whitespace-nowrap"><span class="text-[0.8rem] text-muted">{{ $item->tanggal_pesan ? \Carbon\Carbon::parse($item->tanggal_pesan)->format('d/m/Y') : '—' }}</span></td>
                                    <td class="td">
                                        <div class="flex items-center justify-center gap-[5px]">
                                            <a href="{{ route('pesanan.show', $item->id) }}"
                                               class="btn-action border-sky-500/30 text-sky-500 hover:border-sky-500 hover:bg-sky-500/10" title="Lihat Bukti">
                                                <i class="fa-solid fa-file-invoice"></i>
                                            </a>
                                            <button type="button" data-item="{{ json_encode($item) }}" onclick="showInvoiceModal(JSON.parse(this.dataset.item))"
                                                    class="btn-action border-violet-500/30 text-violet-500 hover:border-violet-500 hover:bg-violet-500/10" title="Nota Pembayaran">
                                                <i class="fa-solid fa-receipt"></i>
                                            </button>
                                            <a href="{{ route('pesanan.edit', $item->id) }}"
                                               class="btn-action border-gold/30 text-gold hover:border-gold hover:bg-gold-pale" title="Edit Data">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>
                                            <form action="{{ route('pesanan.destroy', $item->id) }}" method="POST" class="inline-flex"
                                                  onsubmit="return confirm('Hapus pesanan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action border-red-500/30 text-red-500 hover:border-red-500 hover:bg-red-500/10" title="Hapus">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </main>

    <!-- MODAL INVOICE -->
    <div id="invoiceModal" class="fixed inset-0 z-50 hidden items-center justify-center overflow-y-auto bg-black/60 p-4"
         onclick="if (event.target === this) closeInvoiceModal()" aria-hidden="true">
        <div class="my-auto w-full max-w-lg overflow-hidden rounded-xl bg-white shadow-2xl">
            <div class="flex items-center justify-between bg-gradient-to-r from-navy to-navy-soft px-6 py-[1.1rem]">
                <h5 class="font-display text-[1.1rem] text-white"><i class="fa-solid fa-file-invoice mr-2 text-gold"></i>Nota Pemesanan Kamar</h5>
                <button type="button" onclick="closeInvoiceModal()" class="text-white/70 hover:text-white" aria-label="Tutup"><i class="fa-solid fa-xmark text-lg"></i></button>
            </div>

            <div class="p-6" id="printableInvoice">
                <div class="rounded-lg border border-dashed border-gold/40 bg-gold-pale p-6">
                    <div class="mb-3 border-b border-gold/30 pb-3 text-center">
                        <div class="font-display text-[1.3rem] font-bold text-navy">GRAND HOTEL NUSANTARA</div>
                        <div class="mt-[3px] text-xs text-muted">Jl. Jend. Sudirman No. 88, Jakarta Pusat &nbsp;|&nbsp; Telp: (021) 555-0199</div>
                        <span class="mt-2 inline-block rounded-full bg-gold px-3 py-[3px] text-[0.65rem] font-bold tracking-[2px] text-navy">NOTA PEMESANAN</span>
                    </div>
                    <div class="inv-row"><span>Nama Pemesan</span><strong id="inv_nama">—</strong></div>
                    <div class="inv-row"><span>Nomor Identitas</span><strong id="inv_nik" class="font-mono">—</strong></div>
                    <div class="inv-row"><span>Jenis Kelamin</span><strong id="inv_kelamin">—</strong></div>
                    <div class="inv-row"><span>Tipe Kamar</span><strong id="inv_tipe_kamar" class="text-navy">—</strong></div>
                    <div class="inv-row"><span>Tanggal Pemesanan</span><strong id="inv_tanggal">—</strong></div>
                    <div class="inv-row"><span>Durasi Penginapan</span><strong id="inv_durasi">—</strong></div>
                    <div class="inv-row"><span>Fasilitas Breakfast</span><strong id="inv_breakfast" class="text-right">—</strong></div>
                    <div class="inv-row"><span>Diskon (10% jika &gt;= 3 hari)</span><strong id="inv_discount" class="text-red-600">—</strong></div>
                    <div class="mt-2 flex items-center justify-between rounded-md bg-navy px-3.5 py-2.5">
                        <span class="text-xs uppercase tracking-wider text-white/60">Total Bayar</span>
                        <span class="font-display text-[1.4rem] font-bold text-gold-light" id="inv_total_bayar">Rp 0</span>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-2 bg-slate-100 px-5 py-3">
                <button type="button" onclick="closeInvoiceModal()" class="rounded-full bg-slate-500 px-4 py-1.5 text-sm text-white transition hover:bg-slate-600">Tutup</button>
                <button type="button" onclick="window.print()"
                        class="rounded-full bg-gradient-to-br from-gold to-gold-light px-4 py-1.5 text-sm font-bold text-navy">
                    <i class="fa-solid fa-print mr-1"></i> Cetak Nota
                </button>
            </div>
        </div>
    </div>

    <script>
        function fmt(num) {
            return 'Rp ' + Math.round(num).toLocaleString('id-ID');
        }

        function getBreakfastFee(durasi, hasBreakfast) {
            if (!hasBreakfast || durasi <= 0) return 0;
            return 80000 * durasi;
        }

        // Modal open/close (replaces Bootstrap's JS)
        function openInvoiceModal() {
            const el = document.getElementById('invoiceModal');
            el.classList.remove('hidden');
            el.classList.add('flex');
            el.setAttribute('aria-hidden', 'false');
            document.body.classList.add('overflow-hidden');
        }

        function closeInvoiceModal() {
            const el = document.getElementById('invoiceModal');
            el.classList.add('hidden');
            el.classList.remove('flex');
            el.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('overflow-hidden');
        }

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeInvoiceModal();
        });

        function showInvoiceModal(data) {
            document.getElementById('inv_nama').textContent       = data.nama;
            document.getElementById('inv_nik').textContent        = data.nomor_identitas;
            document.getElementById('inv_kelamin').textContent    = data.kelamin;
            document.getElementById('inv_tipe_kamar').textContent = data.tipe_kamar;
            document.getElementById('inv_tanggal').textContent    = data.tanggal_pesan
                ? new Date(data.tanggal_pesan).toLocaleDateString('id-ID', {day:'2-digit',month:'2-digit',year:'numeric'}) : '—';
            document.getElementById('inv_durasi').textContent = data.durasi_menginap + ' Hari';

            const hasBreakfast = data.termasuk_breakfast == 1 || data.termasuk_breakfast === true;
            const durasi = parseInt(data.durasi_menginap) || 0;
            const breakfastFee = getBreakfastFee(durasi, hasBreakfast);
            document.getElementById('inv_breakfast').textContent  = hasBreakfast
                ? `Ya (${fmt(breakfastFee)} — ${durasi} hari × Rp 80.000)`
                : 'Tidak';
            document.getElementById('inv_discount').textContent   = data.discount > 0
                ? '10% (−' + fmt(data.discount) + ')' : '0%';
            document.getElementById('inv_total_bayar').textContent = fmt(data.total_harga);

            openInvoiceModal();
        }
    </script>
</body>
</html>