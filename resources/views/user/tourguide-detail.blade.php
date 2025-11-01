<!DOCTYPE html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>GoMinGo</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Place favicon.ico in the root directory -->

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-5.0.0-beta1.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/LineIcons.2.0.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/lindy-uikit.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />
    <!-- Tambahkan di <head> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
</head>

<body>
    <!--[if lte IE 9]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
      </p>
    <![endif]-->

    <!-- ========================= preloader start ========================= -->
    <div class="preloader">
        <div class="loader">
            <div class="spinner">
                <div class="spinner-container">
                    <div class="spinner-rotator">
                        <div class="spinner-left">
                            <div class="spinner-circle"></div>
                        </div>
                        <div class="spinner-right">
                            <div class="spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ========================= preloader end ========================= -->

    <!-- ========================= hero-section-wrapper-5 start ========================= -->
    <section id="home" class="hero-section-wrapper-5">

        <!-- ========================= header-6 start ========================= -->
        <header class="header header-6">
            <div class="navbar-area">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <nav class="navbar navbar-expand-lg">
                                <a class="navbar-brand" href="index.html">
                                    <img src="{{ asset('assets/img/logo/logogo.png') }}" alt="Logo" width="120"
                                        height="120" />
                                </a>
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#navbarSupportedContent6" aria-controls="navbarSupportedContent6"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="toggler-icon"></span>
                                    <span class="toggler-icon"></span>
                                    <span class="toggler-icon"></span>
                                </button>

                                <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent6">
                                    <ul id="nav6" class="navbar-nav ms-auto">
                                        <li class="nav-item">
                                            <a class="page-scroll active" href="{{ url('/') }}">Home</a>
                                            <a class="page-scroll active" href="#wisata">Tour Guide</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- navbar collapse -->
                            </nav>
                            <!-- navbar -->
                        </div>
                    </div>
                    <!-- row -->
                </div>
                <!-- container -->
            </div>
            <!-- navbar area -->
        </header>
        <!-- ========================= header-6 end ========================= -->

        <!-- ========================= hero-5 start ========================= -->
    </section>
    <!-- ========================= hero-section-wrapper-6 end ========================= -->

    <!-- ========================= feature style-5 start ========================= -->
    <section id="wisata" class="katalog-wisata-section py-5 bg-light">
        <div class="container">

            <!-- Judul -->
            <div class="section-title text-center mb-5">
                <h2 class="fw-bold display-6 text-primary">Detail Tour Guide</h2>
                <p class="text-muted">Temukan pengalaman terbaik bersama tour guide pilihanmu.</p>
                <div class="mx-auto mt-3"
                    style="width: 80px; height: 3px; background-color: #0d6efd; border-radius: 2px;"></div>
            </div>

            <!-- Detail Wisata -->
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="p-5 rounded-4 shadow-lg border-0 bg-white position-relative overflow-hidden animate__animated animate__fadeInUp"
                        style="animation-duration: 0.7s;">

                        <!-- Hiasan background blur -->
                        <div class="position-absolute top-0 end-0 opacity-10" style="z-index:0;">
                            <i class="bi bi-globe-americas display-1 text-primary"></i>
                        </div>

                        <div class="text-center mb-4 position-relative" style="z-index:1;">
                            <img src="{{ $guide->foto_url }}" alt="{{ $guide->nama }}"
                                class="rounded-circle border border-4 border-primary shadow"
                                style="width:130px;height:130px;object-fit:cover;">
                            <h3 class="fw-bold mt-3 mb-1 text-dark">{{ $guide->nama }}</h3>
                            <div class="text-muted mb-2">Spesialis {{ ucfirst($guide->spesialisasi ?? '-') }}</div>
                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">
                                <i class="bi bi-star-fill me-1"></i> Guide Profesional
                            </span>
                        </div>

                        <!-- Informasi -->
                        <div class="row g-3 position-relative" style="z-index:1;">
                            <div class="col-md-6">
                                <div class="p-3 rounded-3 border bg-light-subtle h-100">
                                    <div class="fw-semibold text-primary mb-2">
                                        <i class="bi bi-briefcase-fill me-2"></i> Pengalaman
                                    </div>
                                    <div>{{ $guide->pengalaman ?? '—' }}</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="p-3 rounded-3 border bg-light-subtle h-100">
                                    <div class="fw-semibold text-primary mb-2">
                                        <i class="bi bi-telephone-fill me-2"></i> Kontak
                                    </div>
                                    <div>{{ $guide->kontak ?? '—' }}</div>
                                </div>
                            </div>

                            @if ($bahasa && $bahasa->count())
                                <div class="col-md-6">
                                    <div class="p-3 rounded-3 border bg-light-subtle h-100">
                                        <div class="fw-semibold text-primary mb-2">
                                            <i class="bi bi-translate me-2"></i> Bahasa
                                        </div>
                                        @foreach ($bahasa as $b)
                                            <span
                                                class="badge bg-primary bg-opacity-10 text-primary border me-1 mb-1">{{ $b }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            @if ($sertifikat && $sertifikat->count())
                                <div class="col-md-6">
                                    <div class="p-3 rounded-3 border bg-light-subtle h-100">
                                        <div class="fw-semibold text-primary mb-2">
                                            <i class="bi bi-award-fill me-2"></i> Sertifikat
                                        </div>
                                        <ul class="mb-0 ps-3">
                                            @foreach ($sertifikat as $s)
                                                <li>{{ $s }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex gap-3 justify-content-center mt-5">
                            <a href="{{ url()->previous() }}"
                                class="btn btn-outline-secondary px-4 py-2 rounded-pill">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>
                            @if ($guide->wa_link)
                                <a href="{{ $guide->wa_link }}" target="_blank"
                                    class="btn btn-success px-4 py-2 rounded-pill shadow-sm">
                                    <i class="bi bi-whatsapp me-1"></i> Hubungi via WhatsApp
                                </a>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>




    <!-- ========================= footer style-4 start ========================= -->
    <footer class="footer footer-style-4">
        <div class="container">
            <div class="widget-wrapper">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="footer-widget wow fadeInUp" data-wow-delay=".2s">
                            <div class="logo">
                                <a href="#0"> <img src="{{ asset('assets/img/logo/logo.svg') }}"
                                        alt="">
                                </a>
                            </div>
                            <p class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Facilisis nulla
                                placerat amet amet congue.</p>
                            <ul class="socials">
                                <li> <a href="#0"> <i class="lni lni-facebook-filled"></i> </a> </li>
                                <li> <a href="#0"> <i class="lni lni-twitter-filled"></i> </a> </li>
                                <li> <a href="#0"> <i class="lni lni-instagram-filled"></i> </a> </li>
                                <li> <a href="#0"> <i class="lni lni-linkedin-original"></i> </a> </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-2 offset-xl-1 col-lg-2 col-md-6 col-sm-6">
                        <div class="footer-widget wow fadeInUp" data-wow-delay=".3s">
                            <h6>Quick Link</h6>
                            <ul class="links">
                                <li> <a href="#0">Home</a> </li>
                                <li> <a href="#0">About</a> </li>
                                <li> <a href="#0">Service</a> </li>
                                <li> <a href="#0">Testimonial</a> </li>
                                <li> <a href="#0">Contact</a> </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                        <div class="footer-widget wow fadeInUp" data-wow-delay=".4s">
                            <h6>Services</h6>
                            <ul class="links">
                                <li> <a href="#0">Web Design</a> </li>
                                <li> <a href="#0">Web Development</a> </li>
                                <li> <a href="#0">Seo Optimization</a> </li>
                                <li> <a href="#0">Blog Writing</a> </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="footer-widget wow fadeInUp" data-wow-delay=".5s">
                            <h6>Download App</h6>
                            <ul class="download-app">
                                <li>
                                    <a href="#0">
                                        <span class="icon"><i class="lni lni-apple"></i></span>
                                        <span class="text">Download on the <b>App Store</b> </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#0">
                                        <span class="icon"><i class="lni lni-play-store"></i></span>
                                        <span class="text">GET IT ON <b>Play Store</b> </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright-wrapper wow fadeInUp" data-wow-delay=".2s">
                <p>Design and Developed by <a href="https://uideck.com" rel="nofollow" target="_blank">UIdeck</a>
                    Built-with <a href="https://uideck.com" rel="nofollow" target="_blank">Lindy UI Kit</a>.
                    Distributed by <a href="https://themewagon.com" target="_blank">ThemeWagon</a></p>
            </div>
        </div>
    </footer>
    <!-- ========================= footer style-4 end ========================= -->

    <!-- ========================= scroll-top start ========================= -->
    <a href="#" class="scroll-top"> <i class="lni lni-chevron-up"></i> </a>
    <!-- ========================= scroll-top end ========================= -->


    <!-- ========================= JS here ========================= -->
    <script src="{{ asset('assets/js/bootstrap-5.0.0-beta1.min.js') }}"></script>
    <script src="{{ asset('assets/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
