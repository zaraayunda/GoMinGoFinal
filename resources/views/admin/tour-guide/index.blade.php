@extends('layout.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="card-title fw-semibold mb-0">Kelola Tour Guide</h5>
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
                            <form method="GET" action="{{ route('admin.tour-guide.index') }}">
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
                                        <label class="form-label">Spesialisasi</label>
                                        <select name="spesialisasi" class="form-select">
                                            <option value="">Semua Spesialisasi</option>
                                            <option value="alam" {{ request('spesialisasi') == 'alam' ? 'selected' : '' }}>Alam</option>
                                            <option value="kuliner" {{ request('spesialisasi') == 'kuliner' ? 'selected' : '' }}>Kuliner</option>
                                            <option value="budaya" {{ request('spesialisasi') == 'budaya' ? 'selected' : '' }}>Budaya</option>
                                            <option value="campuran" {{ request('spesialisasi') == 'campuran' ? 'selected' : '' }}>Campuran</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Cari</label>
                                        <input type="text" name="search" class="form-control" 
                                               value="{{ request('search') }}" 
                                               placeholder="Cari nama, kontak, atau email owner...">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">&nbsp;</label>
                                        <div class="d-flex gap-2">
                                            <button type="submit" class="btn btn-primary w-100">
                                                <i class="ti ti-filter me-1"></i>Filter
                                            </button>
                                            <a href="{{ route('admin.tour-guide.index') }}" class="btn btn-secondary">
                                                <i class="ti ti-x"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if($tourGuides->isEmpty())
                        <div class="text-center py-5">
                            <i class="ti ti-user-off fs-1 text-muted"></i>
                            <p class="text-muted mt-3">Tidak ada tour guide ditemukan.</p>
                        </div>
                    @else
                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Nama</th>
                                        <th>Owner</th>
                                        <th>Spesialisasi</th>
                                        <th>Status</th>
                                        <th>Tanggal Daftar</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tourGuides as $tourGuide)
                                        <tr>
                                            <td>
                                                @if($tourGuide->foto)
                                                    <img src="{{ Storage::url($tourGuide->foto) }}" 
                                                         class="rounded-circle" 
                                                         style="width: 50px; height: 50px; object-fit: cover;">
                                                @else
                                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" 
                                                         style="width: 50px; height: 50px;">
                                                        <i class="ti ti-user text-muted"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <div>
                                                    <strong>{{ $tourGuide->nama }}</strong>
                                                    @php
                                                        $bahasaDetails = $tourGuide->detailTourGuides->whereNotNull('bahasa');
                                                    @endphp
                                                    @if($bahasaDetails->isNotEmpty())
                                                        <br>
                                                        <small class="text-muted">
                                                            <i class="ti ti-language me-1"></i>
                                                            {{ $bahasaDetails->pluck('bahasa')->take(2)->implode(', ') }}
                                                            @if($bahasaDetails->count() > 2) +{{ $bahasaDetails->count() - 2 }} @endif
                                                        </small>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <strong>{{ $tourGuide->user->name ?? 'N/A' }}</strong>
                                                    <br>
                                                    <small class="text-muted">{{ $tourGuide->user->email ?? 'N/A' }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-{{ $tourGuide->spesialisasi == 'alam' ? 'success' : ($tourGuide->spesialisasi == 'kuliner' ? 'warning' : ($tourGuide->spesialisasi == 'budaya' ? 'info' : 'primary')) }}">
                                                    {{ ucfirst($tourGuide->spesialisasi) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-{{ $tourGuide->status == 'approved' ? 'success' : ($tourGuide->status == 'rejected' ? 'danger' : 'warning') }}">
                                                    {{ ucfirst($tourGuide->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <small>{{ $tourGuide->created_at->format('d M Y') }}</small>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <a href="{{ route('admin.tour-guide.show', $tourGuide) }}" 
                                                       class="btn btn-sm btn-outline-primary" title="View">
                                                        <i class="ti ti-eye"></i>
                                                    </a>
                                                    @if($tourGuide->status == 'pending')
                                                        <form action="{{ route('admin.tour-guide.approve', $tourGuide) }}" 
                                                              method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-outline-success" title="Approve">
                                                                <i class="ti ti-check"></i>
                                                            </button>
                                                        </form>
                                                        <button type="button" class="btn btn-sm btn-outline-danger" 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#rejectModal{{ $tourGuide->id }}" 
                                                                title="Reject">
                                                            <i class="ti ti-x"></i>
                                                        </button>
                                                    @endif
                                                    <form action="{{ route('admin.tour-guide.destroy', $tourGuide) }}" 
                                                          method="POST" class="d-inline"
                                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus tour guide ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                            <i class="ti ti-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>

                                                <!-- Reject Modal -->
                                                <div class="modal fade" id="rejectModal{{ $tourGuide->id }}" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form action="{{ route('admin.tour-guide.reject', $tourGuide) }}" method="POST">
                                                                @csrf
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Tolak Tour Guide</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Apakah Anda yakin ingin menolak tour guide <strong>{{ $tourGuide->nama }}</strong>?</p>
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
                            {{ $tourGuides->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

