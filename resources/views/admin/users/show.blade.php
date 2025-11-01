@extends('layout.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="card-title fw-semibold mb-0">Detail User</h5>
                        <div>
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning">
                                <i class="ti ti-edit me-2"></i>Edit
                            </a>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                                <i class="ti ti-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="text-center mb-4">
                                @if($user->photo)
                                    <img src="{{ Storage::url($user->photo) }}" 
                                         class="img-fluid rounded-circle mb-3" 
                                         alt="{{ $user->name }}" 
                                         style="width: 150px; height: 150px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                         style="width: 150px; height: 150px;">
                                        <i class="ti ti-user fs-1 text-muted"></i>
                                    </div>
                                @endif
                                <h2>{{ $user->name }}</h2>
                                <div class="mb-3">
                                    <span class="badge bg-{{ $user->role == 'admin' ? 'danger' : ($user->role == 'tour_guide' ? 'info' : 'success') }}">
                                        {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                                    </span>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h5>Informasi User</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Nama:</strong> {{ $user->name }}</p>
                                        <p><strong>Email:</strong> {{ $user->email }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Role:</strong> {{ ucfirst(str_replace('_', ' ', $user->role)) }}</p>
                                        <p><strong>Email Verified:</strong> 
                                            @if($user->email_verified_at)
                                                <span class="badge bg-success">{{ $user->email_verified_at->format('d M Y') }}</span>
                                            @else
                                                <span class="badge bg-warning">Belum diverifikasi</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Related Data -->
                            @if($user->role == 'tempat_wisata' && $tempatWisata)
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="ti ti-map-pin me-2"></i>Tempat Wisata Terkait
                                        </h5>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>{{ $tempatWisata->nama_tempat }}</strong>
                                                <br>
                                                <small class="text-muted">{{ $tempatWisata->kategori }} | {{ ucfirst($tempatWisata->status) }}</small>
                                            </div>
                                            <a href="{{ route('admin.tempat-wisata.show', $tempatWisata) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="ti ti-eye me-1"></i>Lihat
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($user->role == 'tour_guide' && $tourGuide)
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="ti ti-user-star me-2"></i>Tour Guide Terkait
                                        </h5>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>{{ $tourGuide->nama }}</strong>
                                                <br>
                                                <small class="text-muted">{{ $tourGuide->spesialisasi }} | {{ ucfirst($tourGuide->status) }}</small>
                                            </div>
                                            <a href="{{ route('admin.tour-guide.show', $tourGuide) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="ti ti-eye me-1"></i>Lihat
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Informasi Akun</h6>
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <i class="ti ti-calendar me-2"></i>
                                            <strong>Dibuat:</strong> {{ $user->created_at->format('d M Y H:i') }}
                                        </li>
                                        <li class="mb-2">
                                            <i class="ti ti-edit me-2"></i>
                                            <strong>Diupdate:</strong> {{ $user->updated_at->format('d M Y H:i') }}
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="card mt-3">
                                <div class="card-body">
                                    <h6 class="card-title">Actions</h6>
                                    <form action="{{ route('admin.users.reset-password', $user) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Reset password untuk user ini? Password baru akan ditampilkan setelah reset.');">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-secondary w-100 mb-2">
                                            <i class="ti ti-key me-1"></i>Reset Password
                                        </button>
                                    </form>
                                    @if($user->id !== Auth::id())
                                        <form action="{{ route('admin.users.destroy', $user) }}" 
                                              method="POST"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini? Ini akan menghapus semua data terkait.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger w-100">
                                                <i class="ti ti-trash me-1"></i>Hapus User
                                            </button>
                                        </form>
                                    @else
                                        <button class="btn btn-sm btn-secondary w-100" disabled>
                                            <i class="ti ti-info-circle me-1"></i>Tidak dapat menghapus akun sendiri
                                        </button>
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

