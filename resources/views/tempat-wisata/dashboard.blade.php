@extends('layout.dashboard')

@section('content')
<div class="container-fluid">
    <!-- Welcome Section -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center py-5">
                    <h2 class="mb-3">Selamat Datang, {{ Auth::user()->name }}! 👋</h2>
                    <p class="text-muted fs-5">Sistem Manajemen Tempat Wisata GoMinGo</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Penjelasan Sistem -->
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title fw-semibold mb-4">
                        <i class="ti ti-info-circle me-2 text-primary"></i>Tentang Sistem
                    </h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
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
                            <div class="mb-4">
                                <h5 class="fw-semibold mb-3">Fitur Utama</h5>
                                <ul class="text-muted">
                                    <li class="mb-2">
                                        <i class="ti ti-check text-success me-2"></i>
                                        Pendaftaran tempat wisata dengan verifikasi admin
                                    </li>
                                    <li class="mb-2">
                                        <i class="ti ti-check text-success me-2"></i>
                                        Upload bukti kepemilikan untuk keamanan
                                    </li>
                                    <li class="mb-2">
                                        <i class="ti ti-check text-success me-2"></i>
                                        Manajemen foto tempat wisata
                                    </li>
                                    <li class="mb-2">
                                        <i class="ti ti-check text-success me-2"></i>
                                        Lihat review dan interaksi pengunjung
                                    </li>
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
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title fw-semibold mb-4">
                        <i class="ti ti-book me-2 text-primary"></i>Panduan Penggunaan Sistem
                    </h4>
                    
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="card border-primary h-100">
                                <div class="card-body">
                                    <div class="text-center mb-3">
                                        <div class="bg-primary-subtle rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                            <span class="text-primary fs-2 fw-bold">1</span>
                                        </div>
                                    </div>
                                    <h5 class="fw-semibold text-center mb-3">Daftarkan Tempat Wisata</h5>
                                    <p class="text-muted text-center mb-3">
                                        Lengkapi formulir pendaftaran dengan informasi lengkap tentang tempat wisata Anda, 
                                        termasuk bukti kepemilikan atau surat izin.
                                    </p>
                                    <ul class="list-unstyled text-muted small">
                                        <li class="mb-2">
                                            <i class="ti ti-arrow-right me-2 text-primary"></i>
                                            Klik menu "Tambah Tempat Wisata"
                                        </li>
                                        <li class="mb-2">
                                            <i class="ti ti-arrow-right me-2 text-primary"></i>
                                            Isi semua data yang diperlukan
                                        </li>
                                        <li class="mb-2">
                                            <i class="ti ti-arrow-right me-2 text-primary"></i>
                                            Upload bukti kepemilikan
                                        </li>
                                        <li>
                                            <i class="ti ti-arrow-right me-2 text-primary"></i>
                                            Upload foto tempat wisata
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <div class="card border-warning h-100">
                                <div class="card-body">
                                    <div class="text-center mb-3">
                                        <div class="bg-warning-subtle rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                            <span class="text-warning fs-2 fw-bold">2</span>
                                        </div>
                                    </div>
                                    <h5 class="fw-semibold text-center mb-3">Tunggu Persetujuan</h5>
                                    <p class="text-muted text-center mb-3">
                                        Setelah mendaftar, admin akan meninjau pendaftaran Anda. Status akan berubah menjadi 
                                        "Approved" jika disetujui atau "Rejected" jika ditolak.
                                    </p>
                                    <ul class="list-unstyled text-muted small">
                                        <li class="mb-2">
                                            <i class="ti ti-clock me-2 text-warning"></i>
                                            Status awal: <strong>Pending</strong>
                                        </li>
                                        <li class="mb-2">
                                            <i class="ti ti-check me-2 text-success"></i>
                                            Disetujui: <strong>Approved</strong>
                                        </li>
                                        <li>
                                            <i class="ti ti-x me-2 text-danger"></i>
                                            Ditolak: <strong>Rejected</strong>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <div class="card border-success h-100">
                                <div class="card-body">
                                    <div class="text-center mb-3">
                                        <div class="bg-success-subtle rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                            <span class="text-success fs-2 fw-bold">3</span>
                                        </div>
                                    </div>
                                    <h5 class="fw-semibold text-center mb-3">Kelola Tempat Wisata</h5>
                                    <p class="text-muted text-center mb-3">
                                        Setelah disetujui, Anda dapat mengelola tempat wisata Anda, melihat review pengunjung, 
                                        dan mengupdate informasi jika diperlukan.
                                    </p>
                                    <ul class="list-unstyled text-muted small">
                                        <li class="mb-2">
                                            <i class="ti ti-edit me-2 text-success"></i>
                                            Edit informasi tempat wisata
                                        </li>
                                        <li class="mb-2">
                                            <i class="ti ti-photo me-2 text-success"></i>
                                            Tambah atau hapus foto
                                        </li>
                                        <li class="mb-2">
                                            <i class="ti ti-star me-2 text-success"></i>
                                            Lihat review pengunjung
                                        </li>
                                        <li>
                                            <i class="ti ti-heart me-2 text-success"></i>
                                            Lihat jumlah favorit
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Catatan Penting -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="alert alert-info">
                                <h5 class="alert-heading mb-3">
                                    <i class="ti ti-alert-circle me-2"></i>Catatan Penting
                                </h5>
                                <ul class="mb-0">
                                    <li class="mb-2">
                                        <strong>Pembatasan Pendaftaran:</strong> 
                                        Anda hanya bisa mendaftarkan satu tempat wisata per akun. Jika tempat wisata Anda 
                                        berstatus "Approved" atau "Pending", Anda tidak dapat mendaftarkan tempat wisata baru.
                                    </li>
                                    <li class="mb-2">
                                        <strong>Kesempatan Kedua:</strong> 
                                        Jika pendaftaran Anda ditolak (Rejected), Anda masih dapat mendaftar lagi dengan 
                                        data yang diperbaiki.
                                    </li>
                                    <li class="mb-0">
                                        <strong>Bukti Kepemilikan:</strong> 
                                        Pastikan Anda memiliki dokumen sah seperti sertifikat, surat izin, akta, atau 
                                        dokumen lainnya untuk mendaftarkan tempat wisata.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Start -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h5 class="fw-semibold mb-3">
                                        <i class="ti ti-rocket me-2 text-primary"></i>Mulai Sekarang
                                    </h5>
                                    <p class="text-muted mb-3">
                                        Siap untuk mendaftarkan tempat wisata Anda? Klik tombol di bawah untuk mulai proses pendaftaran.
                                    </p>
                                    <div class="d-flex gap-2">
                                        @php
                                            $canCreate = !\App\Models\TempatWisata::where('user_id', Auth::id())
                                                ->whereIn('status', ['approved', 'pending'])
                                                ->exists();
                                        @endphp
                                        @if($canCreate)
                                            <a href="{{ route('tempat-wisata.create') }}" class="btn btn-primary">
                                                <i class="ti ti-plus me-2"></i>Tambah Tempat Wisata
                                            </a>
                                        @else
                                            <button class="btn btn-secondary" disabled>
                                                <i class="ti ti-plus me-2"></i>Tambah Tempat Wisata
                                            </button>
                                            <small class="text-muted align-self-center ms-2">
                                                Anda sudah memiliki tempat wisata yang sedang diproses atau sudah disetujui
                                            </small>
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
    </div>
</div>
@endsection
