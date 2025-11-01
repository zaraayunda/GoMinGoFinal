<!DOCTYPE html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>GoMinGo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-5.0.0-beta1.min.css') }}" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/LineIcons.2.0.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/lindy-uikit.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />
    <style>
        .tg-card {
            transition: transform .15s ease, box-shadow .15s ease
        }

        .tg-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 40px rgba(0, 0, 0, .08)
        }

        .filter .btn {
            border-radius: 999px
        }
    </style>
</head>

<body>
    <section id="home" class="hero-section-wrapper-5">
        <header class="header header-6">
            <div class="navbar-area">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <nav class="navbar navbar-expand-lg">
                                <a class="navbar-brand" href="{{ url('/') }}">
                                    <img src="{{ asset('assets/img/logo/logogo.png') }}" alt="Logo" width="120"
                                        height="120" />
                                </a>
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#navbarSupportedContent6">
                                    <span class="toggler-icon"></span><span class="toggler-icon"></span><span
                                        class="toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent6">
                                    <ul id="nav6" class="navbar-nav ms-auto">
                                        <li class="nav-item">
                                            <a class="page-scroll active" href="{{ url('/') }}">Home</a>
                                            <a class="page-scroll active" href="#tourguide">Tour Guide</a>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </section>

    <section id="event-detail" class="pt-100 pb-100" style="background-color: #f9fafc;">
        <div class="container">

            <!-- Judul Halaman -->
            <div class="section-title text-center mb-5">
                <h2 class="fw-bold text-primary">Detail Event</h2>
                <p class="text-muted">Informasi lengkap tentang acara wisata dan kegiatan menarik.</p>
            </div>

            <!-- Konten Event -->
            <div class="row justify-content-center">
                <div class="col-lg-9">

                    <!-- Foto & Nama Event -->
                    <div class="text-center mb-5">
                        <img src="assets/img/event/sample.jpg" alt="Nama Event"
                            class="img-fluid rounded-4 shadow-sm mb-3" style="max-height: 350px; object-fit: cover;">
                        <h2 class="fw-bold text-dark">Festival Tabuik 2025</h2>

                        <!-- Status Event -->
                        <span class="badge bg-primary px-3 py-2 rounded-pill">Upcoming</span>
                    </div>

                    <!-- Informasi Utama -->
                    <div class="row g-4 mb-5">
                        <div class="col-md-6">
                            <div class="p-3 rounded-3 bg-light h-100 shadow-sm">
                                <h6 class="fw-semibold text-secondary mb-2">
                                    <i class="bi bi-calendar-event me-2 text-primary"></i>Tanggal Mulai
                                </h6>
                                <p class="mb-0">01 November 2025</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 rounded-3 bg-light h-100 shadow-sm">
                                <h6 class="fw-semibold text-secondary mb-2">
                                    <i class="bi bi-calendar2-check me-2 text-primary"></i>Tanggal Selesai
                                </h6>
                                <p class="mb-0">05 November 2025</p>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="p-3 rounded-3 border h-100 shadow-sm bg-white">
                                <h6 class="fw-semibold text-secondary mb-2">
                                    <i class="bi bi-geo-alt me-2 text-primary"></i>Lokasi
                                </h6>
                                <p class="mb-1">Pantai Gandoriah, Kota Pariaman</p>
                                <small class="text-muted d-block mb-2">
                                    Lat: -0.621, Long: 100.118
                                </small>
                                <a href="https://www.google.com/maps?q=-0.621,100.118" target="_blank"
                                    class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                    <i class="bi bi-map me-1"></i>Lihat di Google Maps
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi Event -->
                    <div class="p-4 rounded-4 shadow-sm border bg-white mb-5">
                        <h4 class="fw-semibold mb-3 text-primary">
                            <i class="bi bi-file-earmark-text me-2"></i>Deskripsi
                        </h4>
                        <p class="text-muted" style="text-align: justify;">
                            Festival Tabuik merupakan tradisi tahunan masyarakat Pariaman yang sarat dengan nilai budaya
                            dan spiritual.
                            Acara ini menampilkan parade, atraksi budaya, dan kegiatan masyarakat lokal yang menarik
                            wisatawan.
                        </p>
                    </div>

                    <!-- Statistik & Informasi -->
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm p-4">
                                <h6 class="fw-bold text-secondary mb-3">📊 Statistik</h6>
                                <p class="mb-1"><i class="bi bi-image me-2 text-primary"></i>1 Foto</p>
                                <p class="mb-0"><i class="bi bi-people me-2 text-primary"></i>120 Pendaftar</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm p-4">
                                <h6 class="fw-bold text-secondary mb-3">📅 Informasi Event</h6>
                                <p class="mb-1">
                                    <i class="bi bi-calendar me-2 text-primary"></i>Dibuat: 01 Nov 2025
                                </p>
                                <p class="mb-0">
                                    <i class="bi bi-pencil me-2 text-primary"></i>Diperbarui: 01 Nov 2025
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="text-center mt-4">
                        <button class="btn btn-primary px-4 py-2 rounded-pill shadow-sm me-2">
                            <i class="bi bi-person-plus me-1"></i> Daftar Event
                        </button>
                        <button class="btn btn-outline-secondary px-4 py-2 rounded-pill shadow-sm">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('assets/js/bootstrap-5.0.0-beta1.min.js') }}"></script>
    <script src="{{ asset('assets/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
