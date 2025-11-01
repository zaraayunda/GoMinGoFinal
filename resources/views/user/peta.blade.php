
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
                    <img src="{{ asset('assets/img/logo/logogo.png') }}" alt="Logo" width="120" height="120"/>
                  </a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent6" aria-controls="navbarSupportedContent6" aria-expanded="false" aria-label="Toggle navigation">
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
      <div class="hero-section hero-style-5 img-bg" style="background-image: url('{{ asset('assets/img/hero/hero-5/hero-bg.svg') }}')">
        <div class="container">
          <div class="row">
            <div class="col-lg-6">
              <div class="hero-content-wrapper">
                <h2 class="mb-30 wow fadeInUp" data-wow-delay=".2s">You're Using Free Lite Version</h2>
                <p class="mb-30 wow fadeInUp" data-wow-delay=".4s">Please purchase full version of the template to get all sections and permission to use with commercial projects.</p>
                <a href="#0" class="button button-lg radius-50 wow fadeInUp" data-wow-delay=".6s">Get Started <i class="lni lni-chevron-right"></i> </a>
              </div>
            </div>
            <div class="col-lg-6 align-self-end">
              <div class="hero-image wow fadeInUp" data-wow-delay=".5s">
                <img src="{{ asset('assets/img/hero/hero-5/hero-img.svg') }}" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- ========================= hero-5 end ========================= -->

    </section>
    <!-- ========================= hero-section-wrapper-6 end ========================= -->

    <!-- ========================= feature style-5 start ========================= -->
    <section id="wisata" class="katalog-wisata-section pt-100 pb-100">
        <div class="container">

            <!-- Filter Tombol -->
            <div class="section-title text-center mb-40">
                <h2>Katalog Tempat Wisata</h2>
                <p>Temukan berbagai destinasi wisata menarik dan pilih tour guide favoritmu.</p>
            </div>

            <!-- Pencarian -->
            <div class="text-center mb-4">
                <div class="d-flex justify-content-center">
                    <div class="position-relative w-75">
                        <input type="text" id="searchGuide"
                            class="form-control rounded-pill ps-4 pe-5 py-3 fs-5 shadow-sm" placeholder="Cari Wisata...">
                        <button type="button"
                            class="btn position-absolute top-50 end-0 translate-middle-y me-2 text-primary"
                            style="background: none; border: none;">
                            <i class="bi bi-search fs-3"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Filter Kategori -->
            <div class="text-center mb-50">
                <button class="filter-btn active" data-filter="all">Semua</button>
                <button class="filter-btn" data-filter="alam">Wisata Alam</button>
                <button class="filter-btn" data-filter="kuliner">Wisata Kuliner</button>
                <button class="filter-btn" data-filter="budaya">Wisata Budaya</button>
            </div>

            <!-- Daftar Kartu Wisata -->
            <div class="row justify-content-center" id="wisata-list">

                <!-- Alam -->
                <div class="col-lg-3 col-md-6 col-sm-12 wisata-item" data-category="alam">
                    <div class="single-pricing-wrapper">
                        <div class="single-pricing">
                            <div class="img-wrapper">
                                <img src="{{ asset('assets/img/wisata/foto1.jpeg') }}" alt="Pantai Padang"
                                    class="img-fluid">
                            </div>
                            <h4>Pantai Padang</h4>
                            <p>Kota Padang, Sumatera Barat</p>
                            <a href="{{ url('/detailwisata') }}" class="button radius-30 lihat-detail">Lihat Detail</a>
                        </div>
                    </div>
                </div>

                <!-- Kuliner -->
                <div class="col-lg-3 col-md-6 col-sm-12 wisata-item" data-category="kuliner">
                    <div class="single-pricing-wrapper">
                        <div class="single-pricing">
                            <div class="img-wrapper">
                                <img src="{{ asset('assets/img/wisata/foto1.jpeg') }}" alt="Rendang Padang"
                                    class="img-fluid">
                            </div>
                            <h4>Rumah Makan Sederhana</h4>
                            <p>Padang, Sumatera Barat</p>
                            <a href="{{ url('/detailwisata') }}" class="button radius-30 lihat-detail">Lihat Detail</a>
                        </div>
                    </div>
                </div>

                <!-- Budaya -->
                <div class="col-lg-3 col-md-6 col-sm-12 wisata-item" data-category="budaya">
                    <div class="single-pricing-wrapper">
                        <div class="single-pricing">
                            <div class="img-wrapper">
                                <img src="{{ asset('assets/img/wisata/foto1.jpeg') }}" alt="Jam Gadang"
                                    class="img-fluid">
                            </div>
                            <h4>Jam Gadang</h4>
                            <p>Bukittinggi, Sumatera Barat</p>
                            <a href="{{ url('/detailwisata') }}" class="button radius-30 lihat-detail">Lihat Detail</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Modal Detail Wisata -->
        
        <!-- Script -->
        <script>
            // === FILTER KATEGORI ===
            const filterButtons = document.querySelectorAll(".filter-btn");
            const wisataItems = document.querySelectorAll(".wisata-item");

            filterButtons.forEach(btn => {
                btn.addEventListener("click", function() {
                    const filter = this.getAttribute("data-filter");
                    filterButtons.forEach(b => b.classList.remove("active"));
                    this.classList.add("active");
                    wisataItems.forEach(item => {
                        item.style.display = (filter === "all" || item.dataset.category === filter) ?
                            "block" : "none";
                    });
                });
            });

            // === MODAL DETAIL ===
            
        </script>
    </section>

    <!-- ========================= clients-logo start ========================= -->
    <section class="clients-logo-section pt-100 pb-100">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="client-logo wow fadeInUp" data-wow-delay=".2s">
              <img src="{{ asset('assets/img/clients/brands.svg') }}" alt="" class="w-100">
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ========================= clients-logo end ========================= -->

    <!-- ========================= footer style-4 start ========================= -->
    <footer class="footer footer-style-4">
      <div class="container">
        <div class="widget-wrapper">
          <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6">
              <div class="footer-widget wow fadeInUp" data-wow-delay=".2s">
                <div class="logo">
                  <a href="#0"> <img src="{{ asset('assets/img/logo/logo.svg') }}" alt=""> </a>
                </div>
                <p class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Facilisis nulla placerat amet amet congue.</p>
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
          <p>Design and Developed by <a href="https://uideck.com" rel="nofollow" target="_blank">UIdeck</a> Built-with <a href="https://uideck.com" rel="nofollow" target="_blank">Lindy UI Kit</a>. Distributed by <a href="https://themewagon.com" target="_blank">ThemeWagon</a></p>
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
