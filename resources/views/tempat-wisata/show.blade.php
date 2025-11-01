@extends('layout.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="card-title fw-semibold mb-0">Detail Tempat Wisata</h5>
                        <div>
                            <a href="{{ route('tempat-wisata.edit', $tempatWisata) }}" class="btn btn-warning">
                                <i class="ti ti-edit me-2"></i>Edit
                            </a>
                            <a href="{{ route('tempat-wisata.index') }}" class="btn btn-secondary">
                                <i class="ti ti-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <h2>{{ $tempatWisata->nama_tempat }}</h2>
                            
                            <div class="mb-3">
                                <span class="badge bg-{{ $tempatWisata->kategori == 'alam' ? 'success' : ($tempatWisata->kategori == 'kuliner' ? 'warning' : 'info') }} me-2">
                                    {{ ucfirst($tempatWisata->kategori) }}
                                </span>
                                <span class="badge bg-{{ $tempatWisata->status == 'approved' ? 'success' : ($tempatWisata->status == 'rejected' ? 'danger' : 'warning') }}">
                                    {{ ucfirst($tempatWisata->status) }}
                                </span>
                            </div>

                            <div class="mb-4">
                                <h5>Deskripsi</h5>
                                <p class="text-muted">{{ $tempatWisata->deskripsi }}</p>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h6><i class="ti ti-map-pin me-2"></i>Alamat</h6>
                                    <p class="text-muted">{{ $tempatWisata->alamat }}</p>
                                    
                                    @if($tempatWisata->latitude && $tempatWisata->longitude)
                                        <a href="https://www.google.com/maps?q={{ $tempatWisata->latitude }},{{ $tempatWisata->longitude }}" 
                                           target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="ti ti-map me-1"></i>Lihat di Google Maps
                                        </a>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <h6><i class="ti ti-info-circle me-2"></i>Informasi</h6>
                                    <ul class="list-unstyled">
                                        @if($tempatWisata->tiket_masuk)
                                            <li><strong>Tiket Masuk:</strong> Rp {{ number_format($tempatWisata->tiket_masuk, 0, ',', '.') }}</li>
                                        @endif
                                        @if($tempatWisata->jam_buka)
                                            <li><strong>Jam Buka:</strong> {{ $tempatWisata->jam_buka }}</li>
                                        @endif
                                        @if($tempatWisata->kontak)
                                            <li><strong>Kontak:</strong> {{ $tempatWisata->kontak }}</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6 class="card-title">Statistik</h6>
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <i class="ti ti-photo me-2"></i>
                                            <strong>{{ $tempatWisata->photos->count() }}</strong> Foto
                                        </li>
                                        <li class="mb-2">
                                            <i class="ti ti-star me-2"></i>
                                            <strong>{{ $tempatWisata->reviews->count() }}</strong> Review
                                        </li>
                                        <li class="mb-2">
                                            <i class="ti ti-heart me-2"></i>
                                            <strong>{{ $tempatWisata->favorites->count() }}</strong> Favorite
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            @if($tempatWisata->bukti_kepemilikan)
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title">Bukti Kepemilikan</h6>
                                        <div class="mb-3">
                                            <div class="d-flex align-items-center mb-2">
                                                @if(pathinfo($tempatWisata->bukti_kepemilikan, PATHINFO_EXTENSION) == 'pdf')
                                                    <i class="ti ti-file-type-pdf fs-3 text-danger me-2"></i>
                                                @else
                                                    <img src="{{ Storage::url($tempatWisata->bukti_kepemilikan) }}" 
                                                         class="img-thumbnail me-2" style="max-width: 80px; max-height: 80px;">
                                                @endif
                                                <div>
                                                    <strong>Tipe:</strong> {{ ucfirst(str_replace('_', ' ', $tempatWisata->tipe_bukti ?? '-')) }}
                                                </div>
                                            </div>
                                            <a href="{{ Storage::url($tempatWisata->bukti_kepemilikan) }}" 
                                               target="_blank" class="btn btn-sm btn-primary w-100">
                                                <i class="ti ti-eye me-1"></i>Lihat Bukti Kepemilikan
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if($tempatWisata->photos->count() > 0)
                        <div class="mt-4">
                            <h5>Galeri Foto</h5>
                            <div class="row g-3">
                                @foreach($tempatWisata->photos as $photo)
                                    <div class="col-md-3 col-sm-4 col-6">
                                        <div class="position-relative">
                                            <img src="{{ Storage::url($photo->file_path) }}" 
                                                 class="img-fluid rounded" 
                                                 style="height: 200px; width: 100%; object-fit: cover; cursor: pointer;"
                                                 data-bs-toggle="modal" 
                                                 data-bs-target="#photoModal{{ $photo->id }}">
                                            @if($photo->keterangan)
                                                <div class="position-absolute bottom-0 start-0 end-0 bg-dark bg-opacity-75 text-white p-2 rounded-bottom">
                                                    <small>{{ $photo->keterangan }}</small>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="photoModal{{ $photo->id }}" tabindex="-1">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Foto Tempat Wisata</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img src="{{ Storage::url($photo->file_path) }}" 
                                                             class="img-fluid" alt="Foto">
                                                        @if($photo->keterangan)
                                                            <p class="mt-3">{{ $photo->keterangan }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="alert alert-info mt-4">
                            <i class="ti ti-info-circle me-2"></i>Belum ada foto untuk tempat wisata ini.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
