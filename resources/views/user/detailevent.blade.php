@php
    use Carbon\Carbon;
    use Illuminate\Support\Facades\Storage;

    Carbon::setLocale('id');
    $mulai = Carbon::parse($event->tanggal_mulai);
    $selesai = Carbon::parse($event->tanggal_selesai);
    $img = $event->foto ? Storage::url($event->foto) : asset('assets/img/event/placeholder.jpg');

    $today = now();
    $isOngoing = $today->between($mulai->startOfDay(), $selesai->endOfDay());
    $isUpcoming = $today->lt($mulai->startOfDay());
    $statusBadge = $isOngoing
        ? ['Ongoing', 'primary']
        : ($isUpcoming
            ? ['Upcoming', 'success']
            : ['Selesai', 'secondary']);

    // guard kalau controller belum set
    $participants = $participants ?? collect();
@endphp
<!DOCTYPE html>
<html class="no-js" lang="id">

<head>
    <meta charset="utf-8" />
    <title>{{ $event->nama_event }} — GoMinGo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-5.0.0-beta1.min.css') }}" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/lindy-uikit.css') }}" />
</head>

<body>
    <section id="home" class="hero-section-wrapper-5">
        <header class="header header-6">
            <div class="navbar-area">
                <div class="container">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img src="{{ asset('assets/img/logo/logogo.png') }}" alt="Logo" width="120"
                                height="120" />
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
                            <span class="toggler-icon"></span><span class="toggler-icon"></span><span
                                class="toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse sub-menu-bar" id="nav">
                            <ul class="navbar-nav ms-auto">
                                <li class="nav-item"><a class="page-scroll" href="{{ url('/') }}">Home</a></li>
                                <li class="nav-item"><a class="page-scroll" href="{{ route('events.list') }}">Event</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </header>
    </section>

    <section id="event-detail" class="pt-100 pb-100" style="background-color:#f9fafc;">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2 class="fw-bold text-primary">Detail Event</h2>
                <p class="text-muted">Informasi lengkap tentang acara wisata.</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-9">
                    {{-- Header + cover --}}
                    <div class="text-center mb-5">
                        <img src="{{ $img }}" alt="{{ $event->nama_event }}"
                            class="img-fluid rounded-4 shadow-sm mb-3" style="max-height:350px;object-fit:cover;">
                        <h2 class="fw-bold text-dark">{{ $event->nama_event }}</h2>
                        <span
                            class="badge bg-{{ $statusBadge[1] }} px-3 py-2 rounded-pill">{{ $statusBadge[0] }}</span>
                    </div>

                    {{-- Info tanggal & lokasi --}}
                    <div class="row g-4 mb-5">
                        <div class="col-md-6">
                            <div class="p-3 rounded-3 bg-light h-100 shadow-sm">
                                <h6 class="fw-semibold text-secondary mb-2">
                                    <i class="bi bi-calendar-event me-2 text-primary"></i>Tanggal Mulai
                                </h6>
                                <p class="mb-0">{{ $mulai->translatedFormat('d F Y') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 rounded-3 bg-light h-100 shadow-sm">
                                <h6 class="fw-semibold text-secondary mb-2">
                                    <i class="bi bi-calendar2-check me-2 text-primary"></i>Tanggal Selesai
                                </h6>
                                <p class="mb-0">{{ $selesai->translatedFormat('d F Y') }}</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="p-3 rounded-3 border h-100 shadow-sm bg-white">
                                <h6 class="fw-semibold text-secondary mb-2">
                                    <i class="bi bi-geo-alt me-2 text-primary"></i>Lokasi
                                </h6>
                                <p class="mb-1">{{ $event->lokasi ?? 'Sumatera Barat' }}</p>
                                @if (!empty($event->latitude) && !empty($event->longitude))
                                    <small class="text-muted d-block mb-2">Lat: {{ $event->latitude }}, Long:
                                        {{ $event->longitude }}</small>
                                    <a href="https://www.google.com/maps?q={{ $event->latitude }},{{ $event->longitude }}"
                                        target="_blank" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                        <i class="bi bi-map me-1"></i>Lihat di Google Maps
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="p-4 rounded-4 shadow-sm border bg-white mb-5">
                        <h4 class="fw-semibold mb-3 text-primary">
                            <i class="bi bi-file-earmark-text me-2"></i>Deskripsi
                        </h4>
                        <div class="text-muted" style="text-align:justify;">
                            {!! nl2br(e($event->deskripsi)) !!}
                        </div>
                    </div>

                    {{-- CTA untuk tour guide: redirect ke dashboard --}}
                    <div class="text-center mt-4 mb-5">
                        @auth
                            @if (auth()->user()->role === 'tour_guide')
                                <div class="alert alert-info d-inline-block mb-3">
                                    <i class="bi bi-info-circle me-2"></i>
                                    <strong>Tour Guide?</strong> Kelola event dan pendaftaran Anda di 
                                    <a href="{{ route('tourguide.events.index') }}" class="alert-link fw-semibold">
                                        Dashboard Event <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            @endif
                        @endauth

                        @guest
                            <a href="{{ route('login') }}" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Login sebagai Tour Guide untuk daftar
                            </a>
                        @endguest

                        <a href="{{ route('events.list') }}"
                            class="btn btn-outline-secondary px-4 py-2 rounded-pill shadow-sm {{ auth()->check() && auth()->user()->role === 'tour_guide' ? '' : 'ms-2' }}">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>

                    {{-- === SATU-SATUNYA BLOK: Tour Guide yang Sudah Mendaftar (Publik) === --}}
                    @if ($participants->count())
                        <div class="p-4 rounded-4 shadow-sm border bg-white mb-5">
                            <h4 class="fw-semibold mb-3 text-primary">
                                <i class="bi bi-people-fill me-2"></i>Tour Guide yang Sudah Mendaftar
                            </h4>
                            <div class="row g-4">
                                @foreach ($participants as $p)
                                    @php
                                        $tg = $p->tourGuide;
                                        $user = $tg?->user;

                                        // HAPUS semua kalkulasi foto. Fokus ke kontak.
                                        $phone = $tg?->no_hp ?? ($user?->phone ?? null);
                                        $email = $user?->email ?? null;

                                        $wa = $phone ? preg_replace('/\D+/', '', $phone) : null;
                                        if ($wa && str_starts_with($wa, '0')) {
                                            $wa = '62' . substr($wa, 1);
                                        }

                                        $waText = urlencode("Halo, saya tertarik untuk event: {$event->nama_event}");
                                    @endphp

                                    <div class="col-md-6 col-lg-4">
                                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                                            {{-- HEADER TANPA FOTO --}}
                                            <div class="p-3 pb-0">
                                                <div class="d-flex align-items-start gap-2">
                                                    <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center"
                                                        style="width:40px;height:40px;">
                                                        <i class="bi bi-person text-secondary"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 fw-bold">
                                                            {{ $tg?->nama ?? ($user?->name ?? 'Tour Guide') }}
                                                        </h6>
                                                        <small class="text-muted">
                                                            Approved • Daftar: {{ $p->created_at->format('d M Y') }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-body">
                                                @if (!empty($tg?->spesialisasi))
                                                    <p class="text-muted small mb-2">
                                                        <i
                                                            class="bi bi-award me-1 text-primary"></i>{{ $tg->spesialisasi }}
                                                    </p>
                                                @endif
                                                @if (!empty($tg?->bahasa))
                                                    <p class="text-muted small mb-0">
                                                        <i
                                                            class="bi bi-translate me-1 text-primary"></i>{{ $tg->bahasa }}
                                                    </p>
                                                @endif
                                            </div>

                                            <div class="card-footer bg-white border-0 pt-0 pb-3 px-3">
                                                <div class="d-flex flex-wrap gap-2">
                                                    @if ($wa)
                                                        <a target="_blank"
                                                            href="https://wa.me/{{ $wa }}?text={{ $waText }}"
                                                            class="btn btn-success btn-sm rounded-pill">
                                                            <i class="bi bi-whatsapp me-1"></i> WhatsApp
                                                        </a>
                                                    @endif
                                                    @if ($email)
                                                        <a href="mailto:{{ $email }}?subject={{ urlencode('Info Event: ' . $event->nama_event) }}"
                                                            class="btn btn-outline-primary btn-sm rounded-pill">
                                                            <i class="bi bi-envelope me-1"></i> Email
                                                        </a>
                                                    @endif
                                                    @if (isset($tg->id))
                                                        <a href="{{ route('tourguide.public', $tg->id) }}"
                                                            class="btn btn-light btn-sm rounded-pill">
                                                            <i class="bi bi-person-badge me-1"></i> Lihat Profil
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    @else
                        <div class="p-4 rounded-4 shadow-sm border bg-white mb-5">
                            <h4 class="fw-semibold mb-2 text-primary">
                                <i class="bi bi-people me-2"></i>Tour Guide yang Sudah Mendaftar
                            </h4>
                            <p class="text-muted mb-0">Belum ada tour guide yang mendaftar.</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('assets/js/bootstrap-5.0.0-beta1.min.js') }}"></script>
</body>

</html>
