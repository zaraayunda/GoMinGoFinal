@extends('layout.dashboard')

@php
    use Illuminate\Support\Facades\Storage;
@endphp

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <a href="{{ route('tourguide.events.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
                                <i class="ti ti-arrow-left me-1"></i>Kembali ke Daftar Event
                            </a>
                            <h5 class="card-title fw-semibold mb-0">{{ $event->nama_event }}</h5>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="ti ti-checks me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="ti ti-alert-triangle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-lg-8">
                            @if($event->foto)
                                <img src="{{ Storage::url($event->foto) }}" 
                                     class="img-fluid rounded mb-4" 
                                     alt="{{ $event->nama_event }}">
                            @endif

                            <div class="mb-4">
                                <h6 class="fw-semibold mb-3">Deskripsi Event</h6>
                                <p class="text-muted">{{ $event->deskripsi }}</p>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="ti ti-map-pin text-primary me-2 fs-5"></i>
                                        <div>
                                            <small class="text-muted d-block">Lokasi</small>
                                            <strong>{{ $event->lokasi }}</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="ti ti-calendar text-primary me-2 fs-5"></i>
                                        <div>
                                            <small class="text-muted d-block">Tanggal Mulai</small>
                                            <strong>{{ \Carbon\Carbon::parse($event->tanggal_mulai)->format('d M Y') }}</strong>
                                        </div>
                                    </div>
                                </div>
                                @if($event->tanggal_selesai)
                                    <div class="col-md-6 mb-3">
                                        <div class="d-flex align-items-center">
                                            <i class="ti ti-calendar-check text-primary me-2 fs-5"></i>
                                            <div>
                                                <small class="text-muted d-block">Tanggal Selesai</small>
                                                <strong>{{ \Carbon\Carbon::parse($event->tanggal_selesai)->format('d M Y') }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($event->latitude && $event->longitude)
                                    <div class="col-md-6 mb-3">
                                        <div class="d-flex align-items-center">
                                            <i class="ti ti-map text-primary me-2 fs-5"></i>
                                            <div>
                                                <small class="text-muted d-block">Koordinat</small>
                                                <strong>{{ $event->latitude }}, {{ $event->longitude }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            @if($event->photos->count() > 0)
                                <div class="mb-4">
                                    <h6 class="fw-semibold mb-3">Foto Event</h6>
                                    <div class="row">
                                        @foreach($event->photos as $photo)
                                            <div class="col-md-4 mb-3">
                                                <img src="{{ Storage::url($photo->file_path) }}" 
                                                     class="img-fluid rounded" 
                                                     alt="Foto Event">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="col-lg-4">
                            <div class="card border">
                                <div class="card-body">
                                    <h6 class="fw-semibold mb-3">Status</h6>
                                    <div class="mb-3">
                                        <span class="badge bg-info fs-6">
                                            {{ ucfirst($event->status) }}
                                        </span>
                                    </div>

                                    @if($invitation)
                                        <div class="alert alert-info mb-3">
                                            <i class="ti ti-bell me-2"></i>
                                            <small>Anda telah diundang untuk event ini</small>
                                        </div>
                                    @endif

                                    @if($registration)
                                        <div class="mb-3">
                                            <h6 class="fw-semibold mb-2">Status Pendaftaran</h6>
                                            <span class="badge 
                                                {{ $registration->status == 'approved' ? 'bg-success' : 
                                                   ($registration->status == 'rejected' ? 'bg-danger' : 'bg-warning') }} fs-6">
                                                <i class="ti ti-{{ $registration->status == 'approved' ? 'check' : ($registration->status == 'rejected' ? 'x' : 'clock') }} me-1"></i>
                                                {{ ucfirst($registration->status) }}
                                            </span>
                                        </div>
                                        @if($registration->catatan)
                                            <div class="mb-3">
                                                <small class="text-muted d-block mb-1">Catatan Anda:</small>
                                                <p class="mb-0 small">{{ $registration->catatan }}</p>
                                            </div>
                                        @endif
                                    @else
                                        @if($invitation)
                                            <form action="{{ route('tourguide.events.register', $event->id) }}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label class="form-label small">Catatan (Opsional)</label>
                                                    <textarea name="catatan" 
                                                              class="form-control form-control-sm" 
                                                              rows="3" 
                                                              placeholder="Tambahkan catatan untuk admin..."></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary w-100">
                                                    <i class="ti ti-user-plus me-1"></i>Daftar Event
                                                </button>
                                            </form>
                                        @else
                                            <div class="alert alert-warning">
                                                <i class="ti ti-alert-circle me-2"></i>
                                                <small>Anda belum diundang untuk event ini. Hubungi admin jika Anda ingin berpartisipasi.</small>
                                            </div>
                                        @endif
                                    @endif
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

