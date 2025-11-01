@extends('layout.dashboard')

@section('content')
<style>
    /* 🌴 ====== Tema Wisata Modern dengan Sentuhan Biru ====== */
    body {
        background: rgba(0, 102, 255, 0.4);
        font-family: 'Poppins', sans-serif;
        color: #1e293b;
    }

    .container-fluid {
        position: relative;
        z-index: 2;
    }

    /* ====== Card Styling ====== */
    .card {
        border: none;
        border-radius: 18px;
        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.15);
        backdrop-filter: blur(8px);
    }

    h2, h4, h5 {
        color: #1d4ed8;
        font-weight: 600;
    }

    .text-muted {
        color: #64748b !important;
    }

    /* ====== Hover Card Effect ====== */
    .info-box {
        transition: all 0.3s ease;
        border-left: 4px solid transparent;
    }

    .info-box:hover {
        transform: translateY(-6px);
        border-left: 4px solid #3b82f6;
        box-shadow: 0 10px 25px rgba(59, 130, 246, 0.2);
    }

    /* ====== Button Styling ====== */
    .btn-primary {
        background: #3b82f6;
        border: none;
        border-radius: 8px;
    }

    .btn-primary:hover {
        background: #2563eb;
    }

    .btn-outline-primary {
        border: 2px solid #3b82f6;
        color: #3b82f6;
        border-radius: 8px;
    }

    .btn-outline-primary:hover {
        background: #3b82f6;
        color: #fff;
    }

    /* ====== Alert Styling ====== */
    .alert-info {
        background: rgba(59, 130, 246, 0.08);
        border-color: #3b82f6;
        color: #1e40af;
    }

    /* ====== Icon ====== */
    .tour-icon {
        font-size: 2.8rem;
        color: #3b82f6;
    }

    /* ====== Border Colors ====== */
    .border-primary {
        border-top: 4px solid #3b82f6 !important;
    }

    .border-warning {
        border-top: 4px solid #fbbf24 !important;
    }

    .border-success {
        border-top: 4px solid #22c55e !important;
    }

    /* ====== Floating Animation ====== */
    @keyframes float {
        0% { transform: translateY(0); }
        50% { transform: translateY(-6px); }
        100% { transform: translateY(0); }
    }

    .floating {
        animation: float 3s ease-in-out infinite;
    }

</style>

<div class="container-fluid">
    <!-- Welcome Section -->
    <div class="row">
        <div class="col-12">
            <div class="card bg-white border-0 mt-4">
                <div class="card-body text-center py-5">
                    <i class="ti ti-map-pin tour-icon floating mb-3"></i>
                    <h2 class="mb-3">Selamat Datang, {{ Auth::user()->name }}! 👋</h2>
                    <p class="text-muted fs-5">Sistem Manajemen Tempat Wisata GoMinGo</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Penjelasan Sistem -->
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card bg-white">
                <div class="card-body">
                    <h4 class="card-title fw-semibold mb-4">
                        <i class="ti ti-info-circle me-2 text-primary"></i>Tentang Sistem
                    </h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-box mb-4 p-3 border rounded-3 bg-white">
                                <h5 class="fw-semibold mb-3">Apa itu GoMinGo?</h5>
                                <p class="text-muted">
                                    GoMinGo adalah platform manajemen tempat wisata yang membantu pemilik tempat wisata 
                                    untuk mendaftarkan, mengelola, dan mempromosikan tempat wisata mereka secara online. 
                                    Sistem ini memudahkan Anda untuk mengelola informasi tempat wisata, foto, dan interaksi 
                                    dengan pengunjung.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box mb-4 p-3 border rounded-3 bg-white">
                                <h5 class="fw-semibold mb-3">Fitur Utama</h5>
                                <ul class="text-muted">
                                    <li class="mb-2"><i class="ti ti-check text-success me-2"></i>Pendaftaran tempat wisata dengan verifikasi admin</li>
                                    <li class="mb-2"><i class="ti ti-check text-success me-2"></i>Upload bukti kepemilikan untuk keamanan</li>
                                    <li class="mb-2"><i class="ti ti-check text-success me-2"></i>Manajemen foto tempat wisata</li>
                                    <li class="mb-2"><i class="ti ti-check text-success me-2"></i>Lihat review dan interaksi pengunjung</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Panduan Sistem -->
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card bg-white">
                <div class="card-body">
                    <h4 class="card-title fw-semibold mb-4">
                        <i class="ti ti-book me-2 text-primary"></i>Panduan Penggunaan Sistem
                    </h4>
                    
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="card border-primary h-100 info-box">
                                <div class="card-body">
                                    <div class="text-center mb-3">
                                        <div class="bg-blue-100 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                            <span class="text-primary fs-2 fw-bold">1</span>
                                        </div>
                                    </div>
                                    <h5 class="fw-semibold text-center mb-3">Daftarkan Tempat Wisata</h5>
                                    <p class="text-muted text-center mb-3">
                                        Lengkapi formulir pendaftaran dengan informasi lengkap tentang tempat wisata Anda, 
                                        termasuk bukti kepemilikan atau surat izin.
                                    </p>
                                    <ul class="list-unstyled text-muted small">
                                        <li><i class="ti ti-arrow-right me-2 text-primary"></i>Klik menu "Tambah Tempat Wisata"</li>
                                        <li><i class="ti ti-arrow-right me-2 text-primary"></i>Isi semua data yang diperlukan</li>
                                        <li><i class="ti ti-arrow-right me-2 text-primary"></i>Upload bukti kepemilikan</li>
                                        <li><i class="ti ti-arrow-right me-2 text-primary"></i>Upload foto tempat wisata</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <div class="card border-warning h-100 info-box">
                                <div class="card-body">
                                    <div class="text-center mb-3">
                                        <div class="bg-yellow-100 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                            <span class="text-warning fs-2 fw-bold">2</span>
                                        </div>
                                    </div>
                                    <h5 class="fw-semibold text-center mb-3">Tunggu Persetujuan</h5>
                                    <p class="text-muted text-center mb-3">
                                        Setelah mendaftar, admin akan meninjau pendaftaran Anda. Status akan berubah menjadi 
                                        "Approved" jika disetujui atau "Rejected" jika ditolak.
                                    </p>
                                    <ul class="list-unstyled text-muted small">
                                        <li><i class="ti ti-clock me-2 text-warning"></i>Status awal: <strong>Pending</strong></li>
                                        <li><i class="ti ti-check me-2 text-success"></i>Disetujui: <strong>Approved</strong></li>
                                        <li><i class="ti ti-x me-2 text-danger"></i>Ditolak: <strong>Rejected</strong></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <div class="card border-success h-100 info-box">
                                <div class="card-body">
                                    <div class="text-center mb-3">
                                        <div class="bg-green-100 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                            <span class="text-success fs-2 fw-bold">3</span>
                                        </div>
                                    </div>
                                    <h5 class="fw-semibold text-center mb-3">Kelola Tempat Wisata</h5>
                                    <p class="text-muted text-center mb-3">
                                        Setelah disetujui, Anda dapat mengelola tempat wisata Anda, melihat review pengunjung, 
                                        dan mengupdate informasi jika diperlukan.
                                    </p>
                                    <ul class="list-unstyled text-muted small">
                                        <li><i class="ti ti-edit me-2 text-success"></i>Edit informasi tempat wisata</li>
                                        <li><i class="ti ti-photo me-2 text-success"></i>Tambah atau hapus foto</li>
                                        <li><i class="ti ti-star me-2 text-success"></i>Lihat review pengunjung</li>
                                        <li><i class="ti ti-heart me-2 text-success"></i>Lihat jumlah favorit</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Catatan Penting -->
                    <div class="alert alert-info border-2 rounded-4 shadow-sm mt-4">
                        <h5 class="alert-heading mb-3"><i class="ti ti-alert-circle me-2"></i>Catatan Penting</h5>
                        <ul class="mb-0">
                            <li><strong>Pembatasan Pendaftaran:</strong> Anda hanya bisa mendaftarkan satu tempat wisata per akun.</li>
                            <li><strong>Kesempatan Kedua:</strong> Jika pendaftaran Anda ditolak (Rejected), Anda masih dapat mendaftar lagi dengan data yang diperbaiki.</li>
                            <li><strong>Bukti Kepemilikan:</strong> Pastikan Anda memiliki dokumen sah seperti sertifikat, surat izin, atau akta.</li>
                        </ul>
                    </div>

                    <!-- Quick Start -->
                    <div class="card bg-white border-0 shadow-sm mt-4">
                        <div class="card-body">
                            <h5 class="fw-semibold mb-3"><i class="ti ti-rocket me-2 text-primary"></i>Mulai Sekarang</h5>
                            <p class="text-muted mb-3">Siap untuk mendaftarkan tempat wisata Anda? Klik tombol di bawah untuk mulai proses pendaftaran.</p>
                            <div class="d-flex gap-2">
                                @php
                                    $canCreate = !\App\Models\TempatWisata::where('user_id', Auth::id())
                                        ->whereIn('status', ['approved', 'pending'])
                                        ->exists();
                                @endphp
                                @if($canCreate)
                                    <a href="{{ route('tempat-wisata.create') }}" class="btn btn-primary" style="background-color: #007bff; border-color: #007bff; color: #fff; font-weight: 600; padding: 12px 24px; box-shadow: 0 2px 4px rgba(0,123,255,0.3);">
                                        <i class="ti ti-plus me-2"></i>Tambah Tempat Wisata
                                    </a>
                                @else
                                    <button class="btn btn-secondary" disabled>
                                        <i class="ti ti-plus me-2"></i>Tambah Tempat Wisata
                                    </button>
                                    <small class="text-muted align-self-center ms-2">Anda sudah memiliki tempat wisata yang sedang diproses atau disetujui</small>
                                @endif
                                <a href="{{ route('tempat-wisata.index') }}" class="btn btn-outline-primary">
                                    <i class="ti ti-list me-2"></i>Lihat Daftar Tempat Wisata
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
