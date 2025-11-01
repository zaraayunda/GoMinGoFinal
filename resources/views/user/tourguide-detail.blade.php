

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
    <div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-lg-8">

      <div class="p-4 rounded-4 shadow-sm border bg-white">
        <div class="text-center mb-4">
          <img src="{{ $guide->foto_url }}" alt="{{ $guide->nama }}"
               class="rounded-circle border border-3"
               style="width:120px;height:120px;object-fit:cover;">
          <h3 class="fw-bold mt-3 mb-1">{{ $guide->nama }}</h3>
          <div class="text-muted">Spesialis {{ ucfirst($guide->spesialisasi ?? '-') }}</div>
        </div>

        <div class="row g-3">
          <div class="col-md-6">
            <div class="p-3 rounded-3 border h-100">
              <div class="fw-semibold mb-2">Pengalaman</div>
              <div>{{ $guide->pengalaman ?? '—' }}</div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="p-3 rounded-3 border h-100">
              <div class="fw-semibold mb-2">Kontak</div>
              <div>{{ $guide->kontak ?? '—' }}</div>
            </div>
          </div>

          @if($bahasa && $bahasa->count())
          <div class="col-md-6">
            <div class="p-3 rounded-3 border h-100">
              <div class="fw-semibold mb-2">Bahasa</div>
              <div>
                @foreach($bahasa as $b)
                  <span class="badge bg-light text-dark border me-1 mb-1">{{ $b }}</span>
                @endforeach
              </div>
            </div>
          </div>
          @endif

          @if($sertifikat && $sertifikat->count())
          <div class="col-md-6">
            <div class="p-3 rounded-3 border h-100">
              <div class="fw-semibold mb-2">Sertifikat</div>
              <ul class="mb-0 ps-3">
                @foreach($sertifikat as $s)
                  <li>{{ $s }}</li>
                @endforeach
              </ul>
            </div>
          </div>
          @endif
        </div>

        <div class="d-flex gap-2 justify-content-center mt-4">
          <a href="{{ url()->previous() }}" class="btn btn-outline-secondary px-4">Kembali</a>
          @if($guide->wa_link)
            <a href="{{ $guide->wa_link }}" target="_blank" class="btn btn-success px-4">Hubungi via WhatsApp</a>
          @endif
        </div>
      </div>

    </div>
  </div>
</div>
    <!-- ========================= scroll-top end ========================= -->
		

    <!-- ========================= JS here ========================= -->
    <script src="{{ asset('assets/js/bootstrap-5.0.0-beta1.min.js') }}"></script>
    <script src="{{ asset('assets/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
  </body>
</html>
