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
              <table class="table table-hover align-middle">
                <thead>
                  <tr>
                    <th>Foto</th>
                    <th>Nama Tour Guide</th>
                    <th>Spesialisasi</th>
                    <th>Kontak</th>
                    <th>Catatan</th>
                    <th>Status</th>
                    <th>Tanggal Daftar</th>
                    <th class="text-end">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($participants as $participant)
                    @php
                      $tg = $participant->tourGuide; // relasi wajib ada
                    @endphp
                    <tr>
                      <td>
                        @if($tg && $tg->foto)
                          <img src="{{ Storage::url($tg->foto) }}" class="rounded-circle" style="width:50px;height:50px;object-fit:cover;">
                        @else
                          <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width:50px;height:50px;">
                            <i class="ti ti-user text-muted"></i>
                          </div>
                        @endif
                      </td>
                      <td><strong>{{ $tg ? $tg->nama : '-' }}</strong></td>
                      <td>
                        @php
                          $spe = $tg ? ($tg->spesialisasi ?? '-') : '-';
                          $speClass = 'primary';
                          if ($spe === 'alam') $speClass = 'success';
                          elseif ($spe === 'kuliner') $speClass = 'warning';
                          elseif ($spe === 'budaya') $speClass = 'info';
                        @endphp
                        <span class="badge bg-{{ $speClass }}">{{ ucfirst($spe) }}</span>
                      </td>
                      <td><small>{{ $tg ? ($tg->kontak ?: '-') : '-' }}</small></td>
                      <td><small>{{ $participant->catatan ?: '-' }}</small></td>
                      <td>
                        @php
                          $st = $participant->status;
                          $stClass = $st === 'approved' ? 'success' : ($st === 'rejected' ? 'danger' : 'warning');
                        @endphp
                        <span class="badge bg-{{ $stClass }}">{{ ucfirst($st) }}</span>
                      </td>
                      <td><small>{{ optional($participant->created_at)->format('d M Y') }}</small></td>
                      <td class="text-end">
                        @if($participant->status !== 'approved')
                          <form class="d-inline" method="POST"
                                action="{{ route('admin.events.participants.approve', [$event->id, $participant->id]) }}">
                            @csrf
                            <button class="btn btn-sm btn-success rounded-pill">
                              <i class="ti ti-check"></i> Approve
                            </button>
                          </form>
                        @endif

                        @if($participant->status !== 'rejected')
                          <form class="d-inline" method="POST"
                                action="{{ route('admin.events.participants.reject', [$event->id, $participant->id]) }}">
                            @csrf
                            <button class="btn btn-sm btn-outline-danger rounded-pill">
                              <i class="ti ti-x"></i> Reject
                            </button>
                          </form>
                        @endif
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
