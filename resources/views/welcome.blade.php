<!DOCTYPE html>
<html class="no-js" lang="id">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>GoMinGo</title>
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- ========================= CSS ========================= -->
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-5.0.0-beta1.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/LineIcons.2.0.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/tiny-slider.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/lindy-uikit.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />

  <style>
    :root {
      --blue: #3b82f6;
      --light-blue: #60a5fa;
      --bg-white: #ffffff;
      --text-dark: #1e293b;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: var(--bg-white);
      color: var(--text-dark);
    }

    /* Navbar */
.header {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  background: rgba(255, 255, 255, 0.92);
  backdrop-filter: blur(10px);
  z-index: 100;
  transition: all 0.3s ease;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.header.scrolled {
  background: rgba(255, 255, 255, 0.98);
  box-shadow: 0 4px 14px rgba(0, 0, 0, 0.1);
}

.navbar-brand {
  font-weight: 700;
  font-size: 1.3rem;
  display: flex;
  align-items: center;
  color: #1e3a8a !important;
}

.navbar-brand img {
  width: 42px;
  height: 42px;
  margin-right: 10px;
}

.navbar-nav {
  gap: 24px;
}

    .navbar a.nav-link {
  color: #1e293b;
  font-weight: 500;
  padding: 8px 12px;
  border-radius: 20px;
  transition: all 0.3s ease;
}

.navbar a.nav-link:hover,
.navbar a.nav-link.active {
  color: #2563eb;
  background-color: rgba(37, 99, 235, 0.1);
}

/* Tombol Login / Registrasi */
.navbar .btn-primary {
  background-color: #3b82f6;
  border: none;
  border-radius: 25px;
  padding: 8px 22px;
  font-weight: 600;
  font-size: 0.95rem;
  transition: all 0.3s ease;
}

.navbar .btn-primary:hover {
  background-color: #2563eb;
  transform: translateY(-1px);
}

/* Untuk versi mobile */
.navbar-toggler {
  border: none;
}

.navbar-toggler:focus {
  box-shadow: none;
}
    .btn-primary {
      background-color: var(--blue);
      border: none;
      border-radius: 30px;
      padding: 8px 20px;
      font-weight: 600;
      transition: 0.3s;
    }

    .btn-primary:hover {
      background-color: var(--light-blue);
      transform: scale(1.05);
    }

    /* HERO SECTION */
    .hero-section {
  position: relative;
  background: url("{{ asset('assets/img/hero/2.png') }}") center/cover no-repeat;
  text-align: center;
  padding: 150px 20px 120px;
  color: white;
  overflow: hidden;
  border-radius: 0 0 50px 50px;
}

/* Lapisan biru lembut di atas gambar */
.hero-section .overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(
    180deg,
    rgba(59, 130, 246, 0.85) 0%,
    rgba(96, 165, 250, 0.75) 50%,
    rgba(219, 234, 254, 0.9) 100%
  );
  z-index: 1;
}

/* Konten utama */
.hero-content {
  position: relative;
  z-index: 2;
  max-width: 850px;
  margin: 0 auto;
}

/* Judul */
.hero-content h1 {
  font-size: 3rem;
  font-weight: 800;
  line-height: 1.3;
  color: #ffffff;
  text-shadow: 0 3px 8px rgba(0, 0, 0, 0.25);
}

.hero-content h1 span {
  color: #dbeafe; /* biru muda lembut */
}

.hero-content strong {
  color: #fcd34d; /* aksen kuning */
}

/* Deskripsi */
.hero-content p {
  color: rgba(255, 255, 255, 0.95);
  font-size: 1.1rem;
  margin-top: 15px;
  margin-bottom: 35px;
  text-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
}

/* Tombol */
.hero-content .btn-primary {
  background: #2563eb;
  color: #ffffff;
  font-weight: 600;
  border-radius: 40px;
  padding: 14px 38px;
  font-size: 1rem;
  transition: all 0.3s ease;
  box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
}

.hero-content .btn-primary:hover {
  background: #1e3a8a;
  box-shadow: 0 6px 25px rgba(37, 99, 235, 0.6);
  transform: translateY(-2px);
}

/* Wave bawah */
.hero-wave {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  line-height: 0;
  z-index: 1;
}

    /* Sticky navbar shadow on scroll */
    .header.fixed-top.scrolled {
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
      background: var(--bg-white);
    }

    .footer {
  background-color: #f8fafc;
  padding: 50px 0 20px;
  border-top: 5px solid #2563eb;
}

.footer .footer-widget h6 {
  color: #1e3a8a;
  font-size: 1.1rem;
  font-weight: 700;
  margin-bottom: 1rem;
}

.footer .footer-links-horizontal li {
  list-style: none;
}

.footer .footer-links-horizontal li a {
  font-weight: 600;
  font-size: 1.05rem;
  color: #111827;
  text-decoration: none;
  transition: all 0.3s ease;
}

.footer .footer-links-horizontal li a:hover {
  color: #2563eb;
  text-decoration: underline;
}

/* Sosial media icons */
.footer .socials li {
  list-style: none;
}

.footer .socials a {
  font-size: 1.2rem;
  color: #2563eb;
  background: #e0ecff;
  border-radius: 50%;
  padding: 8px 10px;
  display: inline-block;
  transition: 0.3s ease;
}

.footer .socials a:hover {
  background: #2563eb;
  color: #fff;
}

.footer .copyright-wrapper {
  border-top: 1px solid #cbd5e1;
  padding-top: 20px;
  color: #64748b;
  font-size: 0.9rem;
}

    .copyright-wrapper {
      text-align: center;
      border-top: 1px solid rgba(59, 130, 246, 0.2);
      margin-top: 40px;
      padding-top: 20px;
      font-size: 14px;
      color: #475569;
    }

    .copyright-wrapper a {
      color: #3b82f6;
      text-decoration: none;
    }

    .copyright-wrapper a:hover {
      text-decoration: underline;
    }

  </style>
  </head>
  <body>
    <!-- Preloader -->
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

    <!-- ========================= hero-section-wrapper-5 start ========================= -->
    <header class="header header-6 fixed-top">
    <div class="navbar-area">
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
          <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('assets/img/logo/logogo.png') }}" alt="Logo" width="45" height="45" class="me-2" />
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent6" aria-controls="navbarSupportedContent6"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent6">
            <ul class="navbar-nav ms-auto align-items-lg-center">
              <li class="nav-item"><a class="nav-link active" href="#home">Home</a></li>
              <li class="nav-item"><a class="nav-link" href="#about">Peta Interaktif</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ url('/tourguide') }}">Tour Guide</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ url('/event') }}">Event</a></li>
              <li class="nav-item ms-lg-3">
                <a href="{{ url('/login') }}" class="btn btn-primary">Login / Registrasi</a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </div>
  </header>
      <!-- ========================= header-6 end ========================= -->

      <!-- ================= HERO SECTION ================= -->
<section class="hero-section" id="home">
  <div class="overlay"></div>
  <div class="container hero-content">
    <h1 class="wow fadeInUp" data-wow-delay=".2s">
      Jelajahi <span>Keindahan Sumatera Barat</span> Bersama <strong>GoMinGo</strong>
    </h1>
    <p class="wow fadeInUp" data-wow-delay=".4s">
      Temukan pengalaman wisata halal, budaya, dan alam yang menakjubkan bersama pemandu lokal terpercaya.
    </p>
    <a href="{{ url('/tur') }}" class="btn btn-primary wow fadeInUp" data-wow-delay=".6s">
      Mulai Petualangan
    </a>
  </div>

  <div class="hero-wave">
    <svg viewBox="0 0 1440 320">
      <path fill="#c7dcff" fill-opacity="1"
        d="M0,224L48,192C96,160,192,96,288,101.3C384,107,480,181,576,197.3C672,213,768,171,864,154.7C960,139,1056,149,1152,149.3C1248,149,1344,139,1392,133.3L1440,128L1440,320L0,320Z">
      </path>
    </svg>
  </div>
</section>


    <!-- ========================= hero-section-wrapper-6 end ========================= -->

    <!-- ========================= feature style-5 start ========================= -->
<section id="about-website" class="about-section about-style-4 py-5">
  <div class="container">
    <div class="row align-items-center">
      <!-- Gambar/Icon Samping -->
<!-- Gambar Samping -->
<div class="col-lg-6 text-center mb-4 mb-lg-0">
  <div class="about-image-wrapper position-relative">
    <img 
      src="{{ asset('assets/img/logo/logogo.png') }}" 
      alt="Ilustrasi GoMinGo Sumatera Barat"
      class="img-fluid rounded-4 shadow-sm"
      style="max-width: 450px; transition: transform 0.4s ease;"
    >
  </div>
</div>

      <!-- Keterangan -->
      <div class="col-lg-6">
        <div class="about-content-wrapper">
          <div class="section-title mb-3">
            <h3 class="fw-bold mb-3">Tentang GoMinGo</h3>
            <p class="text-muted">
              <strong>GoMinGo</strong> adalah platform wisata digital yang membantu kamu menjelajahi keindahan Sumatera Barat dengan mudah.  
              Kami menyediakan informasi lengkap mulai dari destinasi wisata, pemandu profesional, event lokal, hingga peta interaktif.
            </p>
          </div>

          <ul class="list-unstyled mt-4">
            <li class="d-flex align-items-start mb-3">
              <i class="bi bi-map-fill text-primary fs-4 me-3"></i>
              <div>
                <h6 class="fw-semibold mb-1">🗺️ Peta Interaktif</h6>
                <p class="text-muted mb-0">
                  Lihat lokasi wisata populer, penginapan, dan rute perjalanan secara langsung melalui peta interaktif yang mudah digunakan.
                </p>
              </div>
            </li>

            <li class="d-flex align-items-start mb-3">
              <i class="bi bi-person-video3 text-primary fs-4 me-3"></i>
              <div>
                <h6 class="fw-semibold mb-1">🧭 Tour Guide Digital</h6>
                <p class="text-muted mb-0">
                  Temukan pemandu wisata terpercaya yang siap menemani petualangan kamu dan memberikan informasi lokal yang menarik.
                </p>
              </div>
            </li>

            <li class="d-flex align-items-start mb-3">
              <i class="bi bi-calendar-event text-primary fs-4 me-3"></i>
              <div>
                <h6 class="fw-semibold mb-1">🎉 Event & Kegiatan</h6>
                <p class="text-muted mb-0">
                  Dapatkan update kegiatan, festival, dan acara budaya terbaru di seluruh wilayah Sumatera Barat.
                </p>
              </div>
            </li>

            <li class="d-flex align-items-start">
              <i class="bi bi-people-fill text-primary fs-4 me-3"></i>
              <div>
                <h6 class="fw-semibold mb-1">🤝 Komunitas Wisata</h6>
                <p class="text-muted mb-0">
                  Bergabung dengan komunitas wisatawan dan pemandu untuk berbagi pengalaman dan inspirasi perjalanan.
                </p>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

    <!-- ========================= feature style-5 end ========================= -->

    <!-- ========================= about style-4 start ========================= -->
<section id="about" class="about-section about-style-4 py-5">
  <div class="container">
    <div class="row align-items-center">
      <!-- Konten Teks -->
      <div class="col-xl-6 col-lg-6">
        <div class="about-content-wrapper pe-lg-4">
          <div class="section-title mb-4">
            <h3 class="fw-bold mb-3 wow fadeInUp text-dark" data-wow-delay=".2s">🌍 Peta Interaktif</h3>
            <p class="wow fadeInUp text-secondary" data-wow-delay=".3s">
              Jelajahi keindahan alam dan budaya <b>Sumatera Barat</b> melalui peta interaktif kami.
              Temukan lokasi wisata populer, kuliner khas, dan rute perjalanan terbaik — semuanya dalam satu tampilan mudah digunakan.
            </p>
          </div>
          <ul class="list-unstyled">
            <li class="d-flex align-items-start mb-3 wow fadeInUp" data-wow-delay=".35s">
              <i class="lni lni-checkmark-circle text-primary me-2 fs-5"></i>
              <span>Menampilkan berbagai destinasi wisata unggulan di Sumbar.</span>
            </li>
            <li class="d-flex align-items-start mb-3 wow fadeInUp" data-wow-delay=".45s">
              <i class="lni lni-checkmark-circle text-primary me-2 fs-5"></i>
              <span>Dapat diakses secara interaktif melalui perangkat Anda.</span>
            </li>
          </ul>
          <a href="{{ url('/peta') }}" class="button button-lg radius-10 wow fadeInUp mt-3" data-wow-delay=".5s">
            Jelajahi Wisata
          </a>
        </div>
      </div>

      <!-- Ikon Peta -->
      <div class="col-xl-6 col-lg-6 text-center mt-4 mt-lg-0">
        <div class="wow fadeInUp" data-wow-delay=".4s">
          <i class="lni lni-map-marker text-primary" 
             style="font-size: 220px; line-height: 1; display: inline-block; transition: transform .3s ease;"></i>
          <h5 class="mt-3 text-dark fw-semibold">Sumatera Barat</h5>
          <p class="text-secondary small">Temukan berbagai destinasi seru dari pantai hingga pegunungan.</p>
        </div>
      </div>
    </div>
  </div>
</section>


    <!-- ========================= about style-4 end ========================= -->

    <!-- ========================= pricing style-4 start ========================= -->
    <section id="tours" class="container py-5">
      <h2 class="section-title">Tur Populer</h2>

      <div class="tour-slider">
        <div class="tour-item active">
          <img src="{{ asset('assets/img/hero/nirwana.jpeg') }}" alt="Pantai Nirwana" />
          <div class="info">
            <h5>Pantai Nirwana</h5>
          </div>
        </div>

        <div class="tour-item right">
          <img src="{{ asset('assets/img/hero/11.jpeg') }}" alt="Air Terjun Sarasah" />
          <div class="info">
            <h5>Air Terjun Sarasah</h5>
          </div>
        </div>

        <div class="tour-item left">
          <img src="{{ asset('assets/img/hero/mr.jpeg') }}" alt="Gunung Marapi" />
          <div class="info">
            <h5>Gunung Marapi</h5>
          </div>
        </div>
      </div>
    </section>
    <!-- ========================= pricing style-4 end ========================= -->

    <!-- ========================= contact-style-3 start ========================= -->
<section id="contact" class="contact-section py-5">
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-lg-8 text-center">
        <h2 class="fw-bold text-dark mb-3">Hubungi Kami</h2>
        <p class="text-muted">
          Punya pertanyaan seputar tur, peta interaktif, atau kerja sama?  
          Tim <strong>GoMinGo Sumatera Barat</strong> siap membantu Anda!
        </p>
      </div>
    </div>

    <div class="row g-4">
      <!-- Form Kontak -->
      <div class="col-lg-7">
        <form action="#" method="POST" class="contact-form p-4 rounded-4 shadow-sm bg-white">
          <div class="row g-3">
            <div class="col-md-6">
              <div class="form-group position-relative">
                <i class="bi bi-person icon-field"></i>
                <input type="text" class="form-control ps-5" placeholder="Nama Lengkap" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group position-relative">
                <i class="bi bi-envelope icon-field"></i>
                <input type="email" class="form-control ps-5" placeholder="Alamat Email" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group position-relative">
                <i class="bi bi-telephone icon-field"></i>
                <input type="text" class="form-control ps-5" placeholder="Nomor Telepon">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group position-relative">
                <i class="bi bi-chat-text icon-field"></i>
                <input type="text" class="form-control ps-5" placeholder="Subjek Pesan">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group position-relative">
                <i class="bi bi-pencil-square icon-field"></i>
                <textarea class="form-control ps-5" rows="5" placeholder="Tulis pesan Anda di sini..." required></textarea>
              </div>
            </div>
            <div class="col-12 text-center mt-3">
              <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm">
                Kirim Pesan
              </button>
            </div>
          </div>
        </form>
      </div>

      <!-- Informasi Kontak -->
      <div class="col-lg-5">
        <div class="contact-info bg-white p-4 rounded-4 shadow-sm h-100">
          <div class="d-flex align-items-center mb-4">
            <div class="icon-box bg-primary text-white rounded-circle me-3">
              <i class="bi bi-telephone fs-5"></i>
            </div>
            <div>
              <h6 class="fw-semibold mb-0">Telepon</h6>
              <small class="text-muted">+62 812-3456-7890</small>
            </div>
          </div>

          <div class="d-flex align-items-center mb-4">
            <div class="icon-box bg-primary text-white rounded-circle me-3">
              <i class="bi bi-envelope fs-5"></i>
            </div>
            <div>
              <h6 class="fw-semibold mb-0">Email</h6>
              <small class="text-muted">info@gomingo.id</small>
            </div>
          </div>

          <div class="d-flex align-items-center">
            <div class="icon-box bg-primary text-white rounded-circle me-3">
              <i class="bi bi-geo-alt fs-5"></i>
            </div>
            <div>
              <h6 class="fw-semibold mb-0">Alamat</h6>
              <small class="text-muted">Jl. Sudirman No.88, Padang, Sumatera Barat</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

    <!-- ========================= contact-style-3 end ========================= -->

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
      <div class="row align-items-center justify-content-between">

        <!-- Kolom Logo -->
        <div class="col-xl-4 col-lg-4 col-md-12 mb-4 text-center text-lg-start">
          <div class="footer-widget wow fadeInUp" data-wow-delay=".2s">
            <div class="logo mb-3">
              <a href="#0">
                <img src="{{ asset('assets/img/logo/logogo.png') }}" alt="GoMinGo" width="100" />
              </a>
            </div>
            <p class="footer-desc mb-3 fw-semibold text-primary">GoMinGo SUMATERA BARAT</p>
            <ul class="socials d-flex justify-content-center justify-content-lg-start gap-3">
              <li><a href="#"><i class="lni lni-facebook-filled"></i></a></li>
              <li><a href="#"><i class="lni lni-twitter-filled"></i></a></li>
              <li><a href="#"><i class="lni lni-instagram-filled"></i></a></li>
              <li><a href="#"><i class="lni lni-linkedin-original"></i></a></li>
            </ul>
          </div>
        </div>

        <!-- Kolom Quick Link -->
        <div class="col-xl-7 col-lg-7 col-md-12">
          <div class="footer-widget wow fadeInUp text-center text-lg-end" data-wow-delay=".3s">
            <h6 class="text-primary fw-bold mb-3">Quick Link</h6>
            <ul class="footer-links-horizontal d-flex flex-wrap justify-content-center justify-content-lg-end gap-5">
              <li><a href="#home">Home</a></li>
              <li><a href="#about">Peta Interaktif</a></li>
              <li><a href="{{ url('/tourguide') }}">Tour Guide</a></li>
              <li><a href="{{ url('/event') }}">Event</a></li>
            </ul>
          </div>
        </div>

      </div>
    </div>

    <div class="copyright-wrapper text-center mt-4 wow fadeInUp" data-wow-delay=".2s">
      <p>
        Design and Developed by
        <a href="https://uideck.com" rel="nofollow" target="_blank">UIdeck</a>
        Built-with
        <a href="https://uideck.com" rel="nofollow" target="_blank">Lindy UI Kit</a>.
        Distributed by
        <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
      </p>
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
        const slides = document.querySelectorAll(".tour-item");
        let index = 0;

        function updateSlides() {
          slides.forEach((slide) =>
            slide.classList.remove("left", "active", "right")
          );

          const prev = (index - 1 + slides.length) % slides.length;
          const next = (index + 1) % slides.length;

          slides[prev].classList.add("left");
          slides[index].classList.add("active");
          slides[next].classList.add("right");
        }

        setInterval(() => {
          index = (index + 1) % slides.length;
          updateSlides();
        }, 3000);

        updateSlides();
      });
    </script>

    <script>
  window.addEventListener('scroll', function() {
    const header = document.querySelector('.header');
    header.classList.toggle('shadow-sm', window.scrollY > 50);
  });
</script>

  <script src="{{ asset('assets/js/bootstrap-5.0.0-beta1.min.js') }}"></script>
  <script src="{{ asset('assets/js/tiny-slider.js') }}"></script>
  <script src="{{ asset('assets/js/wow.min.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
  <script>
    window.addEventListener('scroll', function () {
      const header = document.querySelector('.header');
      header.classList.toggle('scrolled', window.scrollY > 50);
    });
  </script>
  </body>
</html>
