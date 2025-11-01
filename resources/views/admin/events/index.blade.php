@extends('layout.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="card-title fw-semibold mb-0">Kelola Events</h5>
                        <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
                            <i class="ti ti-plus me-2"></i>Tambah Event
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Filters -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <form method="GET" action="{{ route('admin.events.index') }}">
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-select">
                                            <option value="">Semua Status</option>
                                            <option value="upcoming" {{ request('status') == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                                            <option value="ongoing" {{ request('status') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                            <option value="done" {{ request('status') == 'done' ? 'selected' : '' }}>Done</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Dari Tanggal</label>
                                        <input type="date" name="date_from" class="form-control" 
                                               value="{{ request('date_from') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Sampai Tanggal</label>
                                        <input type="date" name="date_to" class="form-control" 
                                               value="{{ request('date_to') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Cari</label>
                                        <input type="text" name="search" class="form-control" 
                                               value="{{ request('search') }}" 
                                               placeholder="Cari nama event, lokasi...">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">&nbsp;</label>
                                        <div class="d-flex gap-2">
                                            <button type="submit" class="btn btn-primary w-100">
                                                <i class="ti ti-filter me-1"></i>Filter
                                            </button>
                                            <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">
                                                <i class="ti ti-x"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if($events->isEmpty())
                        <div class="text-center py-5">
                            <i class="ti ti-calendar-off fs-1 text-muted"></i>
                            <p class="text-muted mt-3">Tidak ada event ditemukan.</p>
                            <a href="{{ route('admin.events.create') }}" class="btn btn-primary mt-2">
                                <i class="ti ti-plus me-2"></i>Tambah Event Pertama
                            </a>
                        </div>
                    @else
                        <!-- Cards View -->
                        <div class="row">
                            @foreach($events as $event)
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="card h-100">
                                        @if($event->foto)
                                            <img src="{{ Storage::url($event->foto) }}" 
                                                 class="card-img-top" alt="{{ $event->nama_event }}" 
                                                 style="height: 200px; object-fit: cover;">
                                        @else
                                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                                                 style="height: 200px;">
                                                <i class="ti ti-calendar-event fs-1 text-muted"></i>
                                            </div>
                                        @endif
                                        <div class="card-body d-flex flex-column">
                                            <div class="mb-2">
                                                <span class="badge bg-{{ $event->status == 'upcoming' ? 'primary' : ($event->status == 'ongoing' ? 'info' : 'secondary') }}">
                                                    {{ ucfirst($event->status) }}
                                                </span>
                                            </div>
                                            <h5 class="card-title">{{ $event->nama_event }}</h5>
                                            <p class="card-text text-muted small">
                                                {{ \Illuminate\Support\Str::limit($event->deskripsi, 100) }}
                                            </p>
                                            <div class="mb-2">
                                                <small class="text-muted">
                                                    <i class="ti ti-calendar me-1"></i>
                                                    {{ \Carbon\Carbon::parse($event->tanggal_mulai)->format('d M Y') }}
                                                    @if($event->tanggal_selesai)
                                                        - {{ \Carbon\Carbon::parse($event->tanggal_selesai)->format('d M Y') }}
                                                    @endif
                                                </small>
                                            </div>
                                            <div class="mb-2">
                                                <small class="text-muted">
                                                    <i class="ti ti-map-pin me-1"></i>{{ $event->lokasi }}
                                                </small>
                                            </div>
                                            <div class="mt-auto pt-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <small class="text-muted">
                                                        <i class="ti ti-photo me-1"></i>
                                                        {{ $event->photos_count }} foto
                                                    </small>
                                                    <div class="d-flex gap-1">
                                                        <a href="{{ route('admin.events.show', $event) }}" 
                                                           class="btn btn-sm btn-outline-primary">
                                                            <i class="ti ti-eye"></i>
                                                        </a>
                                                        <a href="{{ route('admin.events.edit', $event) }}" 
                                                           class="btn btn-sm btn-outline-warning">
                                                            <i class="ti ti-edit"></i>
                                                        </a>
                                                        <form action="{{ route('admin.events.destroy', $event) }}" 
                                                              method="POST" class="d-inline"
                                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus event ini?');">
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

                        <!-- Pagination -->
                        <div class="mt-3">
                            {{ $events->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

