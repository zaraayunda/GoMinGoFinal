@extends('layout.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="card-title fw-semibold mb-0">Edit Tempat Wisata</h5>
                        <a href="{{ route('tempat-wisata.index') }}" class="btn btn-secondary">
                            <i class="ti ti-arrow-left me-2"></i>Kembali
                        </a>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('tempat-wisata.update', $tempatWisata) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="nama_tempat" class="form-label">Nama Tempat <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nama_tempat') is-invalid @enderror" 
                                           id="nama_tempat" name="nama_tempat" 
                                           value="{{ old('nama_tempat', $tempatWisata->nama_tempat) }}" maxlength="150" required>
                                    @error('nama_tempat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                                    <select class="form-control @error('kategori') is-invalid @enderror" 
                                            id="kategori" name="kategori" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="alam" {{ old('kategori', $tempatWisata->kategori) == 'alam' ? 'selected' : '' }}>Alam</option>
                                        <option value="kuliner" {{ old('kategori', $tempatWisata->kategori) == 'kuliner' ? 'selected' : '' }}>Kuliner</option>
                                        <option value="budaya" {{ old('kategori', $tempatWisata->kategori) == 'budaya' ? 'selected' : '' }}>Budaya</option>
                                    </select>
                                    @error('kategori')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                              id="deskripsi" name="deskripsi" rows="5" required>{{ old('deskripsi', $tempatWisata->deskripsi) }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                              id="alamat" name="alamat" rows="3" required>{{ old('alamat', $tempatWisata->alamat) }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="latitude" class="form-label">Latitude</label>
                                            <input type="number" step="any" class="form-control @error('latitude') is-invalid @enderror" 
                                                   id="latitude" name="latitude" 
                                                   value="{{ old('latitude', $tempatWisata->latitude) }}" placeholder="-7.7956">
                                            <small class="text-muted">Contoh: -7.7956</small>
                                            @error('latitude')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="longitude" class="form-label">Longitude</label>
                                            <input type="number" step="any" class="form-control @error('longitude') is-invalid @enderror" 
                                                   id="longitude" name="longitude" 
                                                   value="{{ old('longitude', $tempatWisata->longitude) }}" placeholder="110.3695">
                                            <small class="text-muted">Contoh: 110.3695</small>
                                            @error('longitude')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="tiket_masuk" class="form-label">Tiket Masuk (Rp)</label>
                                            <input type="number" step="0.01" min="0" class="form-control @error('tiket_masuk') is-invalid @enderror" 
                                                   id="tiket_masuk" name="tiket_masuk" 
                                                   value="{{ old('tiket_masuk', $tempatWisata->tiket_masuk) }}" placeholder="0">
                                            @error('tiket_masuk')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="kontak" class="form-label">Kontak</label>
                                            <input type="text" class="form-control @error('kontak') is-invalid @enderror" 
                                                   id="kontak" name="kontak" 
                                                   value="{{ old('kontak', $tempatWisata->kontak) }}" maxlength="50" placeholder="081234567890">
                                            @error('kontak')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="jam_buka" class="form-label">Jam Buka</label>
                                    <input type="text" class="form-control @error('jam_buka') is-invalid @enderror" 
                                           id="jam_buka" name="jam_buka" 
                                           value="{{ old('jam_buka', $tempatWisata->jam_buka) }}" maxlength="50" placeholder="08:00 - 17:00">
                                    @error('jam_buka')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="tipe_bukti" class="form-label">Tipe Bukti Kepemilikan</label>
                                    <select class="form-control @error('tipe_bukti') is-invalid @enderror" 
                                            id="tipe_bukti" name="tipe_bukti">
                                        <option value="">Pilih Tipe Bukti</option>
                                        <option value="sertifikat" {{ old('tipe_bukti', $tempatWisata->tipe_bukti) == 'sertifikat' ? 'selected' : '' }}>Sertifikat</option>
                                        <option value="surat_izin" {{ old('tipe_bukti', $tempatWisata->tipe_bukti) == 'surat_izin' ? 'selected' : '' }}>Surat Izin</option>
                                        <option value="akta" {{ old('tipe_bukti', $tempatWisata->tipe_bukti) == 'akta' ? 'selected' : '' }}>Akta</option>
                                        <option value="lainnya" {{ old('tipe_bukti', $tempatWisata->tipe_bukti) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    @error('tipe_bukti')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="bukti_kepemilikan" class="form-label">Bukti Kepemilikan/Surat Izin</label>
                                    @if($tempatWisata->bukti_kepemilikan)
                                        <div class="mb-2">
                                            <div class="alert alert-info">
                                                <div class="d-flex align-items-center">
                                                    @if(pathinfo($tempatWisata->bukti_kepemilikan, PATHINFO_EXTENSION) == 'pdf')
                                                        <i class="ti ti-file-type-pdf fs-4 me-2"></i>
                                                    @else
                                                        <img src="{{ Storage::url($tempatWisata->bukti_kepemilikan) }}" 
                                                             class="img-thumbnail me-2" style="max-width: 100px; max-height: 100px;">
                                                    @endif
                                                    <div class="flex-grow-1">
                                                        <strong>File Saat Ini</strong>
                                                        <small class="d-block text-muted">Tipe: {{ ucfirst(str_replace('_', ' ', $tempatWisata->tipe_bukti ?? '-')) }}</small>
                                                        <a href="{{ Storage::url($tempatWisata->bukti_kepemilikan) }}" 
                                                           target="_blank" class="btn btn-sm btn-outline-primary mt-1">
                                                            <i class="ti ti-eye me-1"></i>Lihat
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <small class="text-muted d-block mb-2">Upload file baru untuk mengganti (opsional)</small>
                                    @endif
                                    <input type="file" class="form-control @error('bukti_kepemilikan') is-invalid @enderror" 
                                           id="bukti_kepemilikan" name="bukti_kepemilikan" 
                                           accept=".pdf,.jpg,.jpeg,.png">
                                    <small class="text-muted">Upload file PDF, JPG, JPEG, atau PNG (Max 10MB)</small>
                                    <div id="bukti-preview" class="mt-2"></div>
                                    @error('bukti_kepemilikan')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Foto yang Sudah Ada</label>
                                    <div class="row g-2" id="existing-photos">
                                        @foreach($tempatWisata->photos as $photo)
                                            <div class="col-6 position-relative existing-photo-item" data-photo-id="{{ $photo->id }}">
                                                <img src="{{ Storage::url($photo->file_path) }}" 
                                                     class="img-thumbnail w-100" 
                                                     style="height: 100px; object-fit: cover; cursor: pointer;"
                                                     data-bs-toggle="modal" 
                                                     data-bs-target="#photoModal{{ $photo->id }}">
                                                <button type="button" 
                                                        class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1"
                                                        onclick="deletePhoto({{ $photo->id }})">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                                @if($photo->keterangan)
                                                    <small class="d-block text-muted mt-1">{{ $photo->keterangan }}</small>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>

                                    @if($tempatWisata->photos->isEmpty())
                                        <p class="text-muted small">Belum ada foto</p>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Tambah Foto Baru</label>
                                    <div id="photo-inputs-container">
                                        <div class="mb-2 photo-input-wrapper">
                                            <input type="file" class="form-control photo-input @error('photos.*') is-invalid @enderror" 
                                                   name="photos[]" accept="image/*" onchange="handlePhotoSelect(this)">
                                            <small class="text-muted d-block">Pilih foto (Max 5MB, format: JPG, PNG, GIF)</small>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="addPhotoInput()">
                                        <i class="ti ti-plus me-1"></i>Tambah Input Foto Lagi
                                    </button>
                                    <small class="text-muted d-block mt-2">Anda bisa menambah input foto berkali-kali untuk upload banyak foto</small>
                                    @error('photos.*')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror

                                    <div id="photo-preview" class="mt-3 row g-2"></div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('tempat-wisata.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-save me-2"></i>Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let photoIndex = 0;

function deletePhoto(photoId) {
    if (confirm('Apakah Anda yakin ingin menghapus foto ini?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/tempat-wisata/photo/${photoId}`;
        
        const csrf = document.createElement('input');
        csrf.type = 'hidden';
        csrf.name = '_token';
        csrf.value = '{{ csrf_token() }}';
        
        const method = document.createElement('input');
        method.type = 'hidden';
        method.name = '_method';
        method.value = 'DELETE';
        
        form.appendChild(csrf);
        form.appendChild(method);
        document.body.appendChild(form);
        form.submit();
    }
}

function addPhotoInput() {
    const container = document.getElementById('photo-inputs-container');
    const newInputWrapper = document.createElement('div');
    newInputWrapper.className = 'mb-2 photo-input-wrapper';
    newInputWrapper.innerHTML = `
        <div class="input-group">
            <input type="file" class="form-control photo-input" 
                   name="photos[]" accept="image/*" onchange="handlePhotoSelect(this)">
            <button type="button" class="btn btn-outline-danger" onclick="removePhotoInput(this)">
                <i class="ti ti-x"></i>
            </button>
        </div>
        <small class="text-muted">Pilih foto (Max 5MB, format: JPG, PNG, GIF)</small>
    `;
    container.appendChild(newInputWrapper);
}

function removePhotoInput(button) {
    const wrapper = button.closest('.photo-input-wrapper');
    const input = wrapper.querySelector('.photo-input');
    const file = input.files[0];
    
    // Hapus preview jika ada
    if (file) {
        const previewDiv = document.querySelector(`[data-file-name="${file.name}"]`);
        if (previewDiv) {
            previewDiv.remove();
        }
    }
    
    wrapper.remove();
}

function handlePhotoSelect(input) {
    const file = input.files[0];
    if (!file) return;
    
    if (!file.type.startsWith('image/')) {
        alert('File harus berupa gambar!');
        input.value = '';
        return;
    }
    
    if (file.size > 5 * 1024 * 1024) {
        alert('Ukuran file maksimal 5MB!');
        input.value = '';
        return;
    }
    
    const reader = new FileReader();
    reader.onload = function(e) {
        const previewContainer = document.getElementById('photo-preview');
        const index = photoIndex++;
        
        const div = document.createElement('div');
        div.className = 'col-6 col-md-4 position-relative';
        div.setAttribute('data-file-name', file.name);
        div.innerHTML = `
            <div class="position-relative">
                <img src="${e.target.result}" class="img-thumbnail w-100" 
                     style="height: 150px; object-fit: cover;">
                <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1" 
                        onclick="removePhotoPreview(this, '${file.name}')">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <input type="text" name="photo_keterangan[${index}]" 
                   class="form-control form-control-sm mt-1" 
                   placeholder="Keterangan foto">
            <input type="hidden" name="photo_file_name[${index}]" value="${file.name}">
        `;
        previewContainer.appendChild(div);
    };
    reader.readAsDataURL(file);
}

function removePhotoPreview(button, fileName) {
    const previewDiv = button.closest('[data-file-name]');
    previewDiv.remove();
    
    // Reset input file yang terkait
    const inputs = document.querySelectorAll('.photo-input');
    inputs.forEach(input => {
        if (input.files[0] && input.files[0].name === fileName) {
            input.value = '';
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    // Inisialisasi
    photoIndex = 0;

    // Preview bukti kepemilikan
    const buktiInput = document.getElementById('bukti_kepemilikan');
    const buktiPreview = document.getElementById('bukti-preview');
    
    if (buktiInput) {
        buktiInput.addEventListener('change', function(e) {
            buktiPreview.innerHTML = '';
            const file = e.target.files[0];
            
            if (file) {
                if (file.size > 10 * 1024 * 1024) {
                    alert('Ukuran file maksimal 10MB!');
                    e.target.value = '';
                    return;
                }
                
                if (file.type === 'application/pdf') {
                    buktiPreview.innerHTML = `
                        <div class="alert alert-warning d-flex align-items-center">
                            <i class="ti ti-file-type-pdf fs-4 me-2"></i>
                            <div>
                                <strong>${file.name}</strong> <span class="badge bg-warning">File Baru</span>
                                <small class="d-block text-muted">${(file.size / 1024 / 1024).toFixed(2)} MB</small>
                            </div>
                        </div>
                    `;
                } else if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        buktiPreview.innerHTML = `
                            <div class="alert alert-warning">
                                <img src="${e.target.result}" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                <div class="mt-2">
                                    <strong>${file.name}</strong> <span class="badge bg-warning">File Baru</span>
                                    <small class="d-block text-muted">${(file.size / 1024 / 1024).toFixed(2)} MB</small>
                                </div>
                            </div>
                        `;
                    };
                    reader.readAsDataURL(file);
                }
            }
        });
    }
});
</script>
@endsection
