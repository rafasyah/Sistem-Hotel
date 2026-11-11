<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grand Hotel Nusantara - Pemesanan Kamar Hotel</title>

    <!-- FontAwesome 6 Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,400&display=swap" rel="stylesheet">

    <!-- Tailwind (Play CDN). For production, compile with Vite/Tailwind CLI and move the config + @apply rules into tailwind.config.js / app.css -->
    <script src="https://cdn.tailwindcss.com/3.4.17"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        serif: ['"Playfair Display"', 'serif'],
                    },
                },
            },
        };
    </script>

    <style type="text/tailwindcss">
        html { scroll-padding-top: 80px; }

        /* Gold gradient button */
        .btn-gold {
            @apply inline-flex items-center justify-center gap-1 rounded-[10px] bg-gradient-to-br from-amber-600 to-amber-500 px-5 py-2.5
                   font-semibold text-white shadow-[0_4px_14px_rgba(217,119,6,0.35)] transition
                   hover:-translate-y-0.5 hover:from-amber-700 hover:to-amber-600 hover:shadow-[0_6px_20px_rgba(217,119,6,0.45)];
        }
        .btn-gold-sm { @apply !px-4 !py-2 text-sm; }

        /* Nav turns solid after scrolling (or when the mobile menu is open) */
        #mainNav { @apply transition-all duration-300; }
        #mainNav.nav-solid { @apply bg-slate-900/90 shadow-[0_8px_30px_rgba(0,0,0,0.25)] backdrop-blur-xl; }

        /* Hero: one staggered entrance on load */
        @keyframes hero-rise {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: none; }
        }
        .hero-rise { animation: hero-rise .8s cubic-bezier(.2,.7,.2,1) both; }
        @media (prefers-reduced-motion: reduce) { .hero-rise { animation: none; } }

        /* Section heading helpers (quieter: sentence case, lighter tracking) */
        .section-header { @apply mb-14 text-center; }
        .section-subtitle { @apply mb-3 block text-sm font-semibold normal-case tracking-wide text-amber-600; }
        .section-title { @apply font-serif text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl; }

        /* Form helpers */
        .form-row { @apply mb-4 grid items-center gap-2 sm:grid-cols-3; }
        .form-label { @apply text-[0.95rem] font-semibold text-slate-900 sm:col-span-1; }
        .form-field { @apply sm:col-span-2; }
        .field-input {
            @apply w-full rounded-[10px] border-[1.5px] border-slate-300 bg-white px-4 py-3 text-[0.95rem] text-slate-800 transition
                   focus:border-amber-600 focus:outline-none focus:ring-4 focus:ring-amber-600/15;
        }
        .input-error { @apply !border-red-500 !bg-red-50; }
        .error-feedback { @apply mt-1 hidden text-[0.825rem] font-bold text-red-600; }

        /* Table badges */
        .badge { @apply inline-block rounded px-2 py-1 text-xs font-semibold; }

        /* Invoice (modal) */
        .invoice-card { @apply rounded-2xl border-2 border-dashed border-slate-300 bg-[#fff8f0] p-6; }
        .invoice-header { @apply mb-6 border-b-2 border-slate-200 pb-4 text-center; }
        .invoice-row { @apply flex items-center justify-between gap-4 border-b border-slate-100 py-2 text-[0.95rem]; }
        .invoice-row strong { @apply text-right text-slate-900; }
    </style>
</head>
<body class="overflow-x-hidden bg-slate-50 font-sans text-slate-800">

    <!-- NAVBAR -->
    <nav id="mainNav" class="fixed inset-x-0 top-0 z-50">
        <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between px-4 py-4">
            <a href="#beranda" class="text-xl font-bold tracking-wide text-white no-underline">
                <i class="fa-solid fa-hotel mr-2 text-amber-400"></i>GRAND <span class="text-amber-500">NUSANTARA</span>
            </a>
            <button type="button" id="navToggle" class="text-xl text-white lg:hidden" aria-label="Buka menu" aria-controls="navMenu" aria-expanded="false">
                <i class="fa-solid fa-bars"></i>
            </button>
            <ul id="navMenu" class="mt-3 hidden w-full flex-col items-stretch gap-1 lg:mt-0 lg:flex lg:w-auto lg:flex-row lg:items-center lg:gap-2">
                @php
                    $navLinks = [
                        ['#beranda', 'Beranda', null],
                        ['#produk', 'Produk Kamar', null],
                        ['#daftar-harga', 'Daftar Harga', null],
                        ['#tentang-kami', 'Tentang Kami', null],
                        ['#daftar-pesanan', 'Daftar Pesanan', null],
                        ['#pesan-kamar', 'Pesan Kamar', 'fa-calendar-check'],
                    ];
                @endphp
                @foreach ($navLinks as [$href, $label, $icon])
                    <li>
                        @if ($icon)
                            <a href="{{ $href }}" class="btn-gold btn-gold-sm mt-2 !rounded-full no-underline lg:mt-0">
                                <i class="fa-solid {{ $icon }} mr-1.5"></i>{{ $label }}
                            </a>
                        @else
                            <a href="{{ $href }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-slate-200 no-underline transition hover:text-amber-500">{{ $label }}</a>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section id="beranda" class="relative flex min-h-[100svh] items-end overflow-hidden text-white">
        <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1920&q=80" alt="" class="absolute inset-0 h-full w-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-900/90 via-slate-900/55 to-slate-900/20"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent to-slate-900/40"></div>

        <div class="relative mx-auto w-full max-w-7xl px-4 pb-10 pt-36 sm:pb-14">
            <p class="hero-rise mb-5 inline-flex items-center gap-2 text-sm font-medium text-slate-200" style="animation-delay:.05s">
                <span class="text-amber-500" aria-hidden="true"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></span>
                Hotel bintang 5, Jakarta Pusat
            </p>
            <h1 class="hero-rise max-w-3xl font-serif text-5xl font-bold leading-[1.05] tracking-tight sm:text-6xl lg:text-7xl" style="animation-delay:.15s">
                Menginap tenang di jantung kota.
            </h1>
            <p class="hero-rise mt-6 max-w-xl text-lg leading-relaxed text-slate-200" style="animation-delay:.3s">
                Kamar luas, layanan 24 jam, dan akses mudah ke kawasan bisnis Sudirman, untuk liburan maupun perjalanan kerja.
            </p>
            <div class="hero-rise mt-8 flex flex-wrap gap-3" style="animation-delay:.45s">
                <a href="#pesan-kamar" class="btn-gold !rounded-full !px-7 !py-3.5 text-base no-underline">Pesan sekarang</a>
                <a href="#produk" class="inline-flex items-center rounded-full border border-white/40 px-7 py-3.5 text-base font-medium text-white no-underline backdrop-blur transition hover:border-white hover:bg-white hover:text-slate-900">Lihat kamar</a>
            </div>

            <!-- Quick room picker -->
            <div class="hero-rise mt-12 grid gap-px overflow-hidden rounded-2xl border border-white/15 bg-white/15 backdrop-blur-xl sm:grid-cols-3" style="animation-delay:.6s">
                @foreach ([
                    ['Standard', 'Standard', 'Rp 500.000', '2 dewasa'],
                    ['Deluxe', 'Deluxe', 'Rp 1.000.000', '2 dewasa + 1 anak'],
                    ['Family', 'Executive / Family', 'Rp 1.500.000', '4 dewasa'],
                ] as [$key, $label, $price, $cap])
                    <a href="#pesan-kamar" onclick="selectRoom('{{ $key }}')" class="flex items-center justify-between gap-4 bg-slate-900/60 px-5 py-4 no-underline transition hover:bg-slate-900/85">
                        <span>
                            <span class="block font-semibold text-white">{{ $label }}</span>
                            <span class="block text-xs text-slate-400">{{ $cap }}</span>
                        </span>
                        <span class="text-right">
                            <span class="block font-bold text-amber-500">{{ $price }}</span>
                            <span class="block text-xs text-slate-400">per malam</span>
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ALERT STATUS NOTIFICATION -->
    <div class="mx-auto mt-6 max-w-7xl px-4">
        @if (session('success'))
            <div id="successAlert" class="flex items-center rounded-2xl bg-green-100 p-4 text-green-900 shadow-sm" role="alert">
                <i class="fa-solid fa-circle-check mr-3 text-2xl text-green-600"></i>
                <div class="flex-1"><strong>Berhasil!</strong> {{ session('success') }}</div>
                <button type="button" class="ml-3 text-green-900/60 hover:text-green-900" aria-label="Tutup" onclick="document.getElementById('successAlert').remove()">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        @endif
    </div>

    @php
        // Single source of truth for the room cards and the price table.
        $rooms = [
            [
                'key' => 'Standard',
                'name' => 'Kamar Standard',
                'img' => 'https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=800&q=80',
                'price' => 'Rp 500.000',
                'desc' => 'Kamar modern minimalis yang dilengkapi dengan kasur berkualitas tinggi, cocok untuk perjalanan solo maupun pasangan.',
                'amenities' => [
                    ['fa-wifi', 'text-blue-600', 'Free High-Speed Wi-Fi'],
                    ['fa-snowflake', 'text-cyan-500', 'AC Inverter'],
                    ['fa-tv', 'text-slate-500', 'TV HD 43 Inci'],
                    ['fa-shower', 'text-blue-600', 'Hot Shower'],
                ],
                'table' => ['fa-bed', 'Standard Room', '2 Dewasa', 'Wi-Fi 100Mbps, AC, TV 43", Shower Air Hangat'],
            ],
            [
                'key' => 'Deluxe',
                'name' => 'Kamar Deluxe',
                'img' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=800&q=80',
                'price' => 'Rp 1.000.000',
                'desc' => 'Kamar mewah nan elegan dengan pemandangan lanskap kota yang indah, balkon pribadi, dan area santai.',
                'amenities' => [
                    ['fa-wifi', 'text-blue-600', 'Wi-Fi Super Cepat'],
                    ['fa-mountain', 'text-green-600', 'Balkon & City View'],
                    ['fa-tv', 'text-slate-500', 'Smart TV 55"'],
                    ['fa-mug-hot', 'text-amber-500', 'Coffee Maker'],
                ],
                'table' => ['fa-hotel', 'Deluxe Room', '2 Dewasa + 1 Anak', 'Balkon Pemandangan Kota, Smart TV 55", Coffee Machine'],
            ],
            [
                'key' => 'Family',
                'name' => 'Kamar Executive / Family',
                'img' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=800&q=80',
                'price' => 'Rp 1.500.000',
                'desc' => 'Suite keluarga ekstra luas lengkap dengan ruang tamu terpisah, bathtub pribadi, serta akses lounge eksklusif.',
                'amenities' => [
                    ['fa-bed', 'text-red-600', 'King Bed + Sofa Bed'],
                    ['fa-bath', 'text-blue-600', 'Bathtub Luxury'],
                    ['fa-couch', 'text-amber-500', 'Living Room'],
                    ['fa-utensils', 'text-green-600', 'Premium Breakfast'],
                ],
                'table' => ['fa-crown', 'Executive / Family Suite', '4 Dewasa', 'Ruang Tamu Terpisah, Bathtub Jacuzzi, Akses Lounge'],
            ],
        ];
    @endphp

    <!-- PRODUK / ROOM SHOWCASE SECTION -->
    <section id="produk" class="px-4 py-16">
        <div class="mx-auto max-w-7xl">
            <div class="section-header">
                <span class="section-subtitle">Pilihan akomodasi</span>
                <h2 class="section-title">Produk &amp; Jenis Kamar Kami</h2>
                <p class="mt-2 text-slate-500">Pilih tipe kamar yang paling sesuai dengan kebutuhan dan kenyamanan Anda</p>
            </div>

            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($rooms as $room)
                    <div class="group flex h-full flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-[0_10px_30px_-5px_rgba(15,23,42,0.08)] transition duration-300 hover:border-amber-600/30 hover:shadow-[0_20px_40px_-10px_rgba(217,119,6,0.2)]">
                        <div class="relative h-60 overflow-hidden">
                            <img src="{{ $room['img'] }}" alt="{{ $room['name'] }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                            <button type="button" onclick="openRoomVideo('{{ $room['key'] }}')"
                                    class="absolute left-3 top-3 rounded-full bg-slate-900/70 px-3 py-1.5 text-[0.8rem] font-semibold text-white backdrop-blur transition hover:bg-amber-600">
                                <i class="fa-solid fa-video mr-1"></i> Video Tour
                            </button>
                            <div class="absolute bottom-3 right-3 rounded-[10px] border border-white/20 bg-slate-900/90 px-3.5 py-1.5 text-lg font-bold text-white backdrop-blur">
                                {{ $room['price'] }} <small class="text-xs font-normal text-slate-300">/malam</small>
                            </div>
                        </div>
                        <div class="flex flex-1 flex-col p-6">
                            <h3 class="mb-2 font-serif text-[1.4rem] font-bold text-slate-900">{{ $room['name'] }}</h3>
                            <p class="text-sm text-slate-500">{{ $room['desc'] }}</p>
                            <div class="mb-5 mt-4 flex flex-wrap gap-2">
                                @foreach ($room['amenities'] as [$icon, $color, $label])
                                    <span class="inline-flex items-center gap-1.5 rounded-md bg-slate-100 px-2.5 py-1 text-[0.78rem] font-medium text-slate-500">
                                        <i class="fa-solid {{ $icon }} {{ $color }}"></i> {{ $label }}
                                    </span>
                                @endforeach
                            </div>
                            <div class="mt-auto flex gap-2 border-t border-slate-200 pt-4">
                                <button type="button" onclick="openRoomVideo('{{ $room['key'] }}')"
                                        class="flex-1 rounded-lg border border-slate-800 px-3 py-1.5 text-sm text-slate-800 transition hover:bg-slate-800 hover:text-white">
                                    <i class="fa-solid fa-images mr-1"></i> Detail &amp; Video
                                </button>
                                <a href="#pesan-kamar" onclick="selectRoom('{{ $room['key'] }}')" class="btn-gold btn-gold-sm flex-1 !rounded-lg no-underline">
                                    <i class="fa-solid fa-calendar-plus mr-1"></i> Pesan
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- DAFTAR HARGA SECTION -->
    <section id="daftar-harga" class="bg-white px-4 py-16">
        <div class="mx-auto max-w-7xl">
            <div class="section-header">
                <span class="section-subtitle">Transparansi tarif</span>
                <h2 class="section-title">Daftar Harga &amp; Fasilitas Kamar</h2>
                <p class="mt-2 text-slate-500">Temukan pilihan terbaik sesuai anggaran dan kebutuhan masa menginap Anda</p>
            </div>

            <div class="overflow-x-auto rounded-2xl border border-slate-200 shadow-sm">
                <table class="w-full text-left text-[0.95rem]">
                    <thead class="bg-slate-900 text-white">
                        <tr>
                            <th class="px-4 py-3 font-semibold">Tipe Kamar</th>
                            <th class="px-3 py-3 font-semibold">Harga per Malam</th>
                            <th class="px-3 py-3 font-semibold">Kapasitas Maksimal</th>
                            <th class="px-3 py-3 font-semibold">Fasilitas Unggulan</th>
                            <th class="px-3 py-3 font-semibold">Penawaran Khusus</th>
                            <th class="px-3 py-3 text-center font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @foreach ($rooms as $room)
                            <tr class="transition hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-3 font-bold text-slate-900"><i class="fa-solid {{ $room['table'][0] }} mr-2 text-amber-500"></i>{{ $room['table'][1] }}</td>
                                <td class="whitespace-nowrap px-3 py-3 font-bold text-green-600">{{ $room['price'] }}</td>
                                <td class="whitespace-nowrap px-3 py-3"><span class="badge bg-slate-500 text-white">{{ $room['table'][2] }}</span></td>
                                <td class="px-3 py-3">{{ $room['table'][3] }}</td>
                                <td class="whitespace-nowrap px-3 py-3"><span class="badge bg-red-600 text-white">Diskon 10% (&gt;3 Malam)</span></td>
                                <td class="px-3 py-3 text-center">
                                    <a href="#pesan-kamar" onclick="selectRoom('{{ $room['key'] }}')" class="btn-gold btn-gold-sm !rounded-md whitespace-nowrap no-underline">Pilih Kamar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Notice card -->
            <div class="mt-6 flex items-center rounded-2xl bg-amber-100 p-4 shadow-sm">
                <i class="fa-solid fa-gift mr-4 text-3xl text-amber-500"></i>
                <div>
                    <strong class="text-slate-900">Ketentuan Penawaran Khusus:</strong>
                    <ul class="mt-1 list-disc pl-5 text-sm text-slate-500">
                        <li>Lama menginap <strong>lebih dari 3 hari</strong> mendapatkan <strong>potongan diskon 10%</strong> dari total subtotal kamar.</li>
                        <li>Layanan <strong>Breakfast</strong> opsional tambahan seharga <strong>Rp 80.000</strong> per malam.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
{{-- ===== PART 2: paste directly after the last </section> of part 1 ===== --}}

    <!-- TENTANG KAMI SECTION -->
    <section id="tentang-kami" class="px-4 py-16">
        <div class="mx-auto max-w-7xl">
            <div class="grid items-center gap-12 lg:grid-cols-2">
                <div>
                    <span class="section-subtitle">Profil hotel</span>
                    <h2 class="section-title mb-6">Tentang Grand Hotel Nusantara</h2>
                    <p class="leading-relaxed text-slate-500">
                        Grand Hotel Nusantara hadir memberikan standar kemewahan tertinggi dengan menggabungkan kearifan lokal budaya Indonesia dan arsitektur kontemporer modern. Terletak di jantung kota, kami menawarkan akses mudah ke kawasan bisnis dan pusat perbelanjaan utama.
                    </p>

                    <div class="mt-4 grid gap-3 sm:grid-cols-2">
                        <div class="flex items-center rounded-lg border border-slate-200 bg-white p-4">
                            <i class="fa-solid fa-location-dot mr-3 text-3xl text-amber-500"></i>
                            <div>
                                <small class="block text-slate-500">Alamat Hotel</small>
                                <strong class="text-slate-900">Jl. Jend. Sudirman No. 88, Jakarta Pusat</strong>
                            </div>
                        </div>
                        <div class="flex items-center rounded-lg border border-slate-200 bg-white p-4">
                            <i class="fa-solid fa-phone mr-3 text-3xl text-amber-500"></i>
                            <div>
                                <small class="block text-slate-500">No. Telepon / Hotline</small>
                                <strong class="text-slate-900">(021) 555-0199 / 0812-3456-7890</strong>
                            </div>
                        </div>
                        <div class="flex items-center rounded-lg border border-slate-200 bg-white p-4 sm:col-span-2">
                            <i class="fa-solid fa-envelope mr-3 text-3xl text-amber-500"></i>
                            <div>
                                <small class="block text-slate-500">Email Pertanyaan &amp; Booking</small>
                                <strong class="text-slate-900">info@grandhotelnusantara.com</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=800&q=80" alt="Hotel Interior" class="w-full rounded-2xl shadow-2xl">
                    <div class="absolute bottom-4 right-4 rounded-2xl border border-slate-500 bg-slate-900 p-5 text-white shadow-lg sm:bottom-6 sm:right-6">
                        <h4 class="mb-1 font-serif text-xl text-amber-500"><i class="fa-solid fa-award mr-2"></i>Penghargaan 2025</h4>
                        <p class="text-sm text-slate-400">Best Luxury City Hotel in Indonesia</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PESAN KAMAR FORM SECTION -->
    <section id="pesan-kamar" class="bg-white px-4 py-16">
        <div class="mx-auto max-w-7xl">
            <div class="section-header !mb-8">
                <span class="section-subtitle">Reservasi eksklusif</span>
                <h2 class="section-title">Form Pemesanan Kamar Hotel</h2>
                <p class="mx-auto mt-2 max-w-[600px] text-slate-500">Pilih tipe kamar dan tentukan durasi menginap Anda. Total harga akan terkalkulasi secara otomatis langsung.</p>
                <div class="mx-auto mt-3 h-[3px] w-[50px] rounded-sm bg-gradient-to-r from-amber-600 to-amber-500"></div>
            </div>

            <div class="mx-auto max-w-3xl">
                <div class="overflow-hidden rounded-2xl border border-amber-600/25 shadow-[0_15px_35px_rgba(15,23,42,0.12)]">
                    <!-- Card header -->
                    <div class="flex items-center gap-2 border-b-[3px] border-amber-600 bg-gradient-to-br from-slate-900 to-slate-800 px-6 py-4 text-white">
                        <span class="inline-flex h-[38px] w-[38px] items-center justify-center rounded-xl bg-amber-600/15 text-amber-400">
                            <i class="fa-solid fa-hotel text-xl"></i>
                        </span>
                        <div>
                            <div class="font-serif text-xl font-bold tracking-wide">Form Pemesanan Kamar</div>
                            <small class="text-xs text-slate-300">Grand Hotel Nusantara &bull; Konfirmasi Instan</small>
                        </div>
                    </div>

                    <div class="bg-[#fafafc] p-6 md:p-12">
                        @if ($errors->any())
                            <div class="mb-6 rounded-lg border-l-4 border-red-500 bg-red-100 p-4 text-red-900 shadow-sm">
                                <div class="mb-1 font-bold"><i class="fa-solid fa-triangle-exclamation mr-2"></i> Perbaiki kesalahan berikut:</div>
                                <ul class="list-disc pl-5">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('pesanan.store') }}" method="POST" id="bookingForm" onsubmit="return validateFormSubmit(event)">
                            @csrf

                            <!-- 1. Nama Pemesan -->
                            <div class="form-row">
                                <label for="nama" class="form-label">Nama Pemesan <span class="text-red-600">*</span></label>
                                <div class="form-field">
                                    <input type="text" class="field-input" id="nama" name="nama" value="{{ old('nama') }}"
                                           placeholder="Isi dengan nama lengkap pemesan"
                                           oninput="validateNamaInput(this)" onkeypress="return blockNumbers(event)" required>
                                    <div id="namaError" class="error-feedback"><i class="fa-solid fa-triangle-exclamation mr-1"></i> Nama tidak boleh mengandung angka</div>
                                </div>
                            </div>

                            <!-- 2. Jenis Kelamin -->
                            <div class="form-row">
                                <span class="form-label">Jenis Kelamin <span class="text-red-600">*</span></span>
                                <div class="form-field flex gap-6 pt-1">
                                    <div class="flex items-center gap-2">
                                        <input type="radio" name="kelamin" id="kelamin_l" value="Laki-laki" class="h-4 w-4 cursor-pointer accent-amber-600"
                                               {{ old('kelamin', 'Laki-laki') == 'Laki-laki' ? 'checked' : '' }} required>
                                        <label for="kelamin_l" class="cursor-pointer font-semibold">Laki-laki</label>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <input type="radio" name="kelamin" id="kelamin_p" value="Perempuan" class="h-4 w-4 cursor-pointer accent-amber-600"
                                               {{ old('kelamin') == 'Perempuan' ? 'checked' : '' }} required>
                                        <label for="kelamin_p" class="cursor-pointer font-semibold">Perempuan</label>
                                    </div>
                                </div>
                            </div>

                            <!-- 3. Nomor Identitas (16 Digit) -->
                            <div class="form-row">
                                <label for="nomor_identitas" class="form-label">Nomor Identitas (NIK) <span class="text-red-600">*</span></label>
                                <div class="form-field">
                                    <input type="text" class="field-input" id="nomor_identitas" name="nomor_identitas" maxlength="16"
                                           value="{{ old('nomor_identitas') }}" placeholder="Wajib 16 Digit angka KTP/NIK"
                                           oninput="this.value = this.value.replace(/\D/g, ''); validateIdentityInput();"
                                           onblur="validateNikBlur(this)" onkeypress="return isNumberKey(event)" required>
                                    <div id="identitasError" class="error-feedback"><i class="fa-solid fa-triangle-exclamation mr-1"></i> isian salah..data harus 16 digit</div>
                                </div>
                            </div>

                            <!-- 4. Tipe Kamar -->
                            <div class="form-row">
                                <label for="tipe_kamar" class="form-label">Tipe Kamar <span class="text-red-600">*</span></label>
                                <div class="form-field">
                                    <select class="field-input font-semibold" id="tipe_kamar" name="tipe_kamar" onchange="updateHargaDanKalkulasi()" required>
                                        <option value="">-- Pilih Tipe Kamar --</option>
                                        <option value="Standar" {{ old('tipe_kamar') == 'Standar' || old('tipe_kamar') == 'Standard' ? 'selected' : '' }}>STANDAR — Rp 500.000 / malam</option>
                                        <option value="Deluxe" {{ old('tipe_kamar') == 'Deluxe' ? 'selected' : '' }}>DELUXE — Rp 1.000.000 / malam</option>
                                        <option value="Family" {{ old('tipe_kamar') == 'Family' || old('tipe_kamar') == 'Executive' || old('tipe_kamar') == 'Executif' ? 'selected' : '' }}>FAMILY / EXECUTIF — Rp 1.500.000 / malam</option>
                                    </select>
                                </div>
                            </div>

                            <!-- 5. Harga -->
                            <div class="form-row">
                                <label for="harga_display" class="form-label">Harga Kamar / Malam</label>
                                <div class="form-field">
                                    <div class="flex">
                                        <span class="flex items-center rounded-l-[10px] border-[1.5px] border-r-0 border-slate-300 bg-white px-4 font-semibold text-slate-500">Rp</span>
                                        <input type="text" id="harga_display" readonly placeholder="0"
                                               class="field-input !rounded-l-none !border-l-0 bg-slate-100 font-bold text-slate-900">
                                    </div>
                                    <input type="hidden" id="harga" name="harga" value="{{ old('harga', 0) }}">
                                </div>
                            </div>

                            <!-- 6. Tanggal Pesan -->
                            <div class="form-row">
                                <label for="tanggal_pesan" class="form-label">Tanggal Pesan <span class="text-red-600">*</span></label>
                                <div class="form-field">
                                    <input type="date" class="field-input" id="tanggal_pesan" name="tanggal_pesan"
                                           value="{{ old('tanggal_pesan', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}" required>
                                </div>
                            </div>

                            <!-- 7. Durasi Menginap -->
                            <div class="form-row">
                                <label for="durasi_menginap" class="form-label">Durasi Menginap <span class="text-red-600">*</span></label>
                                <div class="form-field">
                                    <div class="flex">
                                        <input type="text" inputmode="numeric" id="durasi_menginap" name="durasi_menginap"
                                               class="field-input !rounded-r-none font-semibold" value="{{ old('durasi_menginap', 1) }}"
                                               oninput="this.value = this.value.replace(/\D/g, ''); validateDurasiInput(); kalkulasiTotal(false);"
                                               onkeypress="return isNumberKey(event)" required>
                                        <span class="flex items-center whitespace-nowrap rounded-r-[10px] border-[1.5px] border-l-0 border-slate-300 bg-white px-4 font-semibold">Hari / Malam</span>
                                    </div>
                                    <div id="durasiError" class="error-feedback"><i class="fa-solid fa-triangle-exclamation mr-1"></i> harus isi angka</div>
                                    <small class="mt-1 block text-slate-500"><i class="fa-solid fa-gift mr-1 text-amber-500"></i>Diskon 10% otomatis jika durasi minimal 3 hari</small>
                                </div>
                            </div>

                            <!-- 8. Termasuk Breakfast -->
                            <div class="form-row">
                                <span class="form-label">Fasilitas Sarapan</span>
                                <div class="form-field">
                                    <div class="flex flex-col gap-1 rounded-lg border border-slate-200 bg-white p-4">
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" id="termasuk_breakfast" name="termasuk_breakfast" value="1"
                                                   class="h-4 w-4 cursor-pointer accent-amber-600"
                                                   {{ old('termasuk_breakfast', '1') == '1' ? 'checked' : '' }} onchange="kalkulasiTotal(false)">
                                            <label for="termasuk_breakfast" class="cursor-pointer font-bold text-slate-900">Termasuk Breakfast</label>
                                        </div>
                                        <div class="pl-6 text-sm text-slate-500" id="breakfast_rate_info">
                                            <i class="fa-solid fa-circle-info mr-1 text-amber-500"></i>Biaya: <strong>Rp 80.000</strong> per hari jika dipilih
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 9. Total Bayar -->
                            <div class="form-row !mb-6">
                                <label for="total_bayar_input" class="form-label font-bold">Total Bayar</label>
                                <div class="form-field">
                                    <div class="flex overflow-hidden rounded-lg border border-slate-300 shadow-sm">
                                        <span class="flex items-center bg-slate-900 px-4 font-bold text-white">Rp</span>
                                        <input type="text" id="total_bayar_input" readonly placeholder="0"
                                               class="w-full bg-white px-4 py-2 text-2xl font-bold tracking-wide text-slate-900 focus:outline-none">
                                    </div>
                                    <input type="hidden" id="total_bayar" name="total_bayar" value="{{ old('total_bayar', 0) }}">
                                    <small class="mt-1 block text-slate-500"><i class="fa-solid fa-sparkles mr-1 text-amber-500"></i>Total bayar ter-update otomatis secara langsung saat formulir diisi</small>
                                </div>
                            </div>

                            <!-- Rincian realtime -->
                            <div class="mb-6 rounded-2xl border border-amber-600/30 bg-gradient-to-br from-slate-900 to-slate-800 p-4 text-slate-50 shadow-sm md:p-6">
                                <div class="mb-2 flex items-center justify-between border-b border-white/10 pb-2">
                                    <span class="text-sm font-semibold text-amber-500"><i class="fa-solid fa-receipt mr-1"></i> RINCIAN BIAYA LANGSUNG</span>
                                    <span class="rounded border border-amber-500/50 bg-amber-500/25 px-2 py-0.5 text-[0.7rem] text-amber-500">Real-time</span>
                                </div>
                                <div class="mb-2 flex justify-between text-sm">
                                    <span class="text-white/75">Subtotal Kamar (<span id="summary_durasi">3</span> hari):</span>
                                    <strong id="summary_subtotal" class="text-white">Rp 0</strong>
                                </div>
                                <div class="mb-2 flex justify-between text-sm">
                                    <span class="text-white/75">Potongan Diskon (10% jika &ge; 3 hari):</span>
                                    <strong id="summary_diskon" class="font-bold text-red-400">Rp 0</strong>
                                </div>
                                <div class="mb-2 flex justify-between text-sm">
                                    <span class="text-white/75">Biaya Sarapan / Breakfast:</span>
                                    <strong id="summary_breakfast" class="font-bold text-amber-500">Rp 0</strong>
                                </div>
                                <div class="mt-2 flex items-center justify-between border-t border-white/25 pt-3">
                                    <div>
                                        <strong class="block text-white">TOTAL PEMBAYARAN:</strong>
                                        <small class="text-xs text-white/50">Sudah termasuk seluruh fasilitas yang dipilih</small>
                                    </div>
                                    <strong id="total_bayar_display" class="font-serif text-3xl font-bold text-amber-500">Rp 0</strong>
                                </div>
                            </div>

                            <!-- 10. Tombol -->
                            <div class="flex flex-wrap justify-center gap-3 pt-2">
                                <button type="submit" id="btnSimpan" class="btn-gold !px-12 font-bold shadow-lg">
                                    <i class="fa-solid fa-check-circle mr-1"></i> Simpan
                                </button>
                                <button type="button" id="btnCancel" onclick="resetForm()"
                                        class="rounded-[10px] border border-slate-500 px-6 py-2.5 font-semibold text-slate-500 transition hover:bg-slate-500 hover:text-white">
                                    <i class="fa-solid fa-xmark mr-1"></i> Reset
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- DAFTAR PESANAN & REKAP TRANSAKSI -->
    <section id="daftar-pesanan" class="px-4 py-16">
        <div class="mx-auto max-w-7xl">
            <div class="section-header">
                <span class="section-subtitle">Data transaksi</span>
                <h2 class="section-title">Daftar Pemesanan Kamar</h2>
                <p class="mt-2 text-slate-500">Rekap data seluruh pesanan kamar hotel yang tersimpan dalam sistem</p>
            </div>

            <div class="overflow-hidden rounded-2xl bg-white shadow-sm">
                <div class="flex flex-wrap items-center justify-between gap-3 bg-slate-900 p-4 text-white">
                    <h5 class="font-serif text-xl"><i class="fa-solid fa-list-check mr-2 text-amber-500"></i> Data Riwayat Pesanan</h5>
                    <div class="flex gap-2">
                        <input type="text" id="searchInput" placeholder="Cari pemesan..." onkeyup="filterTable()"
                               class="rounded bg-slate-500 px-3 py-1.5 text-sm text-white placeholder-slate-300 focus:outline-none focus:ring-2 focus:ring-amber-500">
                        <a href="#pesan-kamar" class="btn-gold btn-gold-sm !rounded no-underline"><i class="fa-solid fa-plus mr-1"></i>Tambah</a>
                    </div>
                </div>

                @if ($pesanans->isEmpty())
                    <div class="py-12 text-center">
                        <i class="fa-solid fa-inbox mb-3 text-5xl text-slate-400"></i>
                        <p class="mb-4 text-xl text-slate-500">Belum ada data pemesanan kamar yang tersimpan.</p>
                        <a href="#pesan-kamar" class="btn-gold no-underline"><i class="fa-solid fa-plus mr-1"></i>Buat Pesanan Pertama</a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full whitespace-nowrap text-left text-[0.95rem]" id="pesananTable">
                            <thead class="bg-slate-100">
                                <tr>
                                    <th class="py-3 pl-4 pr-2">#</th>
                                    <th class="px-2 py-3">Nama Pemesan</th>
                                    <th class="px-2 py-3">No. Identitas (NIK)</th>
                                    <th class="px-2 py-3">JNS Kelamin</th>
                                    <th class="px-2 py-3">Tipe Kamar</th>
                                    <th class="px-2 py-3">Durasi</th>
                                    <th class="px-2 py-3">Breakfast</th>
                                    <th class="px-2 py-3">Diskon (10%)</th>
                                    <th class="px-2 py-3">Total Bayar</th>
                                    <th class="px-2 py-3">Tanggal Pesan</th>
                                    <th class="py-3 pl-2 pr-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200">
                                @foreach ($pesanans as $item)
                                    <tr class="transition hover:bg-slate-50">
                                        <td class="py-3 pl-4 pr-2 font-bold">{{ $loop->iteration }}</td>
                                        <td class="px-2 py-3 font-bold text-slate-900">{{ $item->nama }}</td>
                                        <td class="px-2 py-3 font-mono text-sm">{{ $item->nomor_identitas }}</td>
                                        <td class="px-2 py-3">
                                            <span class="badge text-white {{ $item->kelamin == 'Laki-laki' ? 'bg-blue-600' : 'bg-red-600' }}">{{ $item->kelamin }}</span>
                                        </td>
                                        <td class="px-2 py-3">
                                            <span class="badge {{ in_array($item->tipe_kamar, ['Standard', 'Standar']) ? 'bg-cyan-500 text-white' : ($item->tipe_kamar == 'Deluxe' ? 'bg-amber-400 text-slate-900' : 'bg-slate-900 text-white') }}">
                                                {{ $item->tipe_kamar }}
                                            </span>
                                        </td>
                                        <td class="px-2 py-3">{{ $item->durasi_menginap }} malam</td>
                                        <td class="px-2 py-3">
                                            @if ($item->termasuk_breakfast)
                                                @php $fee = 80000 * $item->durasi_menginap; @endphp
                                                <span class="badge border border-green-600/50 bg-green-50 text-green-700"><i class="fa-solid fa-check mr-1"></i>Ya (Rp {{ number_format($fee, 0, ',', '.') }})</span>
                                            @else
                                                <span class="badge bg-slate-100 text-slate-500">Tidak</span>
                                            @endif
                                        </td>
                                        <td class="px-2 py-3">
                                            @if ($item->discount > 0)
                                                <span class="font-bold text-red-600">- Rp {{ number_format($item->discount, 0, ',', '.') }}</span>
                                            @else
                                                <span class="text-slate-500">-</span>
                                            @endif
                                        </td>
                                        <td class="px-2 py-3 font-bold text-green-600">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                        <td class="px-2 py-3 text-sm text-slate-500">
                                            {{ $item->tanggal_pesan ? \Carbon\Carbon::parse($item->tanggal_pesan)->format('d/m/Y') : '-' }}
                                        </td>
                                        <td class="py-3 pl-2 pr-4 text-center">
                                            <div class="inline-flex items-stretch overflow-hidden rounded-md border border-slate-300 text-sm [&>*]:px-2.5 [&>*]:py-1 [&>*:not(:last-child)]:border-r [&>*:not(:last-child)]:border-slate-300">
                                                <a href="{{ route('pesanan.show', $item->id) }}" class="text-cyan-600 no-underline transition hover:bg-cyan-500 hover:text-white" title="Bukti Pemesanan">
                                                    <i class="fa-solid fa-file-invoice"></i> Bukti
                                                </a>
                                                <button type="button" data-item="{{ json_encode($item) }}" onclick="showInvoiceModal(JSON.parse(this.dataset.item))"
                                                        class="text-blue-600 transition hover:bg-blue-600 hover:text-white" title="Lihat Nota / Invoice">
                                                    <i class="fa-solid fa-receipt"></i> Nota
                                                </button>
                                                <a href="{{ route('pesanan.edit', $item->id) }}" class="text-slate-500 no-underline transition hover:bg-slate-500 hover:text-white" title="Edit Pesanan">
                                                    <i class="fa-solid fa-pen"></i>
                                                </a>
                                                <form action="{{ route('pesanan.destroy', $item->id) }}" method="POST" class="flex"
                                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pesanan ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="w-full text-red-600 transition hover:bg-red-600 hover:text-white" title="Hapus Data">
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
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-slate-900 px-4 pb-6 pt-12 text-slate-400">
        <div class="mx-auto max-w-7xl text-center">
            <h3 class="mb-2 font-serif text-2xl text-white"><i class="fa-solid fa-hotel mr-2 text-amber-500"></i>Grand Hotel Nusantara</h3>
           
            <div class="mb-6 flex justify-center gap-4 text-2xl text-amber-500">
                <i class="fa-brands fa-facebook"></i>
                <i class="fa-brands fa-instagram"></i>
                <i class="fa-brands fa-twitter"></i>
                <i class="fa-brands fa-youtube"></i>
            </div>
            <div class="border-t border-slate-500 pt-4 text-sm text-slate-500">
                &copy; {{ date('Y') }} Grand Hotel Nusantara. Copyright by LSP Informatika. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- MODAL INVOICE / NOTA -->
    <div id="invoiceModal" class="fixed inset-0 z-[60] hidden items-center justify-center overflow-y-auto bg-black/60 p-4"
         onclick="if (event.target === this) closeModal('invoiceModal')" aria-hidden="true">
        <div class="my-auto w-full max-w-lg overflow-hidden rounded-2xl bg-white shadow-2xl">
            <div class="flex items-center justify-between bg-slate-900 px-5 py-4 text-white">
                <h5 class="font-serif text-xl"><i class="fa-solid fa-file-invoice mr-2 text-amber-500"></i>Nota Pemesanan Kamar</h5>
                <button type="button" onclick="closeModal('invoiceModal')" class="text-white/70 hover:text-white" aria-label="Tutup"><i class="fa-solid fa-xmark text-xl"></i></button>
            </div>
            <div class="p-6" id="printableInvoice">
                <div class="invoice-card">
                    <div class="invoice-header">
                        <h4 class="mb-1 font-serif text-xl font-bold text-slate-900">GRAND HOTEL NUSANTARA</h4>
                        <p class="text-sm text-slate-500">Jl. Jend. Sudirman No. 88, Jakarta Pusat | Telp: (021) 555-0199</p>
                        <span class="badge mt-2 bg-amber-400 text-slate-900">RINGKASAN BUKTI PEMESANAN</span>
                    </div>

                    <div class="invoice-row"><span>Nama Pemesan</span><strong id="inv_nama">-</strong></div>
                    <div class="invoice-row"><span>Nomor Identitas (NIK)</span><strong id="inv_nik" class="font-mono">-</strong></div>
                    <div class="invoice-row"><span>Jenis Kelamin</span><strong id="inv_kelamin">-</strong></div>
                    <div class="invoice-row"><span>Tipe Kamar</span><strong id="inv_tipe_kamar" class="text-primary">-</strong></div>
                    <div class="invoice-row"><span>Tanggal Pemesanan</span><strong id="inv_tanggal">-</strong></div>
                    <div class="invoice-row"><span>Durasi Penginapan</span><strong id="inv_durasi">-</strong></div>
                    <div class="invoice-row"><span>Fasilitas Breakfast</span><strong id="inv_breakfast">-</strong></div>
                    <div class="invoice-row"><span>Discount (10% jika &gt;3 hari)</span><strong id="inv_discount" class="text-danger">-</strong></div>
                    <div class="invoice-row pt-3 mt-2 !border-b-0 border-t-2 border-slate-900 pt-4">
                        <span class="text-lg font-bold">TOTAL BAYAR</span>
                        <strong id="inv_total_bayar" class="text-success fs-4 text-2xl font-extrabold text-green-600">Rp 0</strong>
                    </div>

                    <div class="mt-6 border-t border-slate-200 pt-4 text-center text-sm text-slate-500">
                        <p class="mb-1">Terima kasih telah memilih Grand Hotel Nusantara.</p>
                        <p class="italic">Simpan nota ini sebagai bukti reservasi saat check-in.</p>
                    </div>
                </div>
            </div>
            <div class="flex justify-end gap-2 bg-slate-100 px-5 py-3">
                <button type="button" onclick="closeModal('invoiceModal')" class="rounded-lg bg-slate-500 px-4 py-2 text-white transition hover:bg-slate-600">Tutup</button>
                <button type="button" onclick="printInvoice()" class="btn-gold btn-gold-sm !rounded-lg"><i class="fa-solid fa-print mr-1"></i> Cetak Nota / PDF</button>
            </div>
        </div>
    </div>

    <!-- MODAL VIDEO TOUR -->
    <div id="videoModal" class="fixed inset-0 z-[60] hidden items-center justify-center overflow-y-auto bg-black/60 p-4"
         onclick="if (event.target === this) closeModal('videoModal')" aria-hidden="true">
        <div class="my-auto w-full max-w-3xl overflow-hidden rounded-2xl bg-slate-900 shadow-2xl">
            <div class="flex items-center justify-between px-5 py-4 text-white">
                <h5 class="font-serif text-xl" id="videoModalTitle"><i class="fa-solid fa-circle-play mr-2 text-amber-500"></i> Room Tour Video</h5>
                <button type="button" onclick="closeModal('videoModal')" class="text-white/70 hover:text-white" aria-label="Tutup"><i class="fa-solid fa-xmark text-xl"></i></button>
            </div>
            <div class="aspect-video bg-black">
                <iframe id="roomVideoFrame" src="" title="Room Video Tour" class="h-full w-full"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="p-4 text-white">
                <h5 id="videoRoomName" class="mb-1 text-lg text-amber-500">Standard Room</h5>
                <p id="videoRoomDesc" class="text-sm text-slate-400">Nikmati suasana kenyamanan kamar berkelas bintang lima.</p>
            </div>
        </div>
    </div>

    <script>
        const hargaMap = {
            'Standar': 500000,
            'Standard': 500000,
            'Deluxe': 1000000,
            'Family': 1500000,
            'Executive': 1500000,
            'Executif': 1500000
        };

        const roomVideos = {
            'Standar': {
                title: 'Standard Room Tour & Video',
                embedUrl: "https://www.youtube.com/embed/ZJsjGBiH3P8",
                desc: 'Kamar Standard dirancang dengan gaya minimalis modern, pencahayaan hangat, tempat tidur king size, dan fasilitas lengkap.'
            },
            'Deluxe': {
                title: 'Deluxe Room Tour & Video',
                embedUrl: "https://www.youtube.com/embed/KshkCxCLhXg",
                desc: 'Kamar Deluxe menawarkan pemandangan panorama kota dari balkon privat, bathtub mewah, dan area bersantai yang nyaman.'
            },
            'Family': {
                title: 'Executive & Family Suite Tour & Video',
                embedUrl: "https://www.youtube.com/embed/yJoRuxi4XTU",
                desc: 'Suite Executive menghadirkan kemewahan seluas 75m² dengan ruang tamu terpisah, bathtub jacuzzi, serta fasilitas premium.'
            }
        };

        // ── Helpers ─────────────────────────────────────────────
        function formatRupiah(number) {
            return 'Rp ' + Math.round(number).toLocaleString('id-ID');
        }

        function formatNumber(number) {
            return Math.round(number).toLocaleString('id-ID');
        }

        // ── Navbar toggle (mobile) ──────────────────────────────
        const navToggle = document.getElementById('navToggle');
        const navMenu = document.getElementById('navMenu');
        navToggle.addEventListener('click', () => {
            const open = navMenu.classList.toggle('hidden') === false;
            navToggle.setAttribute('aria-expanded', open);
        });
        navMenu.querySelectorAll('a').forEach(a => a.addEventListener('click', () => {
            if (window.innerWidth < 1024) {
                navMenu.classList.add('hidden');
                navToggle.setAttribute('aria-expanded', 'false');
            }
        }));

        // ── Navbar: transparent over hero, solid after scroll / when mobile menu open ──
        const mainNav = document.getElementById('mainNav');
        function syncNav() {
            const menuOpen = !navMenu.classList.contains('hidden') && window.innerWidth < 1024;
            mainNav.classList.toggle('nav-solid', window.scrollY > 40 || menuOpen);
        }
        window.addEventListener('scroll', syncNav, { passive: true });
        window.addEventListener('resize', syncNav);
        navToggle.addEventListener('click', syncNav);
        navMenu.querySelectorAll('a').forEach(a => a.addEventListener('click', syncNav));
        syncNav();

        // ── Modals (replaces Bootstrap's JS) ────────────────────
        function openModal(id) {
            const el = document.getElementById(id);
            el.classList.remove('hidden');
            el.classList.add('flex');
            el.setAttribute('aria-hidden', 'false');
            document.body.classList.add('overflow-hidden');
        }

        function closeModal(id) {
            const el = document.getElementById(id);
            el.classList.add('hidden');
            el.classList.remove('flex');
            el.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('overflow-hidden');
            if (id === 'videoModal') document.getElementById('roomVideoFrame').src = ''; // stop playback
        }

        document.addEventListener('keydown', (e) => {
            if (e.key !== 'Escape') return;
            ['invoiceModal', 'videoModal'].forEach(id => {
                if (!document.getElementById(id).classList.contains('hidden')) closeModal(id);
            });
        });

        // ── Input guards ────────────────────────────────────────
        // Only allow digits 0-9
        function isNumberKey(evt) {
            const charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }

        // Block digits in the name field
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

        // Live validation: identity number (strictly 16 digits)
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

        // Live validation: duration (numeric and > 0)
        function validateDurasiInput() {
            const input = document.getElementById('durasi_menginap');
            const errorDiv = document.getElementById('durasiError');
            const val = input.value.trim();
            const num = parseInt(val, 10);

            if (val === '' || isNaN(num) || num <= 0) {
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

        // ── Pricing ─────────────────────────────────────────────
        // Breakfast: Rp 80.000 per day
        function getBreakfastFee(durasi, includesBreakfast) {
            if (!includesBreakfast || durasi <= 0) return 0;
            return 80000 * durasi;
        }

        function updateHargaDanKalkulasi() {
            const tipe = document.getElementById('tipe_kamar').value;
            const hargaInput = document.getElementById('harga');
            const hargaDisplay = document.getElementById('harga_display');

            if (tipe && hargaMap[tipe]) {
                const price = hargaMap[tipe];
                hargaInput.value = price;
                hargaDisplay.value = formatNumber(price);
            } else {
                hargaInput.value = 0;
                hargaDisplay.value = '0';
            }
            kalkulasiTotal(false);
        }

        // Total = (rate × nights) − 10% (if ≥ 3 nights) + breakfast
        function kalkulasiTotal(showAlert = false) {
            const tipe = document.getElementById('tipe_kamar').value;
            const harga = parseInt(document.getElementById('harga').value, 10) || 0;
            const durasi = parseInt(document.getElementById('durasi_menginap').value, 10) || 0;
            const includesBreakfast = document.getElementById('termasuk_breakfast').checked;

            const sumDurasi = document.getElementById('summary_durasi');
            const sumSubtotal = document.getElementById('summary_subtotal');
            const sumDiskon = document.getElementById('summary_diskon');
            const sumBreakfast = document.getElementById('summary_breakfast');
            const sumTotal = document.getElementById('total_bayar_display');
            const totalInput = document.getElementById('total_bayar_input');
            const totalHidden = document.getElementById('total_bayar');

            const bfInfo = document.getElementById('breakfast_rate_info');
            if (bfInfo) {
                if (durasi > 0 && includesBreakfast) {
                    const fee = getBreakfastFee(durasi, true);
                    bfInfo.innerHTML = `<i class="fa-solid fa-circle-check mr-1 text-green-600"></i>Biaya Sarapan: <strong>${formatRupiah(fee)}</strong> (${durasi} hari &times; Rp 80.000)`;
                } else {
                    bfInfo.innerHTML = `<i class="fa-solid fa-circle-info mr-1 text-amber-500"></i>Biaya: <strong>Rp 80.000</strong> per hari jika dipilih`;
                }
            }

            if (!tipe || durasi <= 0) {
                if (totalInput) totalInput.value = '0';
                if (totalHidden) totalHidden.value = '0';
                if (sumDurasi) sumDurasi.textContent = durasi > 0 ? durasi : '0';
                if (sumSubtotal) sumSubtotal.textContent = 'Rp 0';
                if (sumDiskon) sumDiskon.textContent = 'Rp 0';
                if (sumBreakfast) sumBreakfast.textContent = 'Rp 0';
                if (sumTotal) sumTotal.textContent = 'Rp 0';

                if (showAlert) {
                    if (!tipe) alert('Peringatan: Silakan pilih tipe kamar terlebih dahulu!');
                    else if (durasi <= 0) alert('Peringatan: harus isi angka');
                }
                return false;
            }

            const subtotal = harga * durasi;
            const discount = durasi >= 3 ? subtotal * 0.10 : 0;
            const breakfastFee = getBreakfastFee(durasi, includesBreakfast);
            const totalBayar = subtotal - discount + breakfastFee;

            if (totalInput) totalInput.value = formatNumber(totalBayar);
            if (totalHidden) totalHidden.value = totalBayar;

            if (sumDurasi) sumDurasi.textContent = durasi;
            if (sumSubtotal) sumSubtotal.textContent = formatRupiah(subtotal);
            if (sumDiskon) sumDiskon.textContent = discount > 0 ? '- ' + formatRupiah(discount) : 'Rp 0';
            if (sumBreakfast) sumBreakfast.textContent = breakfastFee > 0 ? '+ ' + formatRupiah(breakfastFee) : 'Rp 0';
            if (sumTotal) sumTotal.textContent = formatRupiah(totalBayar);

            if (showAlert) {
                const bfDetail = includesBreakfast
                    ? `Breakfast (${durasi} hari x Rp 80.000): ${formatRupiah(breakfastFee)}`
                    : 'Breakfast: Rp 0';
                alert(`Perhitungan Total Bayar Berhasil!\n\nTarif Kamar: Rp ${formatNumber(harga)} / malam\nDurasi: ${durasi} hari\nSubtotal: Rp ${formatNumber(subtotal)}\nDiskon (10% jika >= 3 hari): ${discount > 0 ? '- ' + formatRupiah(discount) : 'Rp 0'}\n${bfDetail}\n-----------------------------\nTotal Bayar: ${formatRupiah(totalBayar)}`);
            }
            return true;
        }

        // ── Form submit / reset ─────────────────────────────────
        function validateFormSubmit(e) {
            const namaInput = document.getElementById('nama');
            const durasiInput = document.getElementById('durasi_menginap');
            const tipeInput = document.getElementById('tipe_kamar');

            if (!namaInput.value.trim() || /\d/.test(namaInput.value)) {
                alert('Peringatan: Nama pemesan tidak boleh kosong dan tidak boleh mengandung angka!');
                namaInput.classList.add('input-error');
                const errNama = document.getElementById('namaError');
                if (errNama) errNama.style.display = 'block';
                namaInput.focus();
                e.preventDefault();
                return false;
            }

            if (!tipeInput.value) {
                alert('Peringatan: Silakan pilih tipe kamar terlebih dahulu!');
                tipeInput.focus();
                e.preventDefault();
                return false;
            }

            const valDurasi = parseInt(durasiInput.value, 10);
            if (isNaN(valDurasi) || valDurasi <= 0) {
                alert('harus isi angka');
                durasiInput.classList.add('input-error');
                document.getElementById('durasiError').style.display = 'block';
                durasiInput.focus();
                e.preventDefault();
                return false;
            }

            kalkulasiTotal(false);
            return true;
        }

        function resetForm() {
            document.getElementById('bookingForm').reset();
            updateHargaDanKalkulasi();
            document.getElementById('identitasError').style.display = 'none';
            document.getElementById('durasiError').style.display = 'none';
            const errNama = document.getElementById('namaError');
            if (errNama) errNama.style.display = 'none';
            ['nama', 'nomor_identitas', 'durasi_menginap'].forEach(id => document.getElementById(id).classList.remove('input-error'));
        }

        // Preselect a room from the cards / price table / hero
        function selectRoom(roomType) {
            const selectElem = document.getElementById('tipe_kamar');
            if (roomType === 'Standard' || roomType === 'Standar') {
                selectElem.value = 'Standar';
            } else if (roomType === 'Deluxe') {
                selectElem.value = 'Deluxe';
            } else {
                selectElem.value = 'Family';
            }
            updateHargaDanKalkulasi();
            document.getElementById('pesan-kamar').scrollIntoView({ behavior: 'smooth' });
        }

        // ── Video tour ──────────────────────────────────────────
        function openRoomVideo(roomType) {
            const key = (roomType === 'Standard' || roomType === 'Standar') ? 'Standar' : roomType;
            const data = roomVideos[key] || roomVideos['Standar'];
            document.getElementById('videoModalTitle').innerHTML = `<i class="fa-solid fa-circle-play mr-2 text-amber-500"></i> ${data.title}`;
            document.getElementById('videoRoomName').textContent = (roomType === 'Family' ? 'Executive & Family Suite' : roomType + ' Room');
            document.getElementById('videoRoomDesc').textContent = data.desc;
            document.getElementById('roomVideoFrame').src = data.embedUrl;
            openModal('videoModal');
        }

        // ── Invoice modal ───────────────────────────────────────
        function showInvoiceModal(data) {
            document.getElementById('inv_nama').textContent = data.nama;
            document.getElementById('inv_nik').textContent = data.nomor_identitas;
            document.getElementById('inv_kelamin').textContent = data.kelamin;
            document.getElementById('inv_tipe_kamar').textContent = data.tipe_kamar;
            document.getElementById('inv_tanggal').textContent = data.tanggal_pesan ? new Date(data.tanggal_pesan).toLocaleDateString('id-ID') : '-';
            document.getElementById('inv_durasi').textContent = data.durasi_menginap + ' Hari / Malam';

            const durasi = parseInt(data.durasi_menginap) || 0;
            const hasBf = data.termasuk_breakfast == 1 || data.termasuk_breakfast === true;
            const bfFee = getBreakfastFee(durasi, hasBf);
            document.getElementById('inv_breakfast').textContent = hasBf ? 'Ya (' + formatRupiah(bfFee) + ')' : 'Tidak';
            document.getElementById('inv_discount').textContent = data.discount > 0 ? '10% (' + formatRupiah(data.discount) + ')' : '0%';
            document.getElementById('inv_total_bayar').textContent = formatRupiah(data.total_harga);

            openModal('invoiceModal');
        }

        // Print in a separate window so the main page stays untouched.
        // The popup has no Tailwind, so it carries its own small stylesheet.
        function printInvoice() {
            const invoiceEl = document.getElementById('printableInvoice');
            if (!invoiceEl) return;

            const printWin = window.open('', '_blank', 'width=750,height=900,scrollbars=yes');
            if (!printWin) {
                alert('Popup diblokir browser. Izinkan popup untuk halaman ini lalu coba lagi.');
                return;
            }

            printWin.document.write(`<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nota Pemesanan — Grand Hotel Nusantara</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', Arial, sans-serif; font-size: 13px; color: #1e293b; background: #fff; padding: 32px; }
        .invoice-card { max-width: 620px; margin: 0 auto; }
        .invoice-header { text-align: center; margin-bottom: 20px; padding-bottom: 16px; border-bottom: 2px solid #d97706; }
        .invoice-header h4 { font-size: 20px; font-weight: 700; color: #0f172a; letter-spacing: 1px; }
        .invoice-header p { font-size: 11px; color: #64748b; margin-top: 4px; }
        .badge { display: inline-block; background: #d97706; color: #fff; font-size: 10px; padding: 3px 10px; border-radius: 20px; margin-top: 8px; letter-spacing: 1px; text-transform: uppercase; }
        .invoice-row { display: flex; justify-content: space-between; align-items: center; padding: 8px 0; border-bottom: 1px solid #e2e8f0; }
        .invoice-row span { color: #64748b; }
        .invoice-row strong { color: #1e293b; text-align: right; max-width: 60%; }
        .invoice-row.pt-3 { padding-top: 16px; border-bottom: none; border-top: 2px solid #1e293b; margin-top: 8px; }
        .invoice-row.pt-3 span { color: #1e293b; font-size: 15px; font-weight: 700; }
        .text-primary { color: #2563eb !important; }
        .text-danger  { color: #dc2626 !important; }
        .text-success { color: #16a34a !important; font-size: 18px; font-weight: 800; }
        .font-mono { font-family: monospace; letter-spacing: 2px; }
        .mt-6 { margin-top: 24px; padding-top: 12px; border-top: 1px solid #e2e8f0; text-align: center; color: #64748b; }
        .mb-1 { margin-bottom: 4px; }
        .italic { font-style: italic; }
        @page { margin: 1cm; }
    </style>
</head>
<body>
    <div class="invoice-card">${invoiceEl.querySelector('.invoice-card').innerHTML}</div>
    <script>
        window.onload = function() {
            window.focus();
            window.print();
            setTimeout(function() { window.close(); }, 500);
        };
    <\/script>
</body>
</html>`);
            printWin.document.close();
        }

        // ── Table search ────────────────────────────────────────
        function filterTable() {
            const filter = document.getElementById('searchInput').value.toLowerCase();
            const table = document.getElementById('pesananTable');
            if (!table) return;
            const rows = table.getElementsByTagName('tr');

            for (let i = 1; i < rows.length; i++) {
                const tdName = rows[i].getElementsByTagName('td')[1];
                const tdNik = rows[i].getElementsByTagName('td')[2];
                if (tdName || tdNik) {
                    const txtName = tdName.textContent.toLowerCase();
                    const txtNik = tdNik.textContent.toLowerCase();
                    rows[i].style.display = (txtName.indexOf(filter) > -1 || txtNik.indexOf(filter) > -1) ? '' : 'none';
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateHargaDanKalkulasi();
        });
    </script>
</body>
</html>
