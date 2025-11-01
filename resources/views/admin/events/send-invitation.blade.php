@extends('layout.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="card-title fw-semibold mb-0">Kirim Undangan Event</h5>
                        <a href="{{ route('admin.events.show', $event) }}" class="btn btn-secondary">
                            <i class="ti ti-arrow-left me-2"></i>Kembali
                        </a>
                    </div>

                    <div class="alert alert-info mb-4">
                        <h6 class="alert-heading">
                            <i class="ti ti-info-circle me-2"></i>Event: {{ $event->nama_event }}
                        </h6>
                        <p class="mb-0">
                            Pilih Tour Guide yang akan menerima undangan untuk mendaftar event ini.
                        </p>
                    </div>

                    <form action="{{ route('admin.events.send-invitation.store', $event) }}" method="POST">
                        @csrf

                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="selectAll" onchange="toggleAll(this)">
                                    <label class="form-check-label fw-bold" for="selectAll">
                                        Pilih Semua Tour Guide (Approved)
                                    </label>
                                </div>
                                <hr>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="select_all_approved" value="1" id="selectAllApproved">
                                    <label class="form-check-label" for="selectAllApproved">
                                        Kirim ke semua Tour Guide yang sudah Approved
                                    </label>
                                </div>
                            </div>
                        </div>

                        @if($tourGuides->isEmpty())
                            <div class="alert alert-warning">
                                <i class="ti ti-alert-triangle me-2"></i>Tidak ada Tour Guide yang sudah approved.
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th width="50">
                                                <input type="checkbox" class="form-check-input" id="selectAllTable" onchange="toggleAllTable(this)">
                                            </th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Spesialisasi</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tourGuides as $tourGuide)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="tour_guide_ids[]" 
                                                           value="{{ $tourGuide->id }}" 
                                                           class="form-check-input tour-guide-checkbox">
                                                </td>
                                                <td>
                                                    @if($tourGuide->foto)
                                                        <img src="{{ Storage::url($tourGuide->foto) }}" 
                                                             class="rounded-circle" 
                                                             style="width: 40px; height: 40px; object-fit: cover;">
                                                    @else
                                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" 
                                                             style="width: 40px; height: 40px;">
                                                            <i class="ti ti-user text-muted"></i>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <strong>{{ $tourGuide->nama }}</strong>
                                                </td>
                                                <td>
                                                    <span class="badge bg-{{ $tourGuide->spesialisasi == 'alam' ? 'success' : ($tourGuide->spesialisasi == 'kuliner' ? 'warning' : ($tourGuide->spesialisasi == 'budaya' ? 'info' : 'primary')) }}">
                                                        {{ ucfirst($tourGuide->spesialisasi) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <small>{{ $tourGuide->user->email ?? 'N/A' }}</small>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti ti-send me-2"></i>Kirim Undangan
                                </button>
                                <a href="{{ route('admin.events.show', $event) }}" class="btn btn-secondary">
                                    Batal
                                </a>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleAll(checkbox) {
    const checkboxes = document.querySelectorAll('.tour-guide-checkbox');
    checkboxes.forEach(cb => cb.checked = checkbox.checked);
    document.getElementById('selectAllTable').checked = checkbox.checked;
}

function toggleAllTable(checkbox) {
    const checkboxes = document.querySelectorAll('.tour-guide-checkbox');
    checkboxes.forEach(cb => cb.checked = checkbox.checked);
    document.getElementById('selectAll').checked = checkbox.checked;
}

// Auto check jika select all approved di-check
document.getElementById('selectAllApproved').addEventListener('change', function() {
    if (this.checked) {
        const checkboxes = document.querySelectorAll('.tour-guide-checkbox');
        checkboxes.forEach(cb => cb.checked = true);
        document.getElementById('selectAll').checked = true;
        document.getElementById('selectAllTable').checked = true;
    }
});
</script>
@endsection

