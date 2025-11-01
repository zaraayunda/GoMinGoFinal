@php
    use Carbon\Carbon;
    Carbon::setLocale('id');
    $today = now();
@endphp
<!DOCTYPE html>
<html class="no-js" lang="id">
<head>
    <meta charset="utf-8" />
    <title>GoMinGo — Event</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-5.0.0-beta1.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/lindy-uikit.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />
    <style>
        .tg-card{transition:transform .15s ease,box-shadow .15s ease}
        .tg-card:hover{transform:translateY(-3px);box-shadow:0 16px 40px rgba(0,0,0,.08)}
    </style>
</head>
<body>
<section id="home" class="hero-section-wrapper-5">
    <header class="header header-6">
        <div class="navbar-area">
            <div class="container">
                <nav class="navbar navbar-expand-lg">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('assets/img/logo/logogo.png') }}" alt="Logo" width="120" height="120" />
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar">
                        <span class="toggler-icon"></span><span class="toggler-icon"></span><span class="toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse sub-menu-bar" id="navbar">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item"><a class="page-scroll" href="{{ url('/') }}">Home</a></li>
                            <li class="nav-item"><a class="page-scroll active" href="#event-list">Event</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </header>
</section>

<section id="event-list" class="pt-100 pb-100" style="background-color:#f9fafc;">
    <div class="container">
        <div class="section-title text-center mb-5">
            <h2 class="fw-bold text-primary">Katalog Event Wisata</h2>
            <p class="text-muted">Temukan berbagai acara wisata menarik di seluruh daerah.</p>
        </div>

        @if($events->isEmpty())
            <div class="text-center py-5">
                <img src="{{ asset('assets/img/empty-state.svg') }}" width="160" class="mb-3" alt="">
                <h5 class="fw-bold mb-1">Belum ada event</h5>
                <p class="text-muted">Stay tuned! Event bakal muncul di sini.</p>
            </div>
        @else
            <div class="row g-4">
                @foreach ($events as $event)
                    @php
                        $mulai = Carbon::parse($event->tanggal_mulai);
                        $selesai = Carbon::parse($event->tanggal_selesai);
                        $isOngoing = $today->between($mulai->startOfDay(), $selesai->endOfDay());
                        $isUpcoming = $today->lt($mulai->startOfDay());
                        $statusBadge = $isOngoing ? ['Ongoing','primary'] : ($isUpcoming ? ['Upcoming','success'] : ['Selesai','secondary']);
                        $img = $event->foto ? Storage::url($event->foto) : asset('assets/img/event/placeholder.jpg');
                        $lokasi = $event->lokasi ?? 'Sumatera Barat';
                    @endphp
                    <div class="col-md-6 col-lg-4">
                        <div class="card tg-card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                            <div class="position-relative">
                                <img src="{{ $img }}" class="card-img-top" alt="{{ $event->nama_event }}"
                                     style="height:220px; object-fit:cover;">
                                <span class="badge bg-{{ $statusBadge[1] }} position-absolute top-0 end-0 m-3 px-3 py-2 rounded-pill shadow-sm">
                                    {{ $statusBadge[0] }}
                                </span>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="fw-bold text-dark">{{ $event->nama_event }}</h5>
                                <p class="text-muted small mb-2">
                                    <i class="bi bi-geo-alt me-1 text-primary"></i>{{ $lokasi }}
                                </p>
                                <p class="text-secondary mb-3" style="font-size:.9rem;">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($event->deskripsi), 120) }}
                                </p>
                                <div class="mt-auto d-flex justify-content-between align-items-center">
                                    <span class="text-muted small">
                                        <i class="bi bi-calendar-event me-1"></i>
                                        {{ $mulai->translatedFormat('d M Y') }}
                                        @if(!$mulai->isSameDay($selesai)) – {{ $selesai->translatedFormat('d M Y') }} @endif
                                    </span>
                                    <a href="{{ route('events.show', $event->id) }}"
                                       class="btn btn-sm btn-outline-primary rounded-pill px-3">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{ $events->withQueryString()->links('pagination::bootstrap-4') }}
            </div>
        @endif
    </div>
</section>

<script src="{{ asset('assets/js/bootstrap-5.0.0-beta1.min.js') }}"></script>
</body>
</html>
