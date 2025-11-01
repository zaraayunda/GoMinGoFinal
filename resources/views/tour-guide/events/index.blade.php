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
                            <h5 class="card-title fw-semibold mb-1">
                                <i class="ti ti-calendar-event me-2 text-primary"></i>Event & Undangan
                            </h5>
                            <p class="text-muted mb-0">Kelola event yang diundang dan pendaftaran Anda</p>
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

                    @if(session('info'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <i class="ti ti-info-circle me-2"></i>{{ session('info') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Pending Invitations -->
                    @if($pendingInvitations->count() > 0)
                        <div class="mb-5">
                            <h6 class="fw-semibold mb-3 text-primary">
                                <i class="ti ti-bell me-2"></i>Undangan Baru ({{ $pendingInvitations->count() }})
                            </h6>
                            <div class="row">
                                @foreach($pendingInvitations as $invitation)
                                    @php $event = $invitation->event; @endphp
                                    <div class="col-md-6 col-lg-4 mb-4">
                                        <div class="card h-100 border-primary shadow-sm">
                                            @if($event->foto)
                                                <img src="{{ Storage::url($event->foto) }}" 
                                                     class="card-img-top" 
                                                     alt="{{ $event->nama_event }}"
                                                     style="height: 200px; object-fit: cover;">
                                            @else
                                                <div class="bg-light d-flex align-items-center justify-content-center"
                                                     style="height: 200px;">
                                                    <i class="ti ti-calendar fs-1 text-muted"></i>
                                                </div>
                                            @endif
                                            <div class="card-body d-flex flex-column">
                                                <div class="mb-2">
                                                    <span class="badge bg-warning">
                                                        <i class="ti ti-clock me-1"></i>{{ ucfirst($event->status) }}
                                                    </span>
                                                </div>
                                                <h6 class="card-title fw-semibold mb-2">{{ $event->nama_event }}</h6>
                                                <p class="card-text text-muted small mb-2">
                                                    <i class="ti ti-map-pin me-1"></i>{{ $event->lokasi }}
                                                </p>
                                                <p class="card-text text-muted small mb-2">
                                                    <i class="ti ti-calendar me-1"></i>
                                                    {{ \Carbon\Carbon::parse($event->tanggal_mulai)->format('d M Y') }}
                                                    @if($event->tanggal_selesai)
                                                        - {{ \Carbon\Carbon::parse($event->tanggal_selesai)->format('d M Y') }}
                                                    @endif
                                                </p>
                                                <p class="card-text small text-muted mb-3">
                                                    {{ \Illuminate\Support\Str::limit($event->deskripsi, 100) }}
                                                </p>
                                                <div class="mt-auto">
                                                    <a href="{{ route('tourguide.events.show', $event->id) }}" 
                                                       class="btn btn-primary btn-sm w-100">
                                                        <i class="ti ti-eye me-1"></i>Lihat Detail & Daftar
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Registered Events -->
                    <div>
                        <h6 class="fw-semibold mb-3">
                            <i class="ti ti-list me-2"></i>Pendaftaran Saya ({{ $registeredEvents->count() }})
                        </h6>
                        @if($registeredEvents->count() > 0)
                            <div class="row">
                                @foreach($registeredEvents as $registration)
                                    @php $event = $registration->event; @endphp
                                    <div class="col-md-6 col-lg-4 mb-4">
                                        <div class="card h-100 shadow-sm">
                                            @if($event->foto)
                                                <img src="{{ Storage::url($event->foto) }}" 
                                                     class="card-img-top" 
                                                     alt="{{ $event->nama_event }}"
                                                     style="height: 200px; object-fit: cover;">
                                            @else
                                                <div class="bg-light d-flex align-items-center justify-content-center"
                                                     style="height: 200px;">
                                                    <i class="ti ti-calendar fs-1 text-muted"></i>
                                                </div>
                                            @endif
                                            <div class="card-body d-flex flex-column">
                                                <div class="mb-2">
                                                    <span class="badge 
                                                        {{ $registration->status == 'approved' ? 'bg-success' : 
                                                           ($registration->status == 'rejected' ? 'bg-danger' : 'bg-warning') }}">
                                                        <i class="ti ti-{{ $registration->status == 'approved' ? 'check' : ($registration->status == 'rejected' ? 'x' : 'clock') }} me-1"></i>
                                                        {{ ucfirst($registration->status) }}
                                                    </span>
                                                    <span class="badge bg-info ms-1">
                                                        {{ ucfirst($event->status) }}
                                                    </span>
                                                </div>
                                                <h6 class="card-title fw-semibold mb-2">{{ $event->nama_event }}</h6>
                                                <p class="card-text text-muted small mb-2">
                                                    <i class="ti ti-map-pin me-1"></i>{{ $event->lokasi }}
                                                </p>
                                                <p class="card-text text-muted small mb-2">
                                                    <i class="ti ti-calendar me-1"></i>
                                                    {{ \Carbon\Carbon::parse($event->tanggal_mulai)->format('d M Y') }}
                                                    @if($event->tanggal_selesai)
                                                        - {{ \Carbon\Carbon::parse($event->tanggal_selesai)->format('d M Y') }}
                                                    @endif
                                                </p>
                                                @if($registration->catatan)
                                                    <p class="card-text small text-muted mb-2">
                                                        <strong>Catatan:</strong> {{ $registration->catatan }}
                                                    </p>
                                                @endif
                                                <div class="mt-auto">
                                                    <a href="{{ route('tourguide.events.show', $event->id) }}" 
                                                       class="btn btn-outline-primary btn-sm w-100">
                                                        <i class="ti ti-eye me-1"></i>Lihat Detail
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-5 bg-light rounded">
                                <i class="ti ti-calendar-off fs-1 text-muted mb-3"></i>
                                <p class="text-muted mb-0">Anda belum mendaftar untuk event apapun</p>
                            </div>
                        @endif
                    </div>

                    <!-- Empty State jika tidak ada invitation dan registration -->
                    @if($pendingInvitations->count() == 0 && $registeredEvents->count() == 0)
                        <div class="text-center py-5">
                            <i class="ti ti-calendar-off fs-1 text-muted mb-3"></i>
                            <h6 class="fw-semibold mb-2">Belum ada Event</h6>
                            <p class="text-muted mb-0">Anda belum menerima undangan event. Tunggu admin untuk mengundang Anda ke event.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

