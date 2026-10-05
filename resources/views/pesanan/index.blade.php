<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
            --success-color: #198754;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --info-color: #0dcaf0;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --border-radius: 0.5rem;
            --box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        body {
            background-color: var(--light-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container-custom {
            max-width: 1200px;
        }
        .card-header {
            background: linear-gradient(135deg, var(--primary-color), #0b5ed7);
            color: white;
            border-top-left-radius: var(--border-radius);
            border-top-right-radius: var(--border-radius);
        }
        .btn {
            border-radius: var(--border-radius);
            font-weight: 600;
            padding: 0.5rem 1.5rem;
            transition: all 0.2s ease;
        }
        .btn-primary {
            background: linear-gradient(to right, var(--primary-color), #0b5ed7);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(to right, #0b5ed7, var(--primary-color));
            transform: translateY(-2px);
            box-shadow: var(--box-shadow);
        }
        .btn-outline-secondary {
            border-color: var(--secondary-color);
            color: var(--secondary-color);
        }
        .btn-outline-secondary:hover {
            background-color: var(--secondary-color);
            color: white;
        }
        .table {
            --bs-table-bg: var(--light-color);
        }
        .table th {
            background-color: var(--primary-color);
            color: white;
            border-color: #dee2e6;
        }
        .table td, .table th {
            vertical-align: middle;
        }
        .badge {
            font-weight: 600;
            padding: 0.5em 0.8em;
            border-radius: 0.3rem;
        }
        .badge-success {
            background-color: #d1e7dd;
            color: #0f5132;
        }
        .badge-danger {
            background-color: #f8d7da;
            color: #842029;
        }
        .status-badge {
            font-size: 0.85em;
            padding: 0.3em 0.6em;
        }
        .action-buttons .btn {
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
            padding: 0.3rem 0.8rem;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
<div class="container py-4">
    <div class="row mb-4">
        <div class="col">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header py-4">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-list-task me-3 fs-4"></i>
                        <h5 class="mb-0">Daftar Pesanan Hotel</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div>
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="bi bi-check-circle me-2"></i>
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                        </div>
                        <div>
                            <a href="{{ route('pesanan.create') }}" class="btn btn-primary me-2">
                                <i class="bi bi-plus-lg me-2"></i>Pesan Kamar Baru
                            </a>
                        </div>
                    </div>

                    @if($pesanans->isEmpty())
                        <div class="text-center py-5">
                            <i class="bi bi-inbox display-4 text-muted mb-4"></i>
                            <p class="lead text-muted">Belum ada pesanan</p>
                            <a href="{{ route('pesanan.create') }}" class="btn btn-outline-primary">
                                <i class="bi bi-plus-lg me-2"></i>Buat Pesanan Pertama
                            </a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Pemesan</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Nomor Identitas</th>
                                        <th>Tipe Kamar</th>
                                        <th>Harga/Malam</th>
                                        <th>Durasi</th>
                                        <th>Breakfast</th>
                                        <th>Total Harga</th>
                                        <th>Tanggal Pesan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pesanans as $pesanan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pesanan->nama }}</td>
                                            <td>
                                                <span class="badge bg-{{ $pesanan->kelamin == 'Laki-laki' ? 'primary' : 'secondary' }}">{{ $pesanan->kelamin }}</span>
                                            </td>
                                            <td>{{ $pesanan->nomor_identitas }}</td>
                                            <td>
                                                <span class="badge bg-{{ $pesanan->tipe_kamar == 'Standard' ? 'info' : ($pesanan->tipe_kamar == 'Deluxe' ? 'warning' : 'danger') }}">
                                                    {{ $pesanan->tipe_kamar }}
                                                </span>
                                            </td>
                                            <td>Rp {{ number_format($pesanan->harga, 0, ',', '.') }}</td>
                                            <td>{{ $pesanan->durasi_menginap }} malam</td>
                                            <td>
                                                <span class="badge bg-{{ $pesanan->termasuk_breakfast ? 'success' : 'secondary' }}">
                                                    {{ $pesanan->termasuk_breakfast ? 'Ya' : 'Tidak' }}
                                                </span>
                                            </td>
                                            <td>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                                            <td>
                                                {{ $pesanan->tanggal_pesan ? \Carbon\Carbon::parse($pesanan->tanggal_pesan)->format('d-m-Y') : '<span class="text-muted">-</span>' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>