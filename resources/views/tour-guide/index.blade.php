@extends('layout.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="card-title fw-semibold mb-0">Profil Tour Guide</h5>
                        @if($canCreate)
                            <a href="{{ route('tour-guide.create') }}" class="btn btn-primary">
                                <i class="ti ti-plus me-2"></i>Tambah Tour Guide
                            </a>
                        @else
                            @php
                                $existingTourGuide = $tourGuides->whereIn('status', ['approved', 'pending'])->first();
                                $statusText = $existingTourGuide && $existingTourGuide->status == 'approved' ? 'disetujui' : 'menunggu persetujuan';
                            @endphp
                            <button class="btn btn-secondary" disabled title="Anda sudah memiliki profil tour guide yang {{ $statusText }}">
                                <i class="ti ti-plus me-2"></i>Tambah Tour Guide
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

                    @if($tourGuides->isEmpty())
                        <div class="text-center py-5">
                            <i class="ti ti-user-off fs-1 text-muted"></i>
                            <p class="text-muted mt-3">Belum ada profil tour guide. Silakan tambah profil baru.</p>
                            @if($canCreate)
                                <a href="{{ route('tour-guide.create') }}" class="btn btn-primary mt-2">
                                    <i class="ti ti-plus me-2"></i>Tambah Profil Tour Guide Pertama
                                </a>
                            @endif
                        </div>
                    @else
                        <div class="row">
                            @foreach($tourGuides as $tourGuide)
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="card h-100">
                                        @if($tourGuide->foto)
                                            <img src="{{ Storage::url($tourGuide->foto) }}" 
                                                 class="card-img-top" alt="{{ $tourGuide->nama }}" 
                                                 style="height: 250px; object-fit: cover;">
                                        @else
                                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                                                 style="height: 250px;">
                                                <i class="ti ti-user fs-1 text-muted"></i>
                                            </div>
                                        @endif
                                        <div class="card-body d-flex flex-column">
                                            <div class="mb-2">
                                                <span class="badge bg-{{ $tourGuide->spesialisasi == 'alam' ? 'success' : ($tourGuide->spesialisasi == 'kuliner' ? 'warning' : ($tourGuide->spesialisasi == 'budaya' ? 'info' : 'primary')) }}">
                                                    {{ ucfirst($tourGuide->spesialisasi) }}
                                                </span>
                                                <span class="badge bg-{{ $tourGuide->status == 'approved' ? 'success' : ($tourGuide->status == 'rejected' ? 'danger' : 'warning') }} ms-2">
                                                    {{ ucfirst($tourGuide->status) }}
                                                </span>
                                            </div>
                                            <h5 class="card-title">{{ $tourGuide->nama }}</h5>
                                            @if($tourGuide->pengalaman)
                                                <p class="card-text text-muted small">
                                                    {{ \Illuminate\Support\Str::limit($tourGuide->pengalaman, 100) }}
                                                </p>
                                            @endif
                                            @php
                                                $bahasaDetails = $tourGuide->detailTourGuides->whereNotNull('bahasa');
                                            @endphp
                                            @if($bahasaDetails->isNotEmpty())
                                                <p class="card-text text-muted small mb-2">
                                                    <i class="ti ti-language me-1"></i>
                                                    {{ $bahasaDetails->pluck('bahasa')->implode(', ') }}
                                                </p>
                                            @endif
                                            @php
                                                $sertifikatCount = $tourGuide->detailTourGuides->whereNotNull('sertifikat')->count();
                                            @endphp
                                            @if($sertifikatCount > 0)
                                                <p class="card-text text-muted small">
                                                    <i class="ti ti-certificate me-1"></i>{{ $sertifikatCount }} Sertifikat
                                                </p>
                                            @endif
                                            <div class="mt-auto pt-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <a href="{{ route('tour-guide.show', $tourGuide) }}" 
                                                           class="btn btn-sm btn-outline-primary">
                                                            <i class="ti ti-eye"></i>
                                                        </a>
                                                        <a href="{{ route('tour-guide.edit', $tourGuide) }}" 
                                                           class="btn btn-sm btn-outline-warning">
                                                            <i class="ti ti-edit"></i>
                                                        </a>
                                                        <form action="{{ route('tour-guide.destroy', $tourGuide) }}" 
                                                              method="POST" class="d-inline"
                                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus profil tour guide ini?');">
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

