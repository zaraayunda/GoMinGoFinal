@extends('layout.dashboard')

@section('content')
<div class="container-fluid">
    <!-- Welcome Section -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center py-5">
                    <h2 class="mb-3">Selamat Datang, {{ Auth::user()->name }}! 👋</h2>
                    <p class="text-muted fs-5">Sistem Manajemen Tour Guide GoMinGo</p>
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
                                <h5 class="fw-semibold mb-3">Apa itu GoMinGo Tour Guide?</h5>
                                <p class="text-muted">
                                    GoMinGo adalah platform manajemen tour guide yang membantu para pemandu wisata 
                                    untuk mendaftarkan, mengelola, dan mempromosikan profil mereka secara online. 
                                    Sistem ini memudahkan Anda untuk mengelola informasi profil tour guide, sertifikat, 
                                    dan interaksi dengan wisatawan.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h5 class="fw-semibold mb-3">Fitur Utama</h5>
                                <ul class="text-muted">
                                    <li class="mb-2">
                                        <i class="ti ti-check text-success me-2"></i>
                                        Pendaftaran profil tour guide dengan verifikasi admin
                                    </li>
                                    <li class="mb-2">
                                        <i class="ti ti-check text-success me-2"></i>
                                        Upload sertifikat untuk keamanan dan kredibilitas
                                    </li>
                                    <li class="mb-2">
                                        <i class="ti ti-check text-success me-2"></i>
                                        Manajemen foto profil
                                    </li>
                                    <li class="mb-2">
                                        <i class="ti ti-check text-success me-2"></i>
                                        Kelola spesialisasi dan pengalaman
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
                                    <h5 class="fw-semibold text-center mb-3">Daftarkan Profil Tour Guide</h5>
                                    <p class="text-muted text-center mb-3">
                                        Lengkapi formulir pendaftaran dengan informasi lengkap tentang profil tour guide Anda, 
                                        termasuk sertifikat keahlian atau lisensi.
                                    </p>
                                    <ul class="list-unstyled text-muted small">
                                        <li class="mb-2">
                                            <i class="ti ti-arrow-right me-2 text-primary"></i>
                                            Klik menu "Tambah Tour Guide"
                                        </li>
                                        <li class="mb-2">
                                            <i class="ti ti-arrow-right me-2 text-primary"></i>
                                            Isi semua data yang diperlukan
                                        </li>
                                        <li class="mb-2">
                                            <i class="ti ti-arrow-right me-2 text-primary"></i>
                                            Upload sertifikat keahlian
                                        </li>
                                        <li>
                                            <i class="ti ti-arrow-right me-2 text-primary"></i>
                                            Upload foto profil
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
                                    <h5 class="fw-semibold text-center mb-3">Kelola Profil Tour Guide</h5>
                                    <p class="text-muted text-center mb-3">
                                        Setelah disetujui, Anda dapat mengelola profil tour guide Anda, mengupdate informasi, 
                                        dan memastikan profil Anda tetap up-to-date.
                                    </p>
                                    <ul class="list-unstyled text-muted small">
                                        <li class="mb-2">
                                            <i class="ti ti-edit me-2 text-success"></i>
                                            Edit informasi profil
                                        </li>
                                        <li class="mb-2">
                                            <i class="ti ti-photo me-2 text-success"></i>
                                            Update foto profil
                                        </li>
                                        <li class="mb-2">
                                            <i class="ti ti-certificate me-2 text-success"></i>
                                            Update sertifikat jika ada perubahan
                                        </li>
                                        <li>
                                            <i class="ti ti-info-circle me-2 text-success"></i>
                                            Kelola spesialisasi dan pengalaman
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
                                        Anda hanya bisa mendaftarkan satu profil tour guide per akun. Jika profil Anda 
                                        berstatus "Approved" atau "Pending", Anda tidak dapat mendaftarkan profil baru.
                                    </li>
                                    <li class="mb-2">
                                        <strong>Kesempatan Kedua:</strong> 
                                        Jika pendaftaran Anda ditolak (Rejected), Anda masih dapat mendaftar lagi dengan 
                                        data yang diperbaiki.
                                    </li>
                                    <li class="mb-0">
                                        <strong>Sertifikat Keahlian:</strong> 
                                        Pastikan Anda memiliki sertifikat keahlian atau lisensi yang sah untuk mendaftarkan 
                                        sebagai tour guide. Sertifikat ini penting untuk kredibilitas Anda.
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
                                        Siap untuk mendaftarkan profil tour guide Anda? Klik tombol di bawah untuk mulai proses pendaftaran.
                                    </p>
                                    <div class="d-flex gap-2">
                                        @php
                                            $canCreate = !\App\Models\TourGuide::where('user_id', Auth::id())
                                                ->whereIn('status', ['approved', 'pending'])
                                                ->exists();
                                        @endphp
                                        @if($canCreate)
                                            <a href="{{ route('tour-guide.create') }}" class="btn btn-primary" style="background-color: #007bff; border-color: #007bff; color: #fff; font-weight: 600; padding: 12px 24px; box-shadow: 0 2px 4px rgba(0,123,255,0.3);">
                                                <i class="ti ti-plus me-2"></i>Tambah Tour Guide
                                            </a>
                                        @else
                                            <button class="btn btn-secondary" disabled>
                                                <i class="ti ti-plus me-2"></i>Tambah Tour Guide
                                            </button>
                                            <small class="text-muted align-self-center ms-2">
                                                Anda sudah memiliki profil tour guide yang sedang diproses atau sudah disetujui
                                            </small>
                                        @endif
                                        <a href="{{ route('tour-guide.index') }}" class="btn btn-outline-primary">
                                            <i class="ti ti-list me-2"></i>Lihat Profil Tour Guide
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

