@extends('layout.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="card-title fw-semibold mb-0">Kelola Tempat Wisata</h5>
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

                    <!-- Filters -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <form method="GET" action="{{ route('admin.tempat-wisata.index') }}">
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-select">
                                            <option value="">Semua Status</option>
                                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Kategori</label>
                                        <select name="kategori" class="form-select">
                                            <option value="">Semua Kategori</option>
                                            <option value="alam" {{ request('kategori') == 'alam' ? 'selected' : '' }}>Alam</option>
                                            <option value="kuliner" {{ request('kategori') == 'kuliner' ? 'selected' : '' }}>Kuliner</option>
                                            <option value="budaya" {{ request('kategori') == 'budaya' ? 'selected' : '' }}>Budaya</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Cari</label>
                                        <input type="text" name="search" class="form-control" 
                                               value="{{ request('search') }}" 
                                               placeholder="Cari nama tempat, alamat, atau owner...">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">&nbsp;</label>
                                        <div class="d-flex gap-2">
                                            <button type="submit" class="btn btn-primary w-100">
                                                <i class="ti ti-filter me-1"></i>Filter
                                            </button>
                                            <a href="{{ route('admin.tempat-wisata.index') }}" class="btn btn-secondary">
                                                <i class="ti ti-x"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if($tempatWisatas->isEmpty())
                        <div class="text-center py-5">
                            <i class="ti ti-map-pin-off fs-1 text-muted"></i>
                            <p class="text-muted mt-3">Tidak ada tempat wisata ditemukan.</p>
                        </div>
                    @else
                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama Tempat</th>
                                        <th>Owner</th>
                                        <th>Kategori</th>
                                        <th>Status</th>
                                        <th>Tanggal Daftar</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tempatWisatas as $tempatWisata)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($tempatWisata->photos->first())
                                                        <img src="{{ Storage::url($tempatWisata->photos->first()->file_path) }}" 
                                                             class="rounded me-2" 
                                                             style="width: 50px; height: 50px; object-fit: cover;">
                                                    @endif
                                                    <div>
                                                        <strong>{{ $tempatWisata->nama_tempat }}</strong>
                                                        <br>
                                                        <small class="text-muted">{{ \Illuminate\Support\Str::limit($tempatWisata->alamat, 40) }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <strong>{{ $tempatWisata->user->name ?? 'N/A' }}</strong>
                                                    <br>
                                                    <small class="text-muted">{{ $tempatWisata->user->email ?? 'N/A' }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-{{ $tempatWisata->kategori == 'alam' ? 'success' : ($tempatWisata->kategori == 'kuliner' ? 'warning' : 'info') }}">
                                                    {{ ucfirst($tempatWisata->kategori) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-{{ $tempatWisata->status == 'approved' ? 'success' : ($tempatWisata->status == 'rejected' ? 'danger' : 'warning') }}">
                                                    {{ ucfirst($tempatWisata->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <small>{{ $tempatWisata->created_at->format('d M Y') }}</small>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <a href="{{ route('admin.tempat-wisata.show', $tempatWisata) }}" 
                                                       class="btn btn-sm btn-outline-primary" title="View">
                                                        <i class="ti ti-eye"></i>
                                                    </a>
                                                    @if($tempatWisata->status == 'pending')
                                                        <form action="{{ route('admin.tempat-wisata.approve', $tempatWisata) }}" 
                                                              method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-outline-success" title="Approve">
                                                                <i class="ti ti-check"></i>
                                                            </button>
                                                        </form>
                                                        <button type="button" class="btn btn-sm btn-outline-danger" 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#rejectModal{{ $tempatWisata->id }}" 
                                                                title="Reject">
                                                            <i class="ti ti-x"></i>
                                                        </button>
                                                    @endif
                                                    <form action="{{ route('admin.tempat-wisata.destroy', $tempatWisata) }}" 
                                                          method="POST" class="d-inline"
                                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus tempat wisata ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                            <i class="ti ti-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>

                                                <!-- Reject Modal -->
                                                <div class="modal fade" id="rejectModal{{ $tempatWisata->id }}" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form action="{{ route('admin.tempat-wisata.reject', $tempatWisata) }}" method="POST">
                                                                @csrf
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Tolak Tempat Wisata</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Apakah Anda yakin ingin menolak tempat wisata <strong>{{ $tempatWisata->nama_tempat }}</strong>?</p>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Alasan Penolakan (Opsional)</label>
                                                                        <textarea name="reason" class="form-control" rows="3" 
                                                                                  placeholder="Masukkan alasan penolakan..."></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-danger">Tolak</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-3">
                            {{ $tempatWisatas->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

