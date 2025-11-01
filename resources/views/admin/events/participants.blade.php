@extends('layout.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="card-title fw-semibold mb-0">Pendaftar Event: {{ $event->nama_event }}</h5>
                        <a href="{{ route('admin.events.show', $event) }}" class="btn btn-secondary">
                            <i class="ti ti-arrow-left me-2"></i>Kembali
                        </a>
                    </div>

                    @if($participants->isEmpty())
                        <div class="text-center py-5">
                            <i class="ti ti-users-off fs-1 text-muted"></i>
                            <p class="text-muted mt-3">Belum ada tour guide yang mendaftar event ini.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Nama Tour Guide</th>
                                        <th>Spesialisasi</th>
                                        <th>Kontak</th>
                                        <th>Catatan</th>
                                        <th>Status</th>
                                        <th>Tanggal Daftar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($participants as $participant)
                                        <tr>
                                            <td>
                                                @if($participant->tourGuide->foto)
                                                    <img src="{{ Storage::url($participant->tourGuide->foto) }}" 
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
                                                <strong>{{ $participant->tourGuide->nama }}</strong>
                                            </td>
                                            <td>
                                                <span class="badge bg-{{ $participant->tourGuide->spesialisasi == 'alam' ? 'success' : ($participant->tourGuide->spesialisasi == 'kuliner' ? 'warning' : ($participant->tourGuide->spesialisasi == 'budaya' ? 'info' : 'primary')) }}">
                                                    {{ ucfirst($participant->tourGuide->spesialisasi) }}
                                                </span>
                                            </td>
                                            <td>
                                                <small>{{ $participant->tourGuide->kontak ?: '-' }}</small>
                                            </td>
                                            <td>
                                                <small>{{ $participant->catatan ?: '-' }}</small>
                                            </td>
                                            <td>
                                                <span class="badge bg-{{ $participant->status == 'approved' ? 'success' : ($participant->status == 'rejected' ? 'danger' : 'warning') }}">
                                                    {{ ucfirst($participant->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <small>{{ $participant->created_at->format('d M Y') }}</small>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

