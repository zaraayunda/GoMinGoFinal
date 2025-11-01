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
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-5.0.0-beta1.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/LineIcons.2.0.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/tiny-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/lindy-uikit.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
<style>
.hero-section {
  position: relative;
  height: 100vh;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: start;
  background-color: #000;
}

.hero-bg {
  position: absolute;
  top: 0; left: 0;
  width: 100%; height: 120%;
  background-size: cover;
  background-position: center;
  opacity: 0;
  transition: opacity 1.5s ease-in-out;
  will-change: transform, opacity;
}

.hero-bg.active {
  opacity: 1;
  z-index: 1;
}

.hero-content-wrapper {
  position: relative;
  z-index: 2;
  color: #fff;
}
</style>
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
                                    <img src="{{ asset('assets/img/logo/logogo.png') }}" alt="Logo" width="100"
                                        height="100" />
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
                                            <a class="page-scroll" href="#about">Peta Wisata</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="page-scroll" href="{{ url('/tourguide') }}">Tour Guide</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="page-scroll" href="{{ url('/event') }}">Event</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="page-scroll active" href="{{ url('/login') }}">Login</a>
                                        </li>
                                    </ul>
                                </div>

                                {{-- <div class="header-action d-flex">
                                    <a href="#0"> <i class="lni lni-cart"></i> </a>
                                    <a href="#0"> <i class="lni lni-alarm"></i> </a>
                                </div> --}}
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
       <!-- ========================= hero-5 start ========================= -->
<div class="hero-section hero-style-5 img-bg">
  <div class="hero-bg" style="background-image: url('{{ asset('assets/img/hero/GUNUNG MARAPI.png') }}')"></div>
  <div class="hero-bg" style="background-image: url('{{ asset('assets/img/hero/2.png') }}')"></div>
  <div class="hero-bg" style="background-image: url('{{ asset('assets/img/hero/3.png') }}')"></div>

  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="hero-content-wrapper">
          <h2 class="mb-30 wow fadeInUp" data-wow-delay=".2s">
            Jelajahi Keindahan Wisata Sumatera Barat
          </h2>
          <p class="mb-30 wow fadeInUp" data-wow-delay=".4s">
            Sekarang Anda bisa menjelajahi wisata-wisata unik di Sumatera Barat dengan Tour Guide terverifikasi.
          </p>
          <a href="#0" class="button button-lg radius-50 wow fadeInUp" data-wow-delay=".6s">
            Get Started <i class="lni lni-chevron-right"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- ========================= hero-5 end ========================= -->

        <!-- ========================= hero-5 end ========================= -   ->

    </section>
    <!-- ========================= hero-section-wrapper-6 end ========================= -->

    <!-- ========================= feature style-5 start ========================= -->
    <section id="feature" class="feature-section feature-style-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-5 col-xl-5 col-lg-7 col-md-8">
                    <div class="section-title text-center mb-60">
                        <h3 class="mb-15 wow fadeInUp" data-wow-delay=".2s">GoMinGo</h3>
                        <p class="wow fadeInUp" data-wow-delay=".4s">Website yang memberikan peta interaktif agar Anda bisa menentukan
                             liburan Anda serta Anda bisa mendapatkan informasi tour guide bersertifikasi untuk memandu liburan Anda!</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single-feature wow fadeInUp" data-wow-delay=".2s">
                        <div class="icon">
                            <i class="lni lni-map"></i>
                            <svg width="110" height="72" viewBox="0 0 110 72" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M110 54.7589C110 85.0014 85.3757 66.2583 55 66.2583C24.6243 66.2583 0 85.0014 0 54.7589C0 24.5164 24.6243 0 55 0C85.3757 0 110 24.5164 110 54.7589Z"
                                    fill="#EBF4FF" />
                            </svg>
                        </div>
                        <div class="content">
                            <h5>Peta Interaktif</h5>
                            <p>Jelajahi berbagai destinasi wisata di Sumatera Barat dengan peta interaktif kami.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-feature wow fadeInUp" data-wow-delay=".4s">
                        <div class="icon">
                            <i class="lni lni-direction-alt"></i>
                            <svg width="110" height="72" viewBox="0 0 110 72" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M110 54.7589C110 85.0014 85.3757 66.2583 55 66.2583C24.6243 66.2583 0 85.0014 0 54.7589C0 24.5164 24.6243 0 55 0C85.3757 0 110 24.5164 110 54.7589Z"
                                    fill="#EBF4FF" />
                            </svg>
                        </div>
                        <div class="content">
                            <h5>Tour Guide</h5>
                            <p>Temukan tour guide bersertifikasi untuk memandu liburan Anda di Sumatera Barat.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-feature wow fadeInUp" data-wow-delay=".6s">
                        <div class="icon">
                            <i class="lni lni-ticket"></i>
                            <svg width="110" height="72" viewBox="0 0 110 72" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M110 54.7589C110 85.0014 85.3757 66.2583 55 66.2583C24.6243 66.2583 0 85.0014 0 54.7589C0 24.5164 24.6243 0 55 0C85.3757 0 110 24.5164 110 54.7589Z"
                                    fill="#EBF4FF" />
                            </svg>
                        </div>
                        <div class="content">
                            <h5>Event</h5>
                            <p>Temukan berbagai event menarik di Sumatera Barat yang dapat Anda ikuti.</p>
                        </div>
                    </div>
                </div>
                
            </div>

        </div>
    </section>
    <!-- ========================= feature style-5 end ========================= -->

    <!-- ========================= about style-4 start ========================= -->
    <section id="about" class="about-section about-style-4"
        style="background-image: url('{{ asset('assets/img/about/about-4/peta.jpg') }}');
           background-size: cover;
           background-position: center;
           background-repeat: no-repeat;
           position: relative;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-5 col-lg-6">
                    <div class="about-content-wrapper">
                        <div class="section-title mb-30">
                            <h3 class="mb-25 wow fadeInUp" data-wow-delay=".2s">Peta Interaktif Wisata</h3>
                            <p class="wow fadeInUp" data-wow-delay=".3s">Sekarang Anda bisa mengetahui titik lokasi
                                wisata dengan data yang informatif.</p>
                        </div>
                        <ul>
                            <li class="wow fadeInUp" data-wow-delay=".35s">
                                <i class="lni lni-checkmark-circle"></i>
                                Wisata Alam : Keindahan Wisata alam di Sumatera Barat.
                            </li>
                            <li class="wow fadeInUp" data-wow-delay=".4s">
                                <i class="lni lni-checkmark-circle"></i>
                                Wisata Kuliner : Menjelajahi kuliner-kuliner di Sumatera Barat .
                            </li>
                            <li class="wow fadeInUp" data-wow-delay=".45s">
                                <i class="lni lni-checkmark-circle"></i>
                                Wisata Budaya : Menjelajahi keragaman budaya yang ada di Sumatera Barat.
                            </li>
                        </ul>
                        <a href="{{ url('/jelajahi') }}" class="button button-lg radius-10 wow fadeInUp" data-wow-delay=".5s">Jelajahi</a>
                    </div>
                </div>
                {{-- <div class="col-xl-7 col-lg-6">
                    <div class="about-image text-lg-right wow fadeInUp" data-wow-delay=".5s">
                        <img src="{{ asset('assets/img/about/about-4/about-img.svg') }}" alt="">
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
    <!-- ========================= about style-4 end ========================= -->

    <!-- ========================= pricing style-4 start ========================= -->
    
    <!-- ========================= pricing style-4 end ========================= -->
    <section id="wisata" class="katalog-wisata-section pt-100 pb-100">
  <div class="container">
    <div class="section-title text-center mb-60">
      <h2>Katalog Tempat Wisata</h2>
      <p>Temukan berbagai destinasi wisata menarik dan pilih tour guide favoritmu.</p>
    </div>

    <div class="row justify-content-center">
      <!-- Card 1 -->
      <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="single-pricing-wrapper">
          <div class="single-pricing">
            <div class="img-wrapper">
              <img src="{{ asset('assets/img/wisata/foto1.jpeg') }}" alt="Pantai" class="img-fluid">
            </div>
            <h4>Pantai Padang</h4>
            <p>Kota Padang, Sumatera Barat</p>
            {{-- <ul>
              <li>🌅 Pemandangan laut yang indah</li>
              <li>🏖️ Tersedia spot foto & kuliner</li>
              <li>🕒 Buka: 08.00 - 18.00 WIB</li>
            </ul> --}}
            <a href="#0" class="button radius-30">Lihat Detail</a>
          </div>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="single-pricing-wrapper">
          <div class="single-pricing">
            <div class="img-wrapper">
              <img src="{{ asset('assets/img/wisata/foto1.jpeg') }}" alt="Danau Maninjau" class="img-fluid">
            </div>
            <h4>Danau Maninjau</h4>
            <p>Agam, Sumatera Barat</p>
            {{-- <ul>
              <li>🚣 Wisata perahu & spot sunset</li>
              <li>🏞️ Alam pegunungan yang sejuk</li>
              <li>📍 Dekat penginapan & kuliner</li>
            </ul> --}}
            <a href="#0" class="button radius-30">Lihat Detail</a>
          </div>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="single-pricing-wrapper">
          <div class="single-pricing">
            <div class="img-wrapper">
              <img src="{{ asset('assets/img/wisata/foto1.jpeg') }}" alt="Ngarai Sianok" class="img-fluid">
            </div>
            <h4>Ngarai Sianok</h4>
            <p>Bukittinggi, Sumatera Barat</p>
            {{-- <ul>
              <li>🏞️ Tebing megah & lembah hijau</li>
              <li>📸 Spot foto populer</li>
              <li>🎟️ Tiket: Rp 15.000</li>
            </ul> --}}
            <a href="#0" class="button radius-30">Lihat Detail</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

    <!-- ========================= contact-style-3 start ========================= -->
    <!-- ========================= contact-style-3 end ========================= -->

    <!-- ========================= clients-logo start ========================= -->
    <section class="clients-logo-section pt-100 pb-100">
        <div class="container text-center">
            <div class="section-title mb-50">
                <h2 class="wow fadeInUp" data-wow-delay=".2s">Partner</h2>
                <p class="wow fadeInUp" data-wow-delay=".3s">
                    Kolaborasi dengan berbagai instansi dan komunitas wisata terbaik.
                </p>
            </div>
            <div class="row">
                <div class="row justify-content-center align-items-center g-4">
                    <div class="col-6 col-md-3 col-lg-2 wow fadeInUp" data-wow-delay=".1s">
                        <img src="{{ asset('assets/img/clients/logo/logo1.jpeg') }}" class="img-fluid partner-logo"
                            alt="Partner 1">
                    </div>
                    <div class="col-6 col-md-3 col-lg-2 wow fadeInUp" data-wow-delay=".2s">
                        <img src="{{ asset('assets/img/clients/logo/logo2.jpeg') }}" class="img-fluid partner-logo"
                            alt="Partner 2">
                    </div>
                    <div class="col-6 col-md-3 col-lg-2 wow fadeInUp" data-wow-delay=".3s">
                        <img src="{{ asset('assets/img/clients/logo/logo3.jpeg') }}" class="img-fluid partner-logo"
                            alt="Partner 3">
                    </div>
                    <div class="col-6 col-md-3 col-lg-2 wow fadeInUp" data-wow-delay=".4s">
                        <img src="{{ asset('assets/img/clients/logo/logo4.jpeg') }}" class="img-fluid partner-logo"
                            alt="Partner 4">
                    </div>
                    <div class="col-6 col-md-3 col-lg-2 wow fadeInUp" data-wow-delay=".5s">
                        <img src="{{ asset('assets/img/clients/logo/logo5.jpeg') }}" class="img-fluid partner-logo"
                            alt="Partner 5">
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
                                <a href="#0"> <img src="{{ asset('assets/img/logo/logogo.png') }}" width="100" height="100"
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
    <script>
document.addEventListener("DOMContentLoaded", () => {
  const slides = document.querySelectorAll(".hero-bg");
  let current = 0;

  function showSlide(index) {
    slides.forEach((slide, i) => {
      slide.classList.toggle("active", i === index);
    });
  }

  function nextSlide() {
    current = (current + 1) % slides.length;
    showSlide(current);
  }

  // Mulai dengan slide pertama
  showSlide(current);
  setInterval(nextSlide, 5000);

  // Parallax effect saat scroll
  window.addEventListener("scroll", () => {
    const scrollY = window.scrollY;
    slides.forEach(slide => {
      slide.style.transform = `translateY(${scrollY * 0.3}px)`; // Parallax lembut
    });
  });
});
</script>

</body>

</html>
