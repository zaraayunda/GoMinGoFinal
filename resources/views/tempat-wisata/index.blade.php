@extends('layout.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <!-- Header Toolbar -->
                    <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-4">
                        <div class="d-flex align-items-center gap-2">
                            <i class="ti ti-map-pin fs-4 text-primary"></i>
                            <h5 class="card-title fw-semibold mb-0">Daftar Tempat Wisata</h5>
                            @if(!$tempatWisatas->isEmpty())
                                <span class="badge bg-light text-dark ms-2">{{ $tempatWisatas->count() }} item</span>
                            @endif
                        </div>

                        <div class="d-flex flex-wrap gap-2">
                            @if($canCreate && !$tempatWisatas->isEmpty())
                                <a href="{{ route('tempat-wisata.create') }}" class="btn btn-primary" style="background-color: #007bff; border-color: #007bff; color: #fff; font-weight: 600;">
                                    <i class="ti ti-plus me-1"></i> Tambah Tempat Wisata
                                </a>
                            @elseif(!$canCreate)
                                <button class="btn btn-secondary" disabled title="Anda sudah memiliki tempat wisata yang sedang diproses atau disetujui">
                                    <i class="ti ti-lock me-1"></i> Tambah Tempat Wisata
                                </button>
                            @endif
                        </div>
                    </div>

                    <!-- Flash messages -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="ti ti-checks me-1"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="ti ti-alert-triangle me-1"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Empty State -->
                    @if($tempatWisatas->isEmpty())
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="ti ti-map-pin-off fs-1 text-muted"></i>
                            </div>
                            <h6 class="fw-semibold mb-1">Belum ada tempat wisata</h6>
                            <p class="text-muted mb-3">Silakan tambah tempat wisata baru untuk mulai.</p>
                            @if($canCreate)
                                <a href="{{ route('tempat-wisata.create') }}" class="btn btn-primary" style="background-color: #007bff; border-color: #007bff; color: #fff; font-weight: 600; padding: 12px 24px;">
                                    <i class="ti ti-plus me-1"></i> Tambah Tempat Wisata Pertama
                                </a>
                            @endif
                        </div>
                    @else
                        <!-- Grid Cards -->
                        <div class="row">
                            @foreach($tempatWisatas as $tempatWisata)
                                <div class="col-sm-6 col-lg-4 mb-4">
                                    <div class="card h-100 shadow-sm border-0">
                                        {{-- Foto --}}
                                        @if($tempatWisata->photos->first())
                                            <img src="{{ Storage::url($tempatWisata->photos->first()->file_path) }}" 
                                                 class="card-img-top"
                                                 alt="{{ $tempatWisata->nama_tempat }}"
                                                 style="height: 230px; object-fit: cover;">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center"
                                                 style="height: 230px;">
                                                <i class="ti ti-photo fs-1 text-muted"></i>
                                            </div>
                                        @endif

                                        <div class="card-body d-flex flex-column">
                                            {{-- Badges --}}
                                            <div class="d-flex gap-2 mb-2">
                                                <span class="badge 
                                                    {{ $tempatWisata->kategori == 'alam' ? 'bg-success' : 
                                                       ($tempatWisata->kategori == 'kuliner' ? 'bg-warning' : 'bg-info') }}">
                                                    {{ ucfirst($tempatWisata->kategori) }}
                                                </span>
                                                <span class="badge 
                                                    {{ $tempatWisata->status == 'approved' ? 'bg-success' :
                                                       ($tempatWisata->status == 'rejected' ? 'bg-danger' : 'bg-warning') }}">
                                                    {{ ucfirst($tempatWisata->status) }}
                                                </span>
                                            </div>

                                            {{-- Nama Tempat --}}
                                            <h5 class="card-title mb-1">{{ $tempatWisata->nama_tempat }}</h5>

                                            {{-- Deskripsi --}}
                                            <p class="card-text text-muted small mb-2">
                                                {{ \Illuminate\Support\Str::limit($tempatWisata->deskripsi, 110) }}
                                            </p>

                                            {{-- Info Foto --}}
                                            <p class="card-text text-muted small mb-3">
                                                <i class="ti ti-photo me-1"></i> {{ $tempatWisata->photos->count() }} foto
                                            </p>

                                            {{-- Actions --}}
                                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                                <a href="{{ route('tempat-wisata.show', $tempatWisata) }}"
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
                                                            <a class="dropdown-item" href="{{ route('tempat-wisata.edit', $tempatWisata) }}">
                                                                <i class="ti ti-edit me-1"></i> Edit
                                                            </a>
                                                        </li>
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li>
                                                            <form action="{{ route('tempat-wisata.destroy', $tempatWisata) }}"
                                                                  method="POST"
                                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus tempat wisata ini?');">
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
