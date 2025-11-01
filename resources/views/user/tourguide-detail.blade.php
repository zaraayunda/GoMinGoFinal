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
                                        <img src="{{ asset('assets/img/logo/logogo.png') }}" alt="Logo" width="50"
                                            height="50" />
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

        <!-- Detail Tour Guide -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8">
                <div class="p-5 rounded-4 shadow border-0 bg-white position-relative overflow-hidden animate__animated animate__fadeInUp"
                    style="animation-duration: 0.7s;">

                    <div class="position-absolute top-0 end-0 opacity-10" style="z-index:0;">
                        <i class="bi bi-globe-americas display-1 text-primary"></i>
                    </div>

                    <div class="text-center mb-4 position-relative" style="z-index:1;">
                        <img src="{{ $guide->foto_url }}" alt="{{ $guide->nama }}"
                            class="rounded-circle border border-4 border-primary shadow"
                            style="width:130px;height:130px;object-fit:cover;">
                        <h3 class="fw-bold mt-3 mb-1 text-dark">{{ $guide->nama }}</h3>
                        <div class="text-muted mb-2">Spesialis {{ ucfirst($guide->spesialisasi ?? '-') }}</div>
                        <span class="badge bg-primary bg-opacity-10 text-white px-3 py-2 rounded-pill">
                            <i class="bi bi-star-fill me-1"></i> Guide Profesional
                        </span>
                    </div>

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
                                            class="badge bg-primary bg-opacity-10 text-white border me-1 mb-1">{{ $b }}</span>
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
                            class="btn btn-outline-dark px-4 py-2 rounded-pill fw-semibold">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                        @if ($guide->wa_link)
                            <a href="{{ $guide->wa_link }}" target="_blank"
                                class="btn btn-success px-4 py-2 rounded-pill shadow-sm fw-semibold text-white">
                                <i class="bi bi-whatsapp me-1"></i> Hubungi via WhatsApp
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Kalender Ketersediaan -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8">
                <div class="p-4 rounded-4 shadow-sm border bg-white">
                    <h4 class="fw-semibold mb-3 text-primary">
                        <i class="bi bi-calendar-event me-2"></i> Kalender Ketersediaan
                    </h4>
                    <div id="guideCalendar"></div>
                    <small class="text-muted d-block mt-2">
                        <span class="badge bg-success me-1">&nbsp;</span> Available
                        <span class="badge bg-danger ms-3 me-1">&nbsp;</span> Booked
                        <span class="badge bg-secondary ms-3 me-1">&nbsp;</span> Blocked
                    </small>
                </div>
            </div>
        </div>

        <!-- Review Section -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="p-4 rounded-4 shadow-sm border bg-white">
                    <h4 class="fw-semibold mb-3 text-primary">
                        <i class="bi bi-stars me-2"></i> Ulasan Pengguna
                    </h4>

                    <!-- Ringkasan -->
                    <div class="d-flex align-items-center mb-3">
                        <div class="me-3">
                            <div class="fs-3 fw-bold">{{ $avgRating ?? 0 }}/5</div>
                            <div class="text-muted small">{{ $reviewsCount ?? 0 }} review</div>
                        </div>
                        <div>
                            @php $avg = (int) round($avgRating ?? 0); @endphp
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="bi {{ $i <= $avg ? 'bi-star-fill text-warning' : 'bi-star text-warning' }}"></i>
                            @endfor
                        </div>
                    </div>

                    <!-- Daftar Review -->
                    @if (($reviews ?? collect())->count())
                        <div class="list-group mb-4">
                            @foreach ($reviews as $rev)
                                <div class="list-group-item border-0 border-bottom px-0">
                                    <div class="d-flex justify-content-between">
                                        <strong>{{ $rev->user_name }}</strong>
                                        <span class="text-muted small">{{ $rev->created_at->format('d M Y') }}</span>
                                    </div>
                                    <div class="mb-1">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i
                                                class="bi {{ $i <= $rev->rating ? 'bi-star-fill text-warning' : 'bi-star text-warning' }}"></i>
                                        @endfor
                                    </div>
                                    @if ($rev->komentar)
                                        <p class="mb-2 text-muted">{{ $rev->komentar }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">Belum ada review. Jadilah yang pertama!</p>
                    @endif

                    <!-- Form Review -->
                    <h5 class="fw-semibold mb-3">Tulis Review</h5>
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('tourguide.reviews.store', $guide->id) }}" class="row g-3">
                        @csrf
                        <div class="col-md-6">
                            <label class="form-label">Nama</label>
                            <input name="user_name" value="{{ old('user_name') }}" class="form-control"
                                placeholder="Nama kamu" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Rating</label>
                            <select name="rating" class="form-select" required>
                                @for ($i = 5; $i >= 1; $i--)
                                    <option value="{{ $i }}" @selected(old('rating') == $i)>
                                        {{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Komentar (opsional)</label>
                            <textarea name="komentar" rows="3" class="form-control" placeholder="Tulis pengalamanmu...">{{ old('komentar') }}</textarea>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary rounded-pill px-4 fw-semibold">
                                <i class="bi bi-send me-1"></i> Kirim Review
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- ========================= feature style-5 end ========================= -->





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
        {{-- FullCalendar CDN --}}
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.14/index.global.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.14/index.global.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const el = document.getElementById('guideCalendar');
                if (!el) return;

                const calendar = new FullCalendar.Calendar(el, {
                    initialView: 'dayGridMonth',
                    height: 'auto',
                    firstDay: 1,
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    events: {
                        url: '{{ route('tourguide.schedules.json', $guide->id) }}',
                        failure: () => alert('Gagal memuat jadwal'),
                    },
                    eventDidMount: function(info) {
                        // tooltip sederhana
                        const p = info.event.extendedProps || {};
                        info.el.title = (info.event.title || '') +
                            (p.location ? `\nLokasi: ${p.location}` : '') +
                            (p.status ? `\nStatus: ${p.status}` : '') +
                            (p.note ? `\nCatatan: ${p.note}` : '');
                    }
                });
                calendar.render();
            });
        </script>

    </body>

    </html>
