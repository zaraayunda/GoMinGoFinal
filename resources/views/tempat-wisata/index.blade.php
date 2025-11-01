@extends('layout.dashboard')

@section('content')
<div class="px-6 py-10 bg-blue-50 min-h-screen">
    <div class="max-w-7xl mx-auto">
        
        <!-- Header -->
        <div class="bg-white shadow-sm rounded-2xl p-6 mb-8 border border-blue-100 flex justify-between items-center">
            <h5 class="text-2xl font-semibold text-blue-600">Daftar Tempat Wisata</h5>

            @if($canCreate)
                <a href="{{ route('tempat-wisata.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-200 shadow">
                    <i class="ti ti-plus mr-2"></i>Tambah Tempat Wisata
                </a>
            @else
                <button class="px-4 py-2 bg-gray-300 text-gray-600 rounded-lg cursor-not-allowed">
                    <i class="ti ti-plus mr-2"></i>Tambah Tempat Wisata
                </button>
            @endif
        </div>

        <!-- Alert -->
        @if(session('success'))
            <div class="bg-green-50 text-green-700 border border-green-200 px-4 py-3 rounded-lg mb-4 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 text-red-700 border border-red-200 px-4 py-3 rounded-lg mb-4 shadow-sm">
                {{ session('error') }}
            </div>
        @endif

        <!-- Empty State -->
        @if($tempatWisatas->isEmpty())
            <div class="text-center py-20 bg-white shadow-md rounded-2xl border border-blue-100">
                <i class="ti ti-map-pin-off text-6xl text-blue-300"></i>
                <p class="text-gray-600 mt-4">Belum ada tempat wisata. Silakan tambah tempat wisata baru.</p>
                @if($canCreate)
                    <a href="{{ route('tempat-wisata.create') }}"
                       class="inline-flex items-center mt-5 px-6 py-2.5 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-200 shadow">
                        <i class="ti ti-plus mr-2"></i>Tambah Tempat Wisata Pertama
                    </a>
                @endif
            </div>
        @else
            <!-- Grid Cards -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($tempatWisatas as $tempatWisata)
                    <div class="bg-white border border-blue-100 rounded-2xl shadow-sm hover:shadow-md hover:-translate-y-1 transition duration-200 flex flex-col overflow-hidden">
                        @if($tempatWisata->photos->first())
                            <img src="{{ Storage::url($tempatWisata->photos->first()->file_path) }}" 
                                 alt="{{ $tempatWisata->nama_tempat }}"
                                 class="h-48 w-full object-cover">
                        @else
                            <div class="h-48 w-full bg-blue-50 flex items-center justify-center text-blue-300">
                                <i class="ti ti-photo text-6xl"></i>
                            </div>
                        @endif

                        <div class="p-5 flex flex-col flex-grow">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="px-3 py-1 text-xs font-medium rounded-full 
                                    {{ $tempatWisata->kategori == 'alam' ? 'bg-green-100 text-green-700' : 
                                       ($tempatWisata->kategori == 'kuliner' ? 'bg-yellow-100 text-yellow-700' : 'bg-blue-100 text-blue-700') }}">
                                    {{ ucfirst($tempatWisata->kategori) }}
                                </span>

                                <span class="px-3 py-1 text-xs font-medium rounded-full 
                                    {{ $tempatWisata->status == 'approved' ? 'bg-green-100 text-green-700' :
                                       ($tempatWisata->status == 'rejected' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                                    {{ ucfirst($tempatWisata->status) }}
                                </span>
                            </div>

                            <h5 class="text-lg font-semibold text-gray-800 mb-2 truncate">{{ $tempatWisata->nama_tempat }}</h5>
                            <p class="text-gray-600 text-sm flex-grow leading-relaxed">{{ Str::limit($tempatWisata->deskripsi, 100) }}</p>

                            <div class="flex justify-between items-center mt-4 pt-3 border-t border-blue-50">
                                <small class="text-gray-500 flex items-center">
                                    <i class="ti ti-photo mr-1 text-blue-400"></i>{{ $tempatWisata->photos->count() }} foto
                                </small>
                                <div class="flex space-x-2">
                                    <a href="{{ route('tempat-wisata.show', $tempatWisata) }}" 
                                       class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg transition">
                                        <i class="ti ti-eye"></i>
                                    </a>
                                    <a href="{{ route('tempat-wisata.edit', $tempatWisata) }}" 
                                       class="p-2 text-yellow-500 hover:bg-yellow-50 rounded-lg transition">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <form action="{{ route('tempat-wisata.destroy', $tempatWisata) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus tempat wisata ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Login Button -->
        <div class="text-center mt-10">
            <a href="{{ route('login') }}" 
               class="inline-flex items-center px-8 py-3 bg-blue-500 text-white rounded-xl shadow hover:bg-blue-600 hover:shadow-md transition-all duration-300 border-2 border-blue-400">
                <i class="ti ti-login mr-2 text-lg"></i>Masuk ke Akun
            </a>
        </div>
    </div>
</div>
@endsection
