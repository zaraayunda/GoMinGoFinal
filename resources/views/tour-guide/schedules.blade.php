@extends('layout.dashboard')

@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="mb-3">Jadwal Saya</h5>

    @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if (session('error'))   <div class="alert alert-danger">{{ session('error') }}</div> @endif

    <form class="row g-2 mb-4" method="POST" action="{{ route('guide.schedules.store') }}">
      @csrf
      <div class="col-md-3"><input type="datetime-local" name="start_at" class="form-control" required></div>
      <div class="col-md-3"><input type="datetime-local" name="end_at"   class="form-control" required></div>
      <div class="col-md-2">
        <select name="status" class="form-select" required>
          <option value="available">Available</option>
          <option value="booked">Booked</option>
          <option value="blocked">Blocked</option>
        </select>
      </div>
      <div class="col-md-2"><input type="text" name="title" class="form-control" placeholder="Judul (opsional)"></div>
      <div class="col-md-2"><button class="btn btn-primary w-100">Tambah</button></div>
    </form>

    <div class="table-responsive">
      <table class="table table-sm align-middle">
        <thead><tr><th>Mulai</th><th>Selesai</th><th>Status</th><th>Judul</th><th></th></tr></thead>
        <tbody>
          @forelse($schedules as $s)
            <tr>
              <td>{{ $s->start_at->format('d M Y H:i') }}</td>
              <td>{{ $s->end_at->format('d M Y H:i') }}</td>
              <td><span class="badge bg-{{ $s->status=='booked'?'danger':($s->status=='blocked'?'secondary':'success') }}">{{ $s->status }}</span></td>
              <td>{{ $s->title }}</td>
              <td class="text-end">
                <form method="POST" action="{{ route('guide.schedules.destroy',$s->id) }}" onsubmit="return confirm('Hapus?');">
                  @csrf @method('DELETE')
                  <button class="btn btn-outline-danger btn-sm">Hapus</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="5" class="text-muted">Belum ada jadwal.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
