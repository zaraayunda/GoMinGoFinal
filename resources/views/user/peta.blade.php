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
    <!-- Bootstrap Icons (used in search button and small UI icons) -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/LineIcons.2.0.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/lindy-uikit.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/map-styles.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />
    <!-- Leaflet core + addons -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.fullscreen@2.4.0/Control.FullScreen.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />

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

    <!-- ========================= header start ========================= -->
    <header class="header header-6">
        <div class="navbar-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="{{ url('/') }}">
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
                                        <a class="page-scroll active" href="#wisata">Tempat Wisata</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- ========================= header end ========================= -->

    <!-- ========================= map section start ========================= -->
    <section class="map-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="map-stage">
                        <!-- Floating controls -->
                        <div class="map-floating">
                            <div class="glass" style="padding:8px;">
                                <button id="btn-light" class="btn-chip btn-primary-soft">☀️ Light</button>
                                <button id="btn-dark" class="btn-chip btn-dark-soft">🌙 Dark</button>
                            </div>
                            <div class="glass" style="padding:8px;">
                                <button id="btn-fit" class="btn-chip btn-outline">↺ Fit Bounds</button>
                                <button id="btn-full" class="btn-chip btn-outline">⤢ Fullscreen</button>
                                <button id="btn-locate" class="btn-chip btn-outline">📍 Near Me</button>
                            </div>
                        </div>
                        <!-- Map container -->
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========================= map section end ========================= -->

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
                    <form class="position-relative w-75" method="GET" action="{{ url('/peta') }}">
                        {{-- keep kategori saat mencari --}}
                        @if (!empty($activeKategori))
                            <input type="hidden" name="kategori" value="{{ $activeKategori }}">
                        @endif

                        <input type="text" name="q" id="searchGuide" value="{{ $searchQ ?? '' }}"
                            class="form-control rounded-pill ps-4 pe-5 py-3 fs-5 shadow-sm"
                            placeholder="Cari Wisata (nama, alamat, deskripsi)..." />

                        <button type="submit"
                            class="btn position-absolute top-50 end-0 translate-middle-y me-2 text-primary"
                            style="background:none;border:none;">
                            <i class="bi bi-search fs-3"></i>
                        </button>
                    </form>
                </div>

                {{-- info hasil (opsional) --}}
                @if (($searchQ ?? '') !== '')
                    <small class="text-muted d-block mt-2">
                        Hasil untuk: <b>{{ $searchQ }}</b>
                        @if (!empty($activeKategori))
                            • Kategori: <b>{{ ucfirst($activeKategori) }}</b>
                        @endif
                    </small>
                @endif
            </div>


            <!-- Filter Kategori -->
            @php
                $isActive = fn($k) => $activeKategori === $k ? 'btn-primary' : 'btn-outline-primary';
            @endphp

            <div class="text-center mb-50">
                <a class="btn {{ empty($activeKategori) ? 'btn-primary' : 'btn-outline-primary' }} me-2"
                    href="{{ url('/peta') }}">Semua</a>

                <a class="btn {{ $isActive('alam') }} me-2" href="{{ url('/peta?kategori=alam') }}">Wisata Alam</a>

                <a class="btn {{ $isActive('kuliner') }} me-2" href="{{ url('/peta?kategori=kuliner') }}">Wisata
                    Kuliner</a>

                <a class="btn {{ $isActive('budaya') }}" href="{{ url('/peta?kategori=budaya') }}">Wisata Budaya</a>
            </div>


            <!-- Daftar Kartu Wisata -->
            <div class="row justify-content-center" id="wisata-list">
                @forelse($tempatWisatas as $w)
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                        <div class="single-pricing-wrapper h-100">
                            <div class="single-pricing d-flex flex-column text-center h-100">
                                <div class="img-wrapper mb-2">
                                    <img src="{{ $w['foto'] ?? asset('assets/img/wisata/foto1.jpeg') }}"
                                        alt="{{ $w['nama_tempat'] }}" class="img-fluid"
                                        style="border-radius:14px; object-fit:cover; width:100%; height:180px;">
                                </div>
                                <h4 class="mb-1">{{ $w['nama_tempat'] }}</h4>
                                <p class="text-muted mb-2">{{ ucfirst($w['kategori']) }} • {{ $w['alamat'] }}</p>
                                <div class="mt-auto">
                                    <a href="{{ route('detailwisata.show', $w['id']) }}"
                                        class="button radius-30 lihat-detail">Lihat
                                        Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted py-5">
                        Belum ada tempat wisata untuk kategori ini.
                    </div>
                @endforelse
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
                                <a href="#0"> <img src="{{ asset('assets/img/logo/logo.svg') }}"
                                        alt=""> </a>
                            </div>
                            <p class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Facilisis nulla
                                placerat amet
                                amet congue.</p>
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
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.fullscreen@2.4.0/Control.FullScreen.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>

    <script>
        // Data dari controller (lebih cepat) atau fallback API
        const PLACES = @json($tempatWisatas ?? []);
        async function getPlaces() {
            if (Array.isArray(PLACES) && PLACES.length) return PLACES;
            try {
                const r = await fetch('/api/tempat-wisata'); // sesuaikan jika beda
                if (!r.ok) throw new Error('API error');
                return await r.json();
            } catch {
                return [];
            }
        }

        (async function init() {
            // Map base
            const map = L.map('map', {
                zoomControl: true
            }).setView([-0.7399, 100.8000], 8);

            // Basemap modern (Carto)
            const light = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
                maxZoom: 20,
                attribution: '&copy; OpenStreetMap & Carto'
            });
            const dark = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
                maxZoom: 20,
                attribution: '&copy; OpenStreetMap & Carto'
            });
            light.addTo(map);

            // Fullscreen control (pojok kiri atas)
            L.control.fullscreen({
                position: 'topleft'
            }).addTo(map);

            // Cluster group biar rapi
            const cluster = L.markerClusterGroup({
                showCoverageOnHover: false,
                disableClusteringAtZoom: 15,
                spiderfyOnEveryZoom: false,
                maxClusterRadius: 50
            });

            // Custom icons based on category
            const icons = {
                alam: L.icon({
                    iconUrl: '{{ asset('assets/icons/alam.png') }}',
                    iconSize: [32, 32],
                    iconAnchor: [16, 32],
                    popupAnchor: [0, -32]
                }),
                kuliner: L.icon({
                    iconUrl: '{{ asset('assets/icons/kuliner.png') }}',
                    iconSize: [32, 32],
                    iconAnchor: [16, 32],
                    popupAnchor: [0, -32]
                }),
                budaya: L.icon({
                    iconUrl: '{{ asset('assets/icons/budaya.png') }}',
                    iconSize: [32, 32],
                    iconAnchor: [16, 32],
                    popupAnchor: [0, -32]
                }),
                default: L.icon({
                    iconUrl: '{{ asset('assets/icons/alam.png') }}',
                    iconSize: [32, 32],
                    iconAnchor: [16, 32],
                    popupAnchor: [0, -32]
                })
            }; // Render marker
            const places = await getPlaces();
            const bounds = L.latLngBounds([]);
            places.forEach(p => {
                if (!p.latitude || !p.longitude) return;
                const pop = `
        <div class="pop">
          <div class="pop-title">${p.nama_tempat ?? 'Tanpa Nama'}</div>
          <div class="pop-sub">${p.alamat ?? ''}</div>
          ${p.kategori ? `<div class="pop-sub">Kategori: ${p.kategori}</div>` : ''}
          ${p.tiket_masuk ? `<div class="pop-sub">Tiket: ${p.tiket_masuk}</div>` : ''}
          ${p.jam_buka ? `<div class="pop-sub">Jam: ${p.jam_buka}</div>` : ''}
          ${p.foto ? `<img class="pop-img" src="${p.foto}" alt="${p.nama_tempat}">` : ''}
          <a class="button radius-30 pop-action" href="{{ url('/detailwisata') }}/${p.id ?? ''}">
            Lihat Detail
          </a>
        </div>`;
                const categoryIcon = icons[p.kategori] || icons.default;
                const m = L.marker([+p.latitude, +p.longitude], {
                    icon: categoryIcon
                }).bindPopup(pop);
                cluster.addLayer(m);
                bounds.extend([+p.latitude, +p.longitude]);
            });
            map.addLayer(cluster);
            if (bounds.isValid()) map.fitBounds(bounds, {
                padding: [30, 30]
            });

            // Floating actions
            document.getElementById('btn-light').onclick = () => {
                map.removeLayer(dark);
                light.addTo(map);
            };
            document.getElementById('btn-dark').onclick = () => {
                map.removeLayer(light);
                dark.addTo(map);
            };
            document.getElementById('btn-fit').onclick = () => {
                if (bounds.isValid()) map.fitBounds(bounds, {
                    padding: [30, 30]
                });
            };

            // Fullscreen backup via Fullscreen API
            const mapEl = document.getElementById('map');
            document.getElementById('btn-full').onclick = () => {
                if (!document.fullscreenElement) mapEl.requestFullscreen?.();
                else document.exitFullscreen?.();
            };
            document.addEventListener('fullscreenchange', () => setTimeout(() => map.invalidateSize(), 200));
            map.on('enterFullscreen exitFullscreen', () => setTimeout(() => map.invalidateSize(), 200));

            // Lokasi pengguna (izin browser)
            document.getElementById('btn-locate').onclick = () => {
                map.locate({
                    setView: true,
                    maxZoom: 15,
                    enableHighAccuracy: true
                });
            };
            map.on('locationfound', e => {
                L.circleMarker(e.latlng, {
                    radius: 8
                }).addTo(map).bindPopup('Kamu di sini').openPopup();
            });
        })();
    </script>

</body>

</html>
