@extends('layout.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="card-title fw-semibold mb-0">Daftar Tempat Wisata</h5>
                        @if($canCreate)
                            <a href="{{ route('tempat-wisata.create') }}" class="btn btn-primary">
                                <i class="ti ti-plus me-2"></i>Tambah Tempat Wisata
                            </a>
                        @else
                            @php
                                $existingTempatWisata = $tempatWisatas->whereIn('status', ['approved', 'pending'])->first();
                                $statusText = $existingTempatWisata && $existingTempatWisata->status == 'approved' ? 'disetujui' : 'menunggu persetujuan';
                            @endphp
                            <button class="btn btn-secondary" disabled title="Anda sudah memiliki tempat wisata yang {{ $statusText }}">
                                <i class="ti ti-plus me-2"></i>Tambah Tempat Wisata
                            </button>
                        @endif
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($tempatWisatas->isEmpty())
                        <div class="text-center py-5">
                            <i class="ti ti-map-pin-off fs-1 text-muted"></i>
                            <p class="text-muted mt-3">Belum ada tempat wisata. Silakan tambah tempat wisata baru.</p>
                            @if($canCreate)
                                <a href="{{ route('tempat-wisata.create') }}" class="btn btn-primary mt-2">
                                    <i class="ti ti-plus me-2"></i>Tambah Tempat Wisata Pertama
                                </a>
                            @endif
                        </div>
                    @else
                        <div class="row">
                            @foreach($tempatWisatas as $tempatWisata)
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="card h-100">
                                        @if($tempatWisata->photos->first())
                                            <img src="{{ Storage::url($tempatWisata->photos->first()->file_path) }}" 
                                                 class="card-img-top" alt="{{ $tempatWisata->nama_tempat }}" 
                                                 style="height: 200px; object-fit: cover;">
                                        @else
                                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                                                 style="height: 200px;">
                                                <i class="ti ti-photo fs-1 text-muted"></i>
                                            </div>
                                        @endif
                                        <div class="card-body d-flex flex-column">
                                            <div class="mb-2">
                                                <span class="badge bg-{{ $tempatWisata->kategori == 'alam' ? 'success' : ($tempatWisata->kategori == 'kuliner' ? 'warning' : 'info') }}">
                                                    {{ ucfirst($tempatWisata->kategori) }}
                                                </span>
                                                <span class="badge bg-{{ $tempatWisata->status == 'approved' ? 'success' : ($tempatWisata->status == 'rejected' ? 'danger' : 'warning') }} ms-2">
                                                    {{ ucfirst($tempatWisata->status) }}
                                                </span>
                                            </div>
                                            <h5 class="card-title">{{ $tempatWisata->nama_tempat }}</h5>
                                            <p class="card-text text-muted small">
                                                {{ Str::limit($tempatWisata->deskripsi, 100) }}
                                            </p>
                                            <div class="mt-auto pt-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <small class="text-muted">
                                                        <i class="ti ti-photo me-1"></i>
                                                        {{ $tempatWisata->photos->count() }} foto
                                                    </small>
                                                    <div>
                                                        <a href="{{ route('tempat-wisata.show', $tempatWisata) }}" 
                                                           class="btn btn-sm btn-outline-primary">
                                                            <i class="ti ti-eye"></i>
                                                        </a>
                                                        <a href="{{ route('tempat-wisata.edit', $tempatWisata) }}" 
                                                           class="btn btn-sm btn-outline-warning">
                                                            <i class="ti ti-edit"></i>
                                                        </a>
                                                        <form action="{{ route('tempat-wisata.destroy', $tempatWisata) }}" 
                                                              method="POST" class="d-inline"
                                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus tempat wisata ini?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                                <i class="ti ti-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
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
