@extends('layout.dashboard')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
      <div class="card w-100">
        <div class="card-body p-4">

          {{-- Toolbar --}}
          <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center gap-2">
              <i class="ti ti-user fs-4 text-primary"></i>
              <h5 class="card-title fw-semibold mb-0">Profil Tour Guide</h5>
              @if(!$tourGuides->isEmpty())
                <span class="badge bg-light text-dark ms-2">{{ $tourGuides->count() }} item</span>
              @endif
            </div>

            <div class="d-flex flex-wrap gap-2">
              {{-- Tampilkan tombol Kelola Jadwal hanya untuk TG yang punya profil --}}
              @if (auth()->check() && auth()->user()->role === 'tour_guide' && !$tourGuides->isEmpty())
                <a href="{{ route('guide.schedules.index') }}" class="btn btn-success">
                  <i class="ti ti-calendar-event me-1"></i> Kelola Jadwal
                </a>
              @endif

              @if ($canCreate)
                <a href="{{ route('tour-guide.create') }}" class="btn btn-primary" style="background-color: #007bff; border-color: #007bff; color: #fff; font-weight: 600;">
                  <i class="ti ti-plus me-1"></i> Tambah Tour Guide
                </a>
              @else
                @php
                  $existingTourGuide = $tourGuides->whereIn('status',['approved','pending'])->first();
                  $statusText = $existingTourGuide && $existingTourGuide->status === 'approved' ? 'disetujui' : 'menunggu persetujuan';
                @endphp
                <button class="btn btn-secondary" disabled
                  title="Anda sudah memiliki profil tour guide yang {{ $statusText }}">
                  <i class="ti ti-lock me-1"></i> Tambah Tour Guide
                </button>
              @endif
            </div>
          </div>

          {{-- Flash messages --}}
          @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="ti ti-checks me-1"></i> {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

          @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="ti ti-alert-triangle me-1"></i> {{ session('error') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

          {{-- Empty state --}}
          @if ($tourGuides->isEmpty())
            <div class="text-center py-5">
              <div class="mb-3">
                <i class="ti ti-user-off fs-1 text-muted"></i>
              </div>
              <h6 class="fw-semibold mb-1">Belum ada profil tour guide</h6>
              <p class="text-muted mb-3">Buat profil pertama untuk mulai tampil di katalog.</p>
              @if ($canCreate)
                <a href="{{ route('tour-guide.create') }}" class="btn btn-primary" style="background-color: #007bff; border-color: #007bff; color: #fff; font-weight: 600; padding: 12px 24px;">
                  <i class="ti ti-plus me-1"></i> Tambah Profil Tour Guide Pertama
                </a>
              @endif
            </div>
          @else

            @php
              // helper kecil buat badge status & spesialisasi
              $badgeStatus = fn($s) => $s==='approved' ? 'success' : ($s==='rejected' ? 'danger' : 'warning');
              $badgeSpec   = fn($s) => $s==='alam' ? 'success' : ($s==='kuliner' ? 'warning' : ($s==='budaya' ? 'info' : 'primary'));
            @endphp

            <div class="row">
              @foreach ($tourGuides as $tourGuide)
                <div class="col-sm-6 col-lg-4 mb-4">
                  <div class="card h-100 shadow-sm border-0">
                    {{-- Foto --}}
                    @if ($tourGuide->foto)
                      <img src="{{ Storage::url($tourGuide->foto) }}"
                           class="card-img-top"
                           alt="{{ $tourGuide->nama }}"
                           style="height: 230px; object-fit: cover; border-top-left-radius: .5rem; border-top-right-radius: .5rem;">
                    @else
                      <div class="bg-light d-flex align-items-center justify-content-center"
                           style="height: 230px; border-top-left-radius:.5rem; border-top-right-radius:.5rem;">
                        <i class="ti ti-user fs-1 text-muted"></i>
                      </div>
                    @endif

                    <div class="card-body d-flex flex-column">
                      {{-- Badges --}}
                      <div class="d-flex gap-2 mb-2">
                        <span class="badge bg-{{ $badgeSpec($tourGuide->spesialisasi) }}">
                          {{ ucfirst($tourGuide->spesialisasi) }}
                        </span>
                        <span class="badge bg-{{ $badgeStatus($tourGuide->status) }}">
                          {{ ucfirst($tourGuide->status) }}
                        </span>
                      </div>

                      {{-- Nama --}}
                      <h5 class="card-title mb-1">{{ $tourGuide->nama }}</h5>

                      {{-- Pengalaman --}}
                      @if ($tourGuide->pengalaman)
                        <p class="card-text text-muted small mb-2">
                          {{ \Illuminate\Support\Str::limit($tourGuide->pengalaman, 110) }}
                        </p>
                      @endif

                      {{-- Bahasa --}}
                      @php
                        $bahasaDetails = $tourGuide->detailTourGuides->whereNotNull('bahasa');
                      @endphp
                      @if ($bahasaDetails->isNotEmpty())
                        <div class="mb-2">
                          <span class="text-muted small d-block mb-1">
                            <i class="ti ti-language me-1"></i> Bahasa
                          </span>
                          <div class="d-flex flex-wrap gap-1">
                            @foreach ($bahasaDetails->pluck('bahasa')->unique()->take(5) as $b)
                              <span class="badge bg-light text-dark border">{{ $b }}</span>
                            @endforeach
                            @if($bahasaDetails->pluck('bahasa')->unique()->count() > 5)
                              <span class="badge bg-light text-dark border">+{{ $bahasaDetails->pluck('bahasa')->unique()->count() - 5 }}</span>
                            @endif
                          </div>
                        </div>
                      @endif

                      {{-- Sertifikat --}}
                      @php
                        $sertifikatCount = $tourGuide->detailTourGuides->whereNotNull('sertifikat')->count();
                      @endphp
                      @if ($sertifikatCount > 0)
                        <p class="card-text text-muted small mb-3">
                          <i class="ti ti-certificate me-1"></i> {{ $sertifikatCount }} Sertifikat
                        </p>
                      @endif

                      {{-- Actions --}}
                      <div class="mt-auto d-flex justify-content-between align-items-center">
                        <a href="{{ route('tour-guide.show', $tourGuide) }}"
                           class="btn btn-outline-primary btn-sm">
                          <i class="ti ti-eye me-1"></i> Lihat
                        </a>

                        <div class="dropstart">
                          <button class="btn btn-light btn-sm border dropdown-toggle"
                                  data-bs-toggle="dropdown" aria-expanded="false">
                            Aksi
                          </button>
                          <ul class="dropdown-menu">
                            <li>
                              <a class="dropdown-item" href="{{ route('tour-guide.edit', $tourGuide) }}">
                                <i class="ti ti-edit me-1"></i> Edit
                              </a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="{{ route('guide.schedules.index') }}">
                                <i class="ti ti-calendar-event me-1"></i> Kelola Jadwal
                              </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                              <form action="{{ route('tour-guide.destroy', $tourGuide) }}"
                                    method="POST"
                                    onsubmit="return confirm('Hapus profil tour guide ini?');">
                                @csrf @method('DELETE')
                                <button class="dropdown-item text-danger">
                                  <i class="ti ti-trash me-1"></i> Hapus
                                </button>
                              </form>
                            </li>
                          </ul>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              @endforeach
            </div>

          @endif

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
