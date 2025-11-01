@extends('layout.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="card-title fw-semibold mb-0">Detail Profil Tour Guide</h5>
                        <div>
                            @if($tourGuide->status == 'pending')
                                <form action="{{ route('admin.tour-guide.approve', $tourGuide) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success">
                                        <i class="ti ti-check me-2"></i>Approve
                                    </button>
                                </form>
                                <button type="button" class="btn btn-danger" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#rejectModal">
                                    <i class="ti ti-x me-2"></i>Reject
                                </button>
                            @endif
                           
                            <a href="{{ route('admin.tour-guide.index') }}" class="btn btn-secondary">
                                <i class="ti ti-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="text-center mb-4">
                                @if($tourGuide->foto)
                                    <img src="{{ Storage::url($tourGuide->foto) }}" 
                                         class="img-fluid rounded-circle mb-3" 
                                         alt="{{ $tourGuide->nama }}" 
                                         style="width: 200px; height: 200px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                         style="width: 200px; height: 200px;">
                                        <i class="ti ti-user fs-1 text-muted"></i>
                                    </div>
                                @endif
                                <h2>{{ $tourGuide->nama }}</h2>
                                <div class="mb-3">
                                    <span class="badge bg-{{ $tourGuide->spesialisasi == 'alam' ? 'success' : ($tourGuide->spesialisasi == 'kuliner' ? 'warning' : ($tourGuide->spesialisasi == 'budaya' ? 'info' : 'primary')) }} me-2">
                                        {{ ucfirst($tourGuide->spesialisasi) }}
                                    </span>
                                    <span class="badge bg-{{ $tourGuide->status == 'approved' ? 'success' : ($tourGuide->status == 'rejected' ? 'danger' : 'warning') }}">
                                        {{ ucfirst($tourGuide->status) }}
                                    </span>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h5>Owner</h5>
                                <p class="text-muted">
                                    <strong>Nama:</strong> {{ $tourGuide->user->name ?? 'N/A' }}<br>
                                    <strong>Email:</strong> {{ $tourGuide->user->email ?? 'N/A' }}
                                </p>
                            </div>

                            @if($tourGuide->pengalaman)
                                <div class="mb-4">
                                    <h5>Pengalaman</h5>
                                    <p class="text-muted">{{ $tourGuide->pengalaman }}</p>
                                </div>
                            @endif

                            <div class="row mb-4">
                                <div class="col-md-12 mb-3">
                                    <h6><i class="ti ti-language me-2"></i>Bahasa yang Dikuasai</h6>
                                    @php
                                        $bahasaDetails = $tourGuide->detailTourGuides->whereNotNull('bahasa');
                                    @endphp
                                    @if($bahasaDetails->isNotEmpty())
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach($bahasaDetails as $detail)
                                                <span class="badge bg-primary">{{ $detail->bahasa }}</span>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-muted">-</p>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <h6><i class="ti ti-phone me-2"></i>Kontak</h6>
                                    <p class="text-muted">{{ $tourGuide->kontak ?: '-' }}</p>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h6><i class="ti ti-certificate me-2"></i>Sertifikat Keahlian</h6>
                                @php
                                    $sertifikatDetails = $tourGuide->detailTourGuides->whereNotNull('sertifikat');
                                @endphp
                                @if($sertifikatDetails->isNotEmpty())
                                    <div class="row g-2">
                                        @foreach($sertifikatDetails as $detail)
                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center mb-2">
                                                            @if(pathinfo($detail->sertifikat, PATHINFO_EXTENSION) == 'pdf')
                                                                <i class="ti ti-file-type-pdf fs-3 text-danger me-2"></i>
                                                            @else
                                                                <img src="{{ Storage::url($detail->sertifikat) }}" 
                                                                     class="img-thumbnail me-2" style="max-width: 80px; max-height: 80px;">
                                                            @endif
                                                            <div class="flex-grow-1">
                                                                @if($detail->sertifikat_nama)
                                                                    <strong class="d-block">{{ $detail->sertifikat_nama }}</strong>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <a href="{{ Storage::url($detail->sertifikat) }}" 
                                                           target="_blank" class="btn btn-sm btn-primary w-100">
                                                            <i class="ti ti-eye me-1"></i>Lihat Sertifikat
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-muted">Belum ada sertifikat</p>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Informasi Profil</h6>
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <i class="ti ti-calendar me-2"></i>
                                            <strong>Dibuat:</strong> {{ $tourGuide->created_at->format('d M Y') }}
                                        </li>
                                        <li class="mb-2">
                                            <i class="ti ti-edit me-2"></i>
                                            <strong>Diupdate:</strong> {{ $tourGuide->updated_at->format('d M Y') }}
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

<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1">
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
@endsection

