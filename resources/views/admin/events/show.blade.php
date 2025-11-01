@extends('layout.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="card-title fw-semibold mb-0">Detail Event</h5>
                        <div>
                            <a href="{{ route('admin.events.send-invitation', $event) }}" class="btn btn-info">
                                <i class="ti ti-send me-2"></i>Kirim Undangan
                            </a>
                            <a href="{{ route('admin.events.participants', $event) }}" class="btn btn-success">
                                <i class="ti ti-users me-2"></i>Lihat Pendaftar
                            </a>
                            <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-warning">
                                <i class="ti ti-edit me-2"></i>Edit
                            </a>
                            <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">
                                <i class="ti ti-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            @if($event->foto)
                                <img src="{{ Storage::url($event->foto) }}" 
                                     class="img-fluid rounded mb-4" 
                                     alt="{{ $event->nama_event }}" 
                                     style="max-height: 400px; width: 100%; object-fit: cover;">
                            @endif

                            <h2>{{ $event->nama_event }}</h2>
                            
                            <div class="mb-3">
                                <span class="badge bg-{{ $event->status == 'upcoming' ? 'primary' : ($event->status == 'ongoing' ? 'info' : 'secondary') }}">
                                    {{ ucfirst($event->status) }}
                                </span>
                            </div>

                            <div class="mb-4">
                                <h5>Deskripsi</h5>
                                <p class="text-muted">{{ $event->deskripsi }}</p>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h6><i class="ti ti-calendar me-2"></i>Tanggal</h6>
                                    <p class="text-muted">
                                        <strong>Mulai:</strong> {{ \Carbon\Carbon::parse($event->tanggal_mulai)->format('d M Y') }}<br>
                                        @if($event->tanggal_selesai)
                                            <strong>Selesai:</strong> {{ \Carbon\Carbon::parse($event->tanggal_selesai)->format('d M Y') }}
                                        @endif
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <h6><i class="ti ti-map-pin me-2"></i>Lokasi</h6>
                                    <p class="text-muted">{{ $event->lokasi }}</p>
                                    @if($event->latitude && $event->longitude)
                                        <a href="https://www.google.com/maps?q={{ $event->latitude }},{{ $event->longitude }}" 
                                           target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="ti ti-map me-1"></i>Lihat di Google Maps
                                        </a>
                                    @endif
                                </div>
                            </div>

                            @if($event->photos->count() > 0)
                                <div class="mt-4">
                                    <h5>Galeri Foto</h5>
                                    <div class="row g-3">
                                        @foreach($event->photos as $photo)
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
                                                                <h5 class="modal-title">Foto Event</h5>
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
                            @endif
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Statistik</h6>
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <i class="ti ti-photo me-2"></i>
                                            <strong>{{ $event->photos->count() }}</strong> Foto
                                        </li>
                                        <li class="mb-2">
                                            <i class="ti ti-users me-2"></i>
                                            <strong>{{ $registrationsCount }}</strong> Pendaftar
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="card mt-3">
                                <div class="card-body">
                                    <h6 class="card-title">Informasi Event</h6>
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <i class="ti ti-calendar me-2"></i>
                                            <strong>Dibuat:</strong> {{ $event->created_at->format('d M Y') }}
                                        </li>
                                        <li class="mb-2">
                                            <i class="ti ti-edit me-2"></i>
                                            <strong>Diupdate:</strong> {{ $event->updated_at->format('d M Y') }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

