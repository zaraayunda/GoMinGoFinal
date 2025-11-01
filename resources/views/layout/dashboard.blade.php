<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GoMinGo - Dashboard</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assetsdashboard/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('assetsdashboard/css/styles.min.css') }}" />
    @stack('styles')
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="@if(Auth::user()->role == 'admin'){{ route('admin.dashboard') }}@elseif(Auth::user()->role == 'tour_guide'){{ route('tour-guide.dashboard') }}@else{{ route('tempat-wisata.dashboard') }}@endif" class="text-nowrap logo-img">
                        <img src="{{ asset('assets/img/logo/logogo.png') }}" width="100"
                            alt="" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Home</span>
                        </li>
                        @if(Auth::user()->role == 'tempat_wisata')
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('tempat-wisata.dashboard') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-layout-dashboard"></i>
                                </span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Tempat Wisata</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('tempat-wisata.index') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-map-pin"></i>
                                </span>
                                <span class="hide-menu">Daftar Tempat Wisata</span>
                            </a>
                        </li>
                        @php
                            $canCreateTempatWisata = !\App\Models\TempatWisata::where('user_id', Auth::id())
                                ->whereIn('status', ['approved', 'pending'])
                                ->exists();
                        @endphp
                        @if($canCreateTempatWisata)
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('tempat-wisata.create') }}" aria-expanded="false">
                                    <span>
                                        <i class="ti ti-plus"></i>
                                    </span>
                                    <span class="hide-menu">Tambah Tempat Wisata</span>
                                </a>
                            </li>
                        @endif
                        @endif
                        @if(Auth::user()->role == 'tour_guide')
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('tour-guide.dashboard') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-layout-dashboard"></i>
                                </span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Tour Guide</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('tour-guide.index') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-user-star"></i>
                                </span>
                                <span class="hide-menu">Profil Tour Guide</span>
                            </a>
                        </li>
                        @php
                            $canCreateTourGuide = !\App\Models\TourGuide::where('user_id', Auth::id())
                                ->whereIn('status', ['approved', 'pending'])
                                ->exists();
                        @endphp
                        @if($canCreateTourGuide)
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('tour-guide.create') }}" aria-expanded="false">
                                    <span>
                                        <i class="ti ti-plus"></i>
                                    </span>
                                    <span class="hide-menu">Tambah Tour Guide</span>
                                </a>
                            </li>
                        @endif
                        @endif
                        @if(Auth::user()->role == 'admin')
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.dashboard') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-layout-dashboard"></i>
                                </span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Manajemen</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.tempat-wisata.index') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-map-pin"></i>
                                </span>
                                <span class="hide-menu">Tempat Wisata</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.tour-guide.index') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-user-star"></i>
                                </span>
                                <span class="hide-menu">Tour Guide</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.users.index') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-users"></i>
                                </span>
                                <span class="hide-menu">Users</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.events.index') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-calendar-event"></i>
                                </span>
                                <span class="hide-menu">Events</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <img src="{{ asset('assetsdashboard/images/profile/user-1.jpg') }}" alt="" width="35" height="35" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                    <div class="profile-dropdown position-relative" data-simplebar>
                                        <div class="py-3 px-7 pb-0">
                                            <h5 class="mb-0 fs-5 fw-semibold">{{ Auth::user()->name }}</h5>
                                            <p class="mb-0 text-muted">{{ Auth::user()->email }}</p>
                                            <small class="text-muted">{{ ucfirst(str_replace('_', ' ', Auth::user()->role)) }}</small>
                                        </div>
                                        <div class="d-flex align-items-center py-4 px-7">
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-primary mx-3 mt-2 d-block">
                                                    Logout
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->
            <div class="container-fluid">
                @if(session('success'))
                  <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
                @if(session('error'))
                  <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
                <!--  Row 1 -->
                @yield('content')
            </div>
        </div>
    </div>
    <script src="{{ asset('assetsdashboard/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assetsdashboard/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assetsdashboard/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('assetsdashboard/js/app.min.js') }}"></script>
    <script src="{{ asset('assetsdashboard/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assetsdashboard/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('assetsdashboard/js/dashboard.js') }}"></script>
    @stack('scripts')
</body>

</html>

