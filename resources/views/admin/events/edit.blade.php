@extends('layout.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="card-title fw-semibold mb-0">Edit Event</h5>
                        <a href="{{ route('admin.events.show', $event) }}" class="btn btn-secondary">
                            <i class="ti ti-arrow-left me-2"></i>Kembali
                        </a>
                    </div>

                    <form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label">Nama Event <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_event" class="form-control @error('nama_event') is-invalid @enderror" 
                                           value="{{ old('nama_event', $event->nama_event) }}" required>
                                    @error('nama_event')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                                    <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" 
                                              rows="5" required>{{ old('deskripsi', $event->deskripsi) }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                                            <input type="date" name="tanggal_mulai" class="form-control @error('tanggal_mulai') is-invalid @enderror" 
                                                   value="{{ old('tanggal_mulai', $event->tanggal_mulai) }}" required>
                                            @error('tanggal_mulai')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Tanggal Selesai</label>
                                            <input type="date" name="tanggal_selesai" class="form-control @error('tanggal_selesai') is-invalid @enderror" 
                                                   value="{{ old('tanggal_selesai', $event->tanggal_selesai) }}">
                                            @error('tanggal_selesai')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Lokasi <span class="text-danger">*</span></label>
                                    <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror" 
                                           value="{{ old('lokasi', $event->lokasi) }}" required>
                                    @error('lokasi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Latitude</label>
                                            <input type="number" step="any" name="latitude" class="form-control @error('latitude') is-invalid @enderror" 
                                                   value="{{ old('latitude', $event->latitude) }}">
                                            @error('latitude')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Longitude</label>
                                            <input type="number" step="any" name="longitude" class="form-control @error('longitude') is-invalid @enderror" 
                                                   value="{{ old('longitude', $event->longitude) }}">
                                            @error('longitude')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Status <span class="text-danger">*</span></label>
                                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                        <option value="">Pilih Status</option>
                                        <option value="upcoming" {{ old('status', $event->status) == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                                        <option value="ongoing" {{ old('status', $event->status) == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                        <option value="done" {{ old('status', $event->status) == 'done' ? 'selected' : '' }}>Done</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Foto Utama</label>
                                    <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" 
                                           accept="image/*">
                                    @error('foto')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @if($event->foto)
                                        <small class="text-muted">Foto saat ini: <a href="{{ Storage::url($event->foto) }}" target="_blank">Lihat</a></small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Foto Tambahan</label>
                                    <input type="file" name="photos[]" class="form-control @error('photos.*') is-invalid @enderror" 
                                           accept="image/*" multiple>
                                    <small class="text-muted">Anda dapat memilih multiple foto</small>
                                    @error('photos.*')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                @if($event->photos->count() > 0)
                                    <div class="mb-3">
                                        <label class="form-label">Foto Saat Ini</label>
                                        <div class="row g-2">
                                            @foreach($event->photos as $photo)
                                                <div class="col-md-3">
                                                    <div class="position-relative">
                                                        <img src="{{ Storage::url($photo->file_path) }}" 
                                                             class="img-fluid rounded" 
                                                             style="height: 100px; width: 100%; object-fit: cover;">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ti ti-check me-2"></i>Update Event
                                    </button>
                                    <a href="{{ route('admin.events.show', $event) }}" class="btn btn-secondary">
                                        Batal
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

