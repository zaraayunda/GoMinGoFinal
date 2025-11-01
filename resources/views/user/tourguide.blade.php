<!DOCTYPE html>
<html class="no-js" lang="">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="x-ua-compatible" content="ie=edge"/>
  <title>GoMinGo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-5.0.0-beta1.min.css') }}"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css"/>
  <link rel="stylesheet" href="{{ asset('assets/css/LineIcons.2.0.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/css/tiny-slider.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/css/lindy-uikit.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}"/>
  <style>
    .tg-card{transition:transform .15s ease, box-shadow .15s ease}
    .tg-card:hover{transform:translateY(-3px); box-shadow:0 16px 40px rgba(0,0,0,.08)}
    .filter .btn{border-radius:999px}
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
                  <img src="{{ asset('assets/img/logo/logogo.png') }}" alt="Logo" width="120" height="120"/>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent6">
                  <span class="toggler-icon"></span><span class="toggler-icon"></span><span class="toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent6">
                  <ul id="nav6" class="navbar-nav ms-auto">
                    <li class="nav-item">
                      <a class="page-scroll active" href="{{ url('/') }}">Home</a>
                      <a class="page-scroll active" href="#tourguide">Tour Guide</a>
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

  <section id="tourguide" class="katalog-tourguide-section pt-100 pb-100">
    <div class="container">

      <div class="section-title text-center mb-40">
        <h2>Pilih Tour Guide</h2>
        <p>Temukan pendamping perjalanan sesuai spesialisasi.</p>
      </div>

      {{-- Search --}}
      <form class="text-center mb-4" method="get" action="{{ route('tourguide.index') }}">
        <div class="d-flex justify-content-center">
          <div class="position-relative w-75">
            <input type="text" name="q" value="{{ $q ?? '' }}"
                   class="form-control rounded-pill ps-4 pe-5 py-3 fs-5 shadow-sm"
                   placeholder="Cari nama tour guide...">
            <button type="submit"
              class="btn position-absolute top-50 end-0 translate-middle-y me-2 text-primary"
              style="background:none;border:none;">
              <i class="bi bi-search fs-3"></i>
            </button>
          </div>
        </div>
        {{-- keep spesialisasi saat search --}}
        @if(!empty($sp)) <input type="hidden" name="spesialisasi" value="{{ $sp }}"> @endif
      </form>

      {{-- Filter spesialisasi --}}
      @php
        $isActive = fn($k)=> ($sp===$k) ? 'btn-primary' : 'btn-outline-primary';
      @endphp
      <div class="text-center mb-50 filter">
        <a class="btn {{ empty($sp)?'btn-primary':'btn-outline-primary' }} me-2"
           href="{{ route('tourguide.index', array_filter(['q'=>$q])) }}">Semua</a>
        <a class="btn {{ $isActive('alam') }} me-2"
           href="{{ route('tourguide.index', array_filter(['spesialisasi'=>'alam','q'=>$q])) }}">Alam</a>
        <a class="btn {{ $isActive('kuliner') }} me-2"
           href="{{ route('tourguide.index', array_filter(['spesialisasi'=>'kuliner','q'=>$q])) }}">Kuliner</a>
        <a class="btn {{ $isActive('budaya') }}"
           href="{{ route('tourguide.index', array_filter(['spesialisasi'=>'budaya','q'=>$q])) }}">Budaya</a>
      </div>

      {{-- Grid cards --}}
      <div class="row justify-content-center" id="tourguide-list">
        @forelse($guides as $g)
          <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="tg-card p-3 shadow-sm rounded-4 border h-100 d-flex flex-column text-center">
              <div class="mb-3">
                <img src="{{ $g->foto_url }}" alt="{{ $g->nama }}"
                     class="rounded-circle border border-3"
                     style="width:100px;height:100px;object-fit:cover;">
              </div>
              <h5 class="fw-bold mb-1">{{ $g->nama }}</h5>
              <p class="text-muted mb-3">Spesialis {{ ucfirst($g->spesialisasi ?? '-') }}</p>

              <div class="mt-auto d-flex justify-content-center gap-2">
                <a href="{{ route('tourguide.public', $g->id) }}" class="btn btn-outline-primary btn-sm px-3">Detail</a>
                @if($g->wa_link)
                  <a href="{{ $g->wa_link }}" target="_blank" class="btn btn-success btn-sm px-3">Hubungi</a>
                @endif
              </div>
            </div>
          </div>
        @empty
          <div class="col-12 text-center text-muted py-5">Tidak ada tour guide yang cocok.</div>
        @endforelse
      </div>

      {{-- Pagination --}}
      <div class="d-flex justify-content-center mt-3">
        {{ $guides->links() }}
      </div>

    </div>
  </section>

  <script src="{{ asset('assets/js/bootstrap-5.0.0-beta1.min.js') }}"></script>
  <script src="{{ asset('assets/js/tiny-slider.js') }}"></script>
  <script src="{{ asset('assets/js/wow.min.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
