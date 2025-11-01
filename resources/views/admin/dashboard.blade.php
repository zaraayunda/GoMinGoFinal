@extends('layout.dashboard')

@section('content')
<div class="container-fluid">
    <!-- Welcome Section -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center py-5">
                    <h2 class="mb-3">Selamat Datang, {{ Auth::user()->name }}! 👋</h2>
                    <p class="text-muted fs-5">Dashboard Admin - Sistem Manajemen GoMinGo</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mt-4">
        <!-- Tempat Wisata Stats -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-primary">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary-subtle rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="ti ti-map-pin fs-4 text-primary"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Total Tempat Wisata</h6>
                            <h4 class="mb-0 fw-bold">{{ $totalTempatWisata }}</h4>
                            <small class="text-muted">
                                <span class="text-success">{{ $approvedTempatWisata }} Approved</span> | 
                                <span class="text-warning">{{ $pendingTempatWisata }} Pending</span> | 
                                <span class="text-danger">{{ $rejectedTempatWisata }} Rejected</span>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tour Guide Stats -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-info">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-info-subtle rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="ti ti-user-star fs-4 text-info"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Total Tour Guide</h6>
                            <h4 class="mb-0 fw-bold">{{ $totalTourGuide }}</h4>
                            <small class="text-muted">
                                <span class="text-success">{{ $approvedTourGuide }} Approved</span> | 
                                <span class="text-warning">{{ $pendingTourGuide }} Pending</span> | 
                                <span class="text-danger">{{ $rejectedTourGuide }} Rejected</span>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Stats -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-success">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-success-subtle rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="ti ti-users fs-4 text-success"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Total Users</h6>
                            <h4 class="mb-0 fw-bold">{{ $totalUsers }}</h4>
                            <small class="text-muted">
                                Admin: {{ $totalAdmin }} | 
                                Tour Guide: {{ $totalTourGuideUsers }} | 
                                Tempat Wisata: {{ $totalTempatWisataUsers }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Events Stats -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-warning">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-warning-subtle rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="ti ti-calendar-event fs-4 text-warning"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Total Events</h6>
                            <h4 class="mb-0 fw-bold">{{ $totalEvents }}</h4>
                            <small class="text-muted">
                                <span class="text-primary">{{ $upcomingEvents }} Upcoming</span> | 
                                <span class="text-info">{{ $ongoingEvents }} Ongoing</span> | 
                                <span class="text-secondary">{{ $doneEvents }} Done</span>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title fw-semibold mb-4">
                        <i class="ti ti-bolt me-2 text-primary"></i>Quick Actions
                    </h4>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('admin.tempat-wisata.index') }}" class="btn btn-primary w-100">
                                <i class="ti ti-map-pin me-2"></i>Kelola Tempat Wisata
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('admin.tour-guide.index') }}" class="btn btn-info w-100">
                                <i class="ti ti-user-star me-2"></i>Kelola Tour Guide
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-success w-100">
                                <i class="ti ti-users me-2"></i>Kelola Users
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('admin.events.index') }}" class="btn btn-warning w-100">
                                <i class="ti ti-calendar-event me-2"></i>Kelola Events
                            </a>
                        </div>
                    </div>
                    @if($pendingTempatWisata > 0 || $pendingTourGuide > 0)
                        <div class="alert alert-warning mt-3">
                            <h5 class="alert-heading mb-2">
                                <i class="ti ti-alert-triangle me-2"></i>Pending Approvals
                            </h5>
                            @if($pendingTempatWisata > 0)
                                <p class="mb-1">
                                    <strong>{{ $pendingTempatWisata }}</strong> Tempat Wisata menunggu persetujuan
                                    <a href="{{ route('admin.tempat-wisata.index') }}?status=pending" class="btn btn-sm btn-warning ms-2">
                                        Review
                                    </a>
                                </p>
                            @endif
                            @if($pendingTourGuide > 0)
                                <p class="mb-0">
                                    <strong>{{ $pendingTourGuide }}</strong> Tour Guide menunggu persetujuan
                                    <a href="{{ route('admin.tour-guide.index') }}?status=pending" class="btn btn-sm btn-warning ms-2">
                                        Review
                                    </a>
                                </p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="row mt-4">
        <!-- Recent Tempat Wisata -->
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">
                        <i class="ti ti-map-pin me-2 text-primary"></i>Recent Tempat Wisata
                    </h5>
                    @if($recentTempatWisata->isEmpty())
                        <p class="text-muted text-center py-3">Belum ada tempat wisata terdaftar.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama Tempat</th>
                                        <th>Owner</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentTempatWisata as $tempatWisata)
                                        <tr>
                                            <td>{{ \Illuminate\Support\Str::limit($tempatWisata->nama_tempat, 30) }}</td>
                                            <td>{{ $tempatWisata->user->name ?? 'N/A' }}</td>
                                            <td>
                                                <span class="badge bg-{{ $tempatWisata->status == 'approved' ? 'success' : ($tempatWisata->status == 'rejected' ? 'danger' : 'warning') }}">
                                                    {{ ucfirst($tempatWisata->status) }}
                                                </span>
                                            </td>
                                            <td>{{ $tempatWisata->created_at->format('d M Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center mt-3">
                            <a href="{{ route('admin.tempat-wisata.index') }}" class="btn btn-sm btn-outline-primary">
                                Lihat Semua <i class="ti ti-arrow-right ms-1"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recent Tour Guide -->
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">
                        <i class="ti ti-user-star me-2 text-info"></i>Recent Tour Guide
                    </h5>
                    @if($recentTourGuide->isEmpty())
                        <p class="text-muted text-center py-3">Belum ada tour guide terdaftar.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Owner</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentTourGuide as $tourGuide)
                                        <tr>
                                            <td>{{ \Illuminate\Support\Str::limit($tourGuide->nama, 30) }}</td>
                                            <td>{{ $tourGuide->user->name ?? 'N/A' }}</td>
                                            <td>
                                                <span class="badge bg-{{ $tourGuide->status == 'approved' ? 'success' : ($tourGuide->status == 'rejected' ? 'danger' : 'warning') }}">
                                                    {{ ucfirst($tourGuide->status) }}
                                                </span>
                                            </td>
                                            <td>{{ $tourGuide->created_at->format('d M Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center mt-3">
                            <a href="{{ route('admin.tour-guide.index') }}" class="btn btn-sm btn-outline-info">
                                Lihat Semua <i class="ti ti-arrow-right ms-1"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Penjelasan Sistem -->
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title fw-semibold mb-4">
                        <i class="ti ti-info-circle me-2 text-primary"></i>Tentang Dashboard Admin
                    </h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h5 class="fw-semibold mb-3">Fungsi Dashboard Admin</h5>
                                <p class="text-muted">
                                    Dashboard admin adalah pusat kontrol untuk mengelola seluruh sistem GoMinGo. 
                                    Dari sini Anda dapat memonitor statistik, memproses pendaftaran, dan mengelola 
                                    konten platform.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h5 class="fw-semibold mb-3">Fitur Utama</h5>
                                <ul class="text-muted">
                                    <li class="mb-2">
                                        <i class="ti ti-check text-success me-2"></i>
                                        Approve/Reject pendaftaran Tempat Wisata dan Tour Guide
                                    </li>
                                    <li class="mb-2">
                                        <i class="ti ti-check text-success me-2"></i>
                                        Kelola Users dan akses sistem
                                    </li>
                                    <li class="mb-2">
                                        <i class="ti ti-check text-success me-2"></i>
                                        Buat dan kelola Events untuk Tour Guide
                                    </li>
                                    <li class="mb-2">
                                        <i class="ti ti-check text-success me-2"></i>
                                        Monitoring statistik platform
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
@endsection

