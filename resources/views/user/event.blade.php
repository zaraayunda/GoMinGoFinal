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
                                            <a class="page-scroll active" href="#event-list">Event</a>
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

    <section id="event-list" class="pt-100 pb-100" style="background-color:#f9fafc;">
        <div class="container">

            <!-- Judul -->
            <div class="section-title text-center mb-5">
                <h2 class="fw-bold text-primary">Katalog Event Wisata</h2>
                <p class="text-muted">Temukan berbagai acara wisata menarik di seluruh daerah.</p>
            </div>

            <!-- Grid Event Cards -->
            <div class="row g-4">

                <!-- Card 1 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                        <div class="position-relative">
                            <img src="assets/img/event/sample1.jpg" class="card-img-top" alt="Event 1"
                                style="height:220px; object-fit:cover;">
                            <span
                                class="badge bg-success position-absolute top-0 end-0 m-3 px-3 py-2 rounded-pill shadow-sm">Upcoming</span>
                        </div>
                        <div class="card-body">
                            <h5 class="fw-bold text-dark">Festival Tabuik 2025</h5>
                            <p class="text-muted small mb-3"><i class="bi bi-geo-alt me-1 text-primary"></i>Pariaman,
                                Sumatera Barat</p>
                            <p class="text-secondary mb-3" style="font-size: 0.9rem;">
                                Perayaan budaya dan tradisi unik masyarakat Pariaman yang berlangsung meriah setiap
                                tahun.
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted small"><i class="bi bi-calendar-event me-1"></i>1–5 Nov
                                    2025</span>
                                <a href="{{ url('detailevent') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">Lihat
                                    Detail</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                        <div class="position-relative">
                            <img src="assets/img/event/sample2.jpg" class="card-img-top" alt="Event 2"
                                style="height:220px; object-fit:cover;">
                            <span
                                class="badge bg-primary position-absolute top-0 end-0 m-3 px-3 py-2 rounded-pill shadow-sm">Ongoing</span>
                        </div>
                        <div class="card-body">
                            <h5 class="fw-bold text-dark">Festival Danau Maninjau</h5>
                            <p class="text-muted small mb-3"><i class="bi bi-geo-alt me-1 text-primary"></i>Agam,
                                Sumatera Barat</p>
                            <p class="text-secondary mb-3" style="font-size: 0.9rem;">
                                Nikmati keindahan alam dan budaya khas Minangkabau dalam satu festival spektakuler.
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted small"><i class="bi bi-calendar-event me-1"></i>28 Okt – 3 Nov
                                    2025</span>
                                <a href="{{ url('detailevent') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">Lihat
                                    Detail</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                        <div class="position-relative">
                            <img src="assets/img/event/sample3.jpg" class="card-img-top" alt="Event 3"
                                style="height:220px; object-fit:cover;">
                            <span
                                class="badge bg-secondary position-absolute top-0 end-0 m-3 px-3 py-2 rounded-pill shadow-sm">Selesai</span>
                        </div>
                        <div class="card-body">
                            <h5 class="fw-bold text-dark">Festival Pagaruyung</h5>
                            <p class="text-muted small mb-3"><i
                                    class="bi bi-geo-alt me-1 text-primary"></i>Batusangkar, Tanah Datar</p>
                            <p class="text-secondary mb-3" style="font-size: 0.9rem;">
                                Event budaya menampilkan kesenian dan tradisi kerajaan Minangkabau yang megah.
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted small"><i class="bi bi-calendar-event me-1"></i>12–14 Okt
                                    2025</span>
                                <a href="{{ url('detailevent') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">Lihat
                                    Detail</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- End Row -->
        </div>
    </section>

    <script src="{{ asset('assets/js/bootstrap-5.0.0-beta1.min.js') }}"></script>
    <script src="{{ asset('assets/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
