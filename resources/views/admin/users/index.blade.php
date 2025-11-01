@extends('layout.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="card-title fw-semibold mb-0">Kelola Users</h5>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Filters -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <form method="GET" action="{{ route('admin.users.index') }}">
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Role</label>
                                        <select name="role" class="form-select">
                                            <option value="">Semua Role</option>
                                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="tour_guide" {{ request('role') == 'tour_guide' ? 'selected' : '' }}>Tour Guide</option>
                                            <option value="tempat_wisata" {{ request('role') == 'tempat_wisata' ? 'selected' : '' }}>Tempat Wisata</option>
                                        </select>
                                    </div>
                                    <div class="col-md-7">
                                        <label class="form-label">Cari</label>
                                        <input type="text" name="search" class="form-control" 
                                               value="{{ request('search') }}" 
                                               placeholder="Cari nama atau email...">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">&nbsp;</label>
                                        <div class="d-flex gap-2">
                                            <button type="submit" class="btn btn-primary w-100">
                                                <i class="ti ti-filter me-1"></i>Filter
                                            </button>
                                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                                                <i class="ti ti-x"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if($users->isEmpty())
                        <div class="text-center py-5">
                            <i class="ti ti-users-off fs-1 text-muted"></i>
                            <p class="text-muted mt-3">Tidak ada users ditemukan.</p>
                        </div>
                    @else
                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Photo</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Tanggal Registrasi</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>
                                                @if($user->photo)
                                                    <img src="{{ Storage::url($user->photo) }}" 
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
                                                <strong>{{ $user->name }}</strong>
                                            </td>
                                            <td>
                                                <small>{{ $user->email }}</small>
                                            </td>
                                            <td>
                                                <span class="badge bg-{{ $user->role == 'admin' ? 'danger' : ($user->role == 'tour_guide' ? 'info' : 'success') }}">
                                                    {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                                                </span>
                                            </td>
                                            <td>
                                                <small>{{ $user->created_at->format('d M Y') }}</small>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <a href="{{ route('admin.users.show', $user) }}" 
                                                       class="btn btn-sm btn-outline-primary" title="View">
                                                        <i class="ti ti-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.users.edit', $user) }}" 
                                                       class="btn btn-sm btn-outline-warning" title="Edit">
                                                        <i class="ti ti-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.users.reset-password', $user) }}" 
                                                          method="POST" class="d-inline"
                                                          onsubmit="return confirm('Reset password untuk user ini? Password baru akan ditampilkan setelah reset.');">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-outline-secondary" title="Reset Password">
                                                            <i class="ti ti-key"></i>
                                                        </button>
                                                    </form>
                                                    @if($user->id !== Auth::id())
                                                        <form action="{{ route('admin.users.destroy', $user) }}" 
                                                              method="POST" class="d-inline"
                                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini? Ini akan menghapus semua data terkait (tempat wisata/tour guide).');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                                <i class="ti ti-trash"></i>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <button class="btn btn-sm btn-outline-secondary" disabled title="Tidak dapat menghapus akun sendiri">
                                                            <i class="ti ti-trash"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-3">
                            {{ $users->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

