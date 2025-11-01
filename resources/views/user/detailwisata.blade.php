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
                                            <a class="page-scroll active" href="#wisata">Tempat Wisata</a>
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
    <section id="wisata" class="katalog-wisata-section pt-100 pb-100">
        <div class="container">

            <!-- Judul -->
            <div class="section-title text-center mb-40">
                <h2 class="fw-bold">Detail Tempat Wisata</h2>
                <p class="text-muted">Temukan berbagai destinasi wisata menarik dan pilih tour guide favoritmu.</p>
            </div>

            <!-- Detail Wisata -->
            <div class="wisata-detail-card p-4 rounded-4 shadow-sm border mb-5">

                <!-- FOTO-FOTO WISATA -->
                <div class="wisata-photo-gallery d-flex flex-wrap justify-content-center gap-3 mb-4">
                    <img src="{{ asset('assets/img/wisata/foto1.jpg') }}" alt="Foto 1" class="foto-wisata">
                    <img src="{{ asset('assets/img/wisata/foto2.jpg') }}" alt="Foto 2" class="foto-wisata">
                    <img src="{{ asset('assets/img/wisata/foto3.jpg') }}" alt="Foto 3" class="foto-wisata">
                    <img src="{{ asset('assets/img/wisata/foto4.jpg') }}" alt="Foto 4" class="foto-wisata">
                    <img src="{{ asset('assets/img/wisata/foto5.jpg') }}" alt="Foto 5" class="foto-wisata">
                </div>

                <!-- DETAIL INFORMASI -->
                <div class="detail-wisata mt-4">
                    <h4 class="mb-3 text-primary border-bottom pb-2">Detail Tempat Wisata</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="namawisata" class="form-label fw-semibold">Nama Tempat</label>
                            <input type="text" id="namawisata" class="form-control border border-2 rounded-3"
                                readonly>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
                            <textarea id="deskripsi" class="form-control border border-2 rounded-3" rows="3" readonly></textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="harga" class="form-label fw-semibold">Harga Tiket</label>
                            <input type="text" id="harga" class="form-control border border-2 rounded-3"
                                readonly>
                        </div>

                        <div class="col-md-6 mb-3 d-flex align-items-end">
                            <button class="filter-btn active w-100 py-2">Google Map</button>
                        </div>
                    </div>
                </div>

            </div>


            <!-- Tour Guide Section -->
            <div class="tourguide-section p-4 rounded-4 shadow-sm border">
                <h4 class="text-center text-primary fw-bold mb-4 border-bottom pb-2">Tour Guide yang Disarankan</h4>
                <div class="row justify-content-center" id="tourGuideList">

                    <!-- Kartu Tour Guide -->
                    <div class="col-lg-3 col-md-4 col-sm-6 text-center mb-4">
                        <div class="tourguide-card p-3 shadow-sm rounded-4 border border-2">
                            <div class="guide-photo mb-3">
                                <img src="{{ asset('assets/img/tourguide/foto1.jpeg') }}" alt="Budi"
                                    class="rounded-circle border border-3"
                                    style="width: 100px; height: 100px; object-fit: cover;">
                            </div>
                            <h5 class="fw-bold mb-1">Budi</h5>
                            <p class="text-muted mb-2">Spesialis Wisata Alam</p>
                            <div class="rating mb-3">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star text-warning"></i>
                            </div>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="#0" class="btn btn-outline-primary btn-sm px-3">Detail</a>
                                <a href="https://wa.me/6281234567890" target="_blank"
                                    class="btn btn-success btn-sm px-3">Hubungi</a>
                            </div>
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
