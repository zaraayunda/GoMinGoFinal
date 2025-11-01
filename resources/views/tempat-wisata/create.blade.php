@extends('layout.dashboard')

@push('styles')
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<link rel="stylesheet" href="https://unpkg.com/leaflet.fullscreen@2.4.0/Control.FullScreen.css"/>
<style>
    #map {
        height: 450px;
        border-radius: 16px;
        box-shadow: 0 12px 32px rgba(12, 39, 77, .12);
        background: #f8fafc;
        border: 2px solid #fff;
    }
    .leaflet-touch .leaflet-control-layers, 
    .leaflet-touch .leaflet-bar {
        border: none;
        box-shadow: 0 4px 12px rgba(0,0,0,.08);
        border-radius: 12px;
        overflow: hidden;
    }
    .leaflet-bar a {
        background: rgba(255,255,255,.9) !important;
        color: #374151 !important;
        border-bottom: 1px solid #f3f4f6 !important;
        width: 40px !important;
        height: 40px !important;
        line-height: 40px !important;
        backdrop-filter: blur(8px);
    }
    .leaflet-bar a:hover {
        background: #fff !important;
        color: #2563eb !important;
    }
    .leaflet-control-fullscreen {
        border: none !important;
        border-radius: 12px;
        overflow: hidden;
    }
    .leaflet-touch .leaflet-control-fullscreen a {
        background: rgba(255,255,255,.9) !important;
        backdrop-filter: blur(8px);
        width: 40px;
        height: 40px;
        line-height: 40px;
    }
    .leaflet-control-fullscreen a:hover {
        background: #fff !important;
        color: #2563eb !important;
    }
    /* Style for zoom controls */
    .leaflet-control-zoom {
        border: none !important;
        border-radius: 12px;
        overflow: hidden;
    }
    .leaflet-touch .leaflet-control-zoom-in,
    .leaflet-touch .leaflet-control-zoom-out {
        width: 40px !important;
        height: 40px !important;
        line-height: 40px !important;
        font-size: 18px !important;
    }
    .map-coordinate-display {
        position: absolute;
        bottom: 10px;
        left: 10px;
        background: rgba(255,255,255,.9);
        padding: 6px 12px;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0,0,0,.1);
        z-index: 1000;
        font-size: 13px;
        backdrop-filter: blur(4px);
    }
    .fullscreen #map {
        height: 100vh;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="card-title fw-semibold mb-0">Tambah Tempat Wisata</h5>
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

                    <form action="{{ route('tempat-wisata.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="nama_tempat" class="form-label">Nama Tempat <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nama_tempat') is-invalid @enderror" 
                                           id="nama_tempat" name="nama_tempat" 
                                           value="{{ old('nama_tempat') }}" maxlength="150" required>
                                    @error('nama_tempat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                                    <select class="form-control @error('kategori') is-invalid @enderror" 
                                            id="kategori" name="kategori" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="alam" {{ old('kategori') == 'alam' ? 'selected' : '' }}>Alam</option>
                                        <option value="kuliner" {{ old('kategori') == 'kuliner' ? 'selected' : '' }}>Kuliner</option>
                                        <option value="budaya" {{ old('kategori') == 'budaya' ? 'selected' : '' }}>Budaya</option>
                                    </select>
                                    @error('kategori')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                              id="deskripsi" name="deskripsi" rows="5" required>{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                              id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Pilih Lokasi di Peta <span class="text-danger">*</span></label>
                                    <div id="map" style="height: 400px; width: 100%; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 1rem;"></div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="latitude" class="form-label">Latitude</label>
                                                <input type="number" step="any" class="form-control @error('latitude') is-invalid @enderror" 
                                                       id="latitude" name="latitude" 
                                                       value="{{ old('latitude') }}" placeholder="-7.7956" required>
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
                                                       value="{{ old('longitude') }}" placeholder="110.3695" required>
                                                @error('longitude')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <small class="text-muted">Klik pada peta untuk memilih lokasi atau isi koordinat secara manual. Marker dapat digeser untuk menyesuaikan posisi.</small>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="tiket_masuk" class="form-label">Tiket Masuk (Rp)</label>
                                            <input type="number" step="0.01" min="0" class="form-control @error('tiket_masuk') is-invalid @enderror" 
                                                   id="tiket_masuk" name="tiket_masuk" 
                                                   value="{{ old('tiket_masuk') }}" placeholder="0">
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
                                                   value="{{ old('kontak') }}" maxlength="50" placeholder="081234567890">
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
                                           value="{{ old('jam_buka') }}" maxlength="50" placeholder="08:00 - 17:00">
                                    @error('jam_buka')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="tipe_bukti" class="form-label">Tipe Bukti Kepemilikan <span class="text-danger">*</span></label>
                                    <select class="form-control @error('tipe_bukti') is-invalid @enderror" 
                                            id="tipe_bukti" name="tipe_bukti" required>
                                        <option value="">Pilih Tipe Bukti</option>
                                        <option value="sertifikat" {{ old('tipe_bukti') == 'sertifikat' ? 'selected' : '' }}>Sertifikat</option>
                                        <option value="surat_izin" {{ old('tipe_bukti') == 'surat_izin' ? 'selected' : '' }}>Surat Izin</option>
                                        <option value="akta" {{ old('tipe_bukti') == 'akta' ? 'selected' : '' }}>Akta</option>
                                        <option value="lainnya" {{ old('tipe_bukti') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    @error('tipe_bukti')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="bukti_kepemilikan" class="form-label">Bukti Kepemilikan/Surat Izin <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control @error('bukti_kepemilikan') is-invalid @enderror" 
                                           id="bukti_kepemilikan" name="bukti_kepemilikan" 
                                           accept=".pdf,.jpg,.jpeg,.png" required>
                                    <small class="text-muted">Upload file PDF, JPG, JPEG, atau PNG (Max 10MB)</small>
                                    <div id="bukti-preview" class="mt-2"></div>
                                    @error('bukti_kepemilikan')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Foto Tempat Wisata</label>
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
                                <i class="ti ti-save me-2"></i>Simpan
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
                        <div class="alert alert-info d-flex align-items-center">
                            <i class="ti ti-file-type-pdf fs-4 me-2"></i>
                            <div>
                                <strong>${file.name}</strong>
                                <small class="d-block text-muted">${(file.size / 1024 / 1024).toFixed(2)} MB</small>
                            </div>
                        </div>
                    `;
                } else if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        buktiPreview.innerHTML = `
                            <div class="alert alert-info">
                                <img src="${e.target.result}" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                <div class="mt-2">
                                    <strong>${file.name}</strong>
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

@push('scripts')
<!-- Leaflet JavaScript -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet.fullscreen@2.4.0/Control.FullScreen.min.js"></script>
<script>
function initMap() {
    // Initialize map centered on Sumatera Barat (Padang)
    var map = L.map('map', {
        center: [-0.9478, 100.4171],
        zoom: 8,
        fullscreenControl: true,
        fullscreenControlOptions: {
            position: 'topleft',
            title: 'Tampilkan Peta Penuh',
            titleCancel: 'Keluar dari Peta Penuh'
        },
        zoomControl: false // We'll add zoom control separately
    });
    
    // Add custom tiles with better styling
    L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
        subdomains: 'abcd',
        maxZoom: 20
    }).addTo(map);
    
    // Add zoom control to top-left
    L.control.zoom({
        position: 'topleft'
    }).addTo(map);
    
    // Define bounds for Sumatera Barat
    var sumbarBounds = L.latLngBounds(
        [-1.5, 99.5], // Southwest coordinates
        [-0.5, 101.5]  // Northeast coordinates
    );

    // Add scale control with metric
    L.control.scale({
        maxWidth: 200,
        metric: true,
        imperial: false,
        position: 'bottomright'
    }).addTo(map);

    var marker;
    
    // Handle map clicks
    map.on('click', function(e) {
        const lat = e.latlng.lat.toFixed(6);
        const lng = e.latlng.lng.toFixed(6);
        
        // Update inputs
        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;

        // Update or add marker
        if (marker) {
            marker.setLatLng(e.latlng);
        } else {
            marker = L.marker(e.latlng, {draggable: true}).addTo(map);
        }

        // Handle marker drag events
        marker.on('dragend', function(e) {
            const position = marker.getLatLng();
            const lat = position.lat.toFixed(6);
            const lng = position.lng.toFixed(6);
            
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        });
    });

    // If coordinates are pre-filled, set marker
    const initialLat = document.getElementById('latitude').value;
    const initialLng = document.getElementById('longitude').value;
    if (initialLat && initialLng) {
        const latlng = L.latLng(parseFloat(initialLat), parseFloat(initialLng));
        marker = L.marker(latlng, {draggable: true}).addTo(map);
        map.setView(latlng, 13);

        marker.on('dragend', function(e) {
            const position = marker.getLatLng();
            document.getElementById('latitude').value = position.lat.toFixed(6);
            document.getElementById('longitude').value = position.lng.toFixed(6);
        });
    }

    // Force a map invalidate size after initialization
    setTimeout(function() {
        map.invalidateSize();
    }, 100);
}

// Initialize map when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    initMap();
});
</script>
@endpush
