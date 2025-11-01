@extends('layout.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="card-title fw-semibold mb-0">Edit Profil Tour Guide</h5>
                        <a href="{{ route('tour-guide.index') }}" class="btn btn-secondary">
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

                    <form action="{{ route('tour-guide.update', $tourGuide) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                           id="nama" name="nama" 
                                           value="{{ old('nama', $tourGuide->nama) }}" maxlength="150" required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="spesialisasi" class="form-label">Spesialisasi <span class="text-danger">*</span></label>
                                    <select class="form-control @error('spesialisasi') is-invalid @enderror" 
                                            id="spesialisasi" name="spesialisasi" required>
                                        <option value="">Pilih Spesialisasi</option>
                                        <option value="alam" {{ old('spesialisasi', $tourGuide->spesialisasi) == 'alam' ? 'selected' : '' }}>Alam</option>
                                        <option value="kuliner" {{ old('spesialisasi', $tourGuide->spesialisasi) == 'kuliner' ? 'selected' : '' }}>Kuliner</option>
                                        <option value="budaya" {{ old('spesialisasi', $tourGuide->spesialisasi) == 'budaya' ? 'selected' : '' }}>Budaya</option>
                                        <option value="campuran" {{ old('spesialisasi', $tourGuide->spesialisasi) == 'campuran' ? 'selected' : '' }}>Campuran</option>
                                    </select>
                                    @error('spesialisasi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="pengalaman" class="form-label">Pengalaman</label>
                                    <textarea class="form-control @error('pengalaman') is-invalid @enderror" 
                                              id="pengalaman" name="pengalaman" rows="5" 
                                              placeholder="Jelaskan pengalaman Anda sebagai tour guide...">{{ old('pengalaman', $tourGuide->pengalaman) }}</textarea>
                                    @error('pengalaman')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="kontak" class="form-label">Kontak</label>
                                    <input type="text" class="form-control @error('kontak') is-invalid @enderror" 
                                           id="kontak" name="kontak" 
                                           value="{{ old('kontak', $tourGuide->kontak) }}" maxlength="50" 
                                           placeholder="081234567890">
                                    @error('kontak')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Bahasa yang Dikuasai</label>
                                    <div id="bahasa-inputs-container">
                                        @php
                                            $bahasaDetails = $tourGuide->detailTourGuides->whereNotNull('bahasa');
                                        @endphp
                                        @if($bahasaDetails->isNotEmpty())
                                            @foreach($bahasaDetails as $detail)
                                                <div class="mb-2 bahasa-input-wrapper">
                                                    <div class="input-group">
                                                        <input type="hidden" name="detail_id[]" value="{{ $detail->id }}">
                                                        <input type="text" class="form-control bahasa-input" 
                                                               name="bahasa[]" 
                                                               value="{{ old('bahasa.'.$loop->index, $detail->bahasa) }}" 
                                                               placeholder="Contoh: Indonesia, English, Mandarin" 
                                                               maxlength="100">
                                                        <button type="button" class="btn btn-outline-danger" onclick="removeBahasaInput(this)">
                                                            <i class="ti ti-x"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="mb-2 bahasa-input-wrapper">
                                                <div class="input-group">
                                                    <input type="hidden" name="detail_id[]" value="">
                                                    <input type="text" class="form-control bahasa-input" 
                                                           name="bahasa[]" 
                                                           placeholder="Contoh: Indonesia, English, Mandarin" 
                                                           maxlength="100">
                                                    <button type="button" class="btn btn-outline-danger" onclick="removeBahasaInput(this)">
                                                        <i class="ti ti-x"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="addBahasaInput()">
                                        <i class="ti ti-plus me-1"></i>Tambah Bahasa Lagi
                                    </button>
                                    <small class="text-muted d-block mt-2">Anda bisa menambah bahasa berkali-kali</small>
                                    @error('bahasa.*')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Sertifikat Keahlian yang Sudah Ada</label>
                                    @php
                                        $sertifikatDetails = $tourGuide->detailTourGuides->whereNotNull('sertifikat');
                                    @endphp
                                    @if($sertifikatDetails->isNotEmpty())
                                        <div class="row g-2 mb-3" id="existing-sertifikat">
                                            @foreach($sertifikatDetails as $detail)
                                                <div class="col-6 col-md-4 position-relative existing-sertifikat-item" data-detail-id="{{ $detail->id }}">
                                                    <div class="alert alert-info p-2 position-relative">
                                                        @if(pathinfo($detail->sertifikat, PATHINFO_EXTENSION) == 'pdf')
                                                            <i class="ti ti-file-type-pdf fs-3 text-danger mb-2 d-block"></i>
                                                        @else
                                                            <img src="{{ Storage::url($detail->sertifikat) }}" 
                                                                 class="img-thumbnail w-100 mb-2" 
                                                                 style="height: 100px; object-fit: cover;">
                                                        @endif
                                                        @if($detail->sertifikat_nama)
                                                            <strong class="small d-block">{{ $detail->sertifikat_nama }}</strong>
                                                        @endif
                                                        <a href="{{ Storage::url($detail->sertifikat) }}" 
                                                           target="_blank" class="btn btn-sm btn-outline-primary w-100 mt-1">
                                                            <i class="ti ti-eye me-1"></i>Lihat
                                                        </a>
                                                        <label class="form-check-label mt-2 d-block">
                                                            <input type="checkbox" name="delete_detail[]" value="{{ $detail->id }}" class="form-check-input">
                                                            <small class="text-danger">Hapus</small>
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-muted small mb-3">Belum ada sertifikat</p>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Tambah Sertifikat Baru</label>
                                    <div id="sertifikat-inputs-container">
                                        <div class="mb-2 sertifikat-input-wrapper">
                                            <div class="input-group mb-2">
                                                <input type="file" class="form-control sertifikat-input" 
                                                       name="sertifikat[]" 
                                                       accept=".pdf,.jpg,.jpeg,.png" 
                                                       onchange="handleSertifikatSelect(this, 0)">
                                                <button type="button" class="btn btn-outline-danger" onclick="removeSertifikatInput(this, 0)">
                                                    <i class="ti ti-x"></i>
                                                </button>
                                            </div>
                                            <input type="text" class="form-control form-control-sm" 
                                                   name="sertifikat_nama[]" 
                                                   placeholder="Nama sertifikat (opsional)" 
                                                   maxlength="150">
                                            <small class="text-muted d-block">Upload file PDF, JPG, JPEG, atau PNG (Max 10MB)</small>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="addSertifikatInput()">
                                        <i class="ti ti-plus me-1"></i>Tambah Sertifikat Lagi
                                    </button>
                                    <small class="text-muted d-block mt-2">Anda bisa menambah sertifikat berkali-kali</small>
                                    <div id="sertifikat-preview" class="mt-3 row g-2"></div>
                                    @error('sertifikat.*')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="foto" class="form-label">Foto Profil</label>
                                    @if($tourGuide->foto)
                                        <div class="mb-2">
                                            <div class="alert alert-info">
                                                <strong>Foto Saat Ini:</strong>
                                                <img src="{{ Storage::url($tourGuide->foto) }}" 
                                                     class="img-thumbnail w-100 mt-2" 
                                                     style="height: 200px; object-fit: cover;">
                                                <div>
                                                    <a href="{{ Storage::url($tourGuide->foto) }}" 
                                                       target="_blank" class="btn btn-sm btn-outline-primary mt-2">
                                                        <i class="ti ti-eye me-1"></i>Lihat
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <small class="text-muted d-block mb-2">Upload file baru untuk mengganti (opsional)</small>
                                    @endif
                                    <input type="file" class="form-control @error('foto') is-invalid @enderror" 
                                           id="foto" name="foto" 
                                           accept="image/*">
                                    <small class="text-muted">Upload foto profil (Max 5MB, format: JPG, PNG, GIF)</small>
                                    <div id="foto-preview" class="mt-3"></div>
                                    @error('foto')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('tour-guide.index') }}" class="btn btn-secondary">Batal</a>
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
let bahasaIndex = 0;
let sertifikatIndex = {{ $tourGuide->detailTourGuides->whereNotNull('sertifikat')->count() ?? 0 }};

function addBahasaInput() {
    const container = document.getElementById('bahasa-inputs-container');
    const newInputWrapper = document.createElement('div');
    newInputWrapper.className = 'mb-2 bahasa-input-wrapper';
    newInputWrapper.innerHTML = `
        <div class="input-group">
            <input type="hidden" name="detail_id[]" value="">
            <input type="text" class="form-control bahasa-input" 
                   name="bahasa[]" 
                   placeholder="Contoh: Indonesia, English, Mandarin" 
                   maxlength="100">
            <button type="button" class="btn btn-outline-danger" onclick="removeBahasaInput(this)">
                <i class="ti ti-x"></i>
            </button>
        </div>
    `;
    container.appendChild(newInputWrapper);
}

function removeBahasaInput(button) {
    button.closest('.bahasa-input-wrapper').remove();
}

function addSertifikatInput() {
    const container = document.getElementById('sertifikat-inputs-container');
    const index = sertifikatIndex++;
    const newInputWrapper = document.createElement('div');
    newInputWrapper.className = 'mb-2 sertifikat-input-wrapper';
    newInputWrapper.innerHTML = `
        <div class="input-group mb-2">
            <input type="file" class="form-control sertifikat-input" 
                   name="sertifikat[]" 
                   accept=".pdf,.jpg,.jpeg,.png" 
                   onchange="handleSertifikatSelect(this, ${index})">
            <button type="button" class="btn btn-outline-danger" onclick="removeSertifikatInput(this, ${index})">
                <i class="ti ti-x"></i>
            </button>
        </div>
        <input type="text" class="form-control form-control-sm" 
               name="sertifikat_nama[]" 
               placeholder="Nama sertifikat (opsional)" 
               maxlength="150">
        <small class="text-muted d-block">Upload file PDF, JPG, JPEG, atau PNG (Max 10MB)</small>
    `;
    container.appendChild(newInputWrapper);
}

function removeSertifikatInput(button, index) {
    const wrapper = button.closest('.sertifikat-input-wrapper');
    const previewDiv = document.querySelector(`[data-sertifikat-index="${index}"]`);
    if (previewDiv) {
        previewDiv.remove();
    }
    wrapper.remove();
}

function handleSertifikatSelect(input, index) {
    const file = input.files[0];
    if (!file) return;
    
    if (file.size > 10 * 1024 * 1024) {
        alert('Ukuran file maksimal 10MB!');
        input.value = '';
        return;
    }
    
    const previewContainer = document.getElementById('sertifikat-preview');
    let previewDiv = document.querySelector(`[data-sertifikat-index="${index}"]`);
    
    if (!previewDiv) {
        previewDiv = document.createElement('div');
        previewDiv.className = 'col-6 col-md-4';
        previewDiv.setAttribute('data-sertifikat-index', index);
        previewContainer.appendChild(previewDiv);
    }
    
    if (file.type === 'application/pdf') {
        previewDiv.innerHTML = `
            <div class="alert alert-warning p-2">
                <div class="d-flex align-items-center">
                    <i class="ti ti-file-type-pdf fs-3 me-2"></i>
                    <div>
                        <strong class="small d-block">${file.name}</strong> <span class="badge bg-warning">Baru</span>
                        <small class="text-muted">${(file.size / 1024 / 1024).toFixed(2)} MB</small>
                    </div>
                </div>
            </div>
        `;
    } else if (file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewDiv.innerHTML = `
                <div class="alert alert-warning p-2">
                    <img src="${e.target.result}" class="img-thumbnail w-100" style="height: 120px; object-fit: cover;">
                    <div class="mt-1">
                        <strong class="small d-block">${file.name}</strong> <span class="badge bg-warning">Baru</span>
                        <small class="text-muted">${(file.size / 1024 / 1024).toFixed(2)} MB</small>
                    </div>
                </div>
            `;
        };
        reader.readAsDataURL(file);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Inisialisasi
    bahasaIndex = 0;

    // Preview foto
    const fotoInput = document.getElementById('foto');
    const fotoPreview = document.getElementById('foto-preview');
    
    if (fotoInput) {
        fotoInput.addEventListener('change', function(e) {
            fotoPreview.innerHTML = '';
            const file = e.target.files[0];
            
            if (file) {
                if (file.size > 5 * 1024 * 1024) {
                    alert('Ukuran file maksimal 5MB!');
                    e.target.value = '';
                    return;
                }
                
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        fotoPreview.innerHTML = `
                            <div class="alert alert-warning">
                                <img src="${e.target.result}" class="img-thumbnail w-100" style="max-height: 300px; object-fit: cover;">
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

