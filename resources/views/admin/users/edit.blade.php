@extends('layout.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="card-title fw-semibold mb-0">Edit User</h5>
                        <a href="{{ route('admin.users.show', $user) }}" class="btn btn-secondary">
                            <i class="ti ti-arrow-left me-2"></i>Kembali
                        </a>
                    </div>

                    <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label">Nama <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                           value="{{ old('name', $user->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                           value="{{ old('email', $user->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Role <span class="text-danger">*</span></label>
                                    <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                                        <option value="">Pilih Role</option>
                                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="tour_guide" {{ old('role', $user->role) == 'tour_guide' ? 'selected' : '' }}>Tour Guide</option>
                                        <option value="tempat_wisata" {{ old('role', $user->role) == 'tempat_wisata' ? 'selected' : '' }}>Tempat Wisata</option>
                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Password Baru (Kosongkan jika tidak ingin mengubah)</label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                                           autocomplete="new-password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Konfirmasi Password Baru</label>
                                    <input type="password" name="password_confirmation" class="form-control" 
                                           autocomplete="new-password">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Foto Profil</label>
                                    <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror" 
                                           accept="image/*">
                                    @error('photo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @if($user->photo)
                                        <small class="text-muted">Foto saat ini: <a href="{{ Storage::url($user->photo) }}" target="_blank">Lihat</a></small>
                                    @endif
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ti ti-check me-2"></i>Update User
                                    </button>
                                    <a href="{{ route('admin.users.show', $user) }}" class="btn btn-secondary">
                                        Batal
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-4">
                                @if($user->photo)
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <h6 class="card-title">Foto Saat Ini</h6>
                                            <img src="{{ Storage::url($user->photo) }}" 
                                                 class="img-fluid rounded-circle mb-2" 
                                                 style="width: 150px; height: 150px; object-fit: cover;">
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

