<ul class="navbar-nav bg-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/beranda">
        <div class="sidebar-brand-icon ">
            {{-- <i class="fa-solid fa-house-signal"></i> --}}
            <img src="{{ asset('assets/nepurside.png') }}" alt="logosmall" style="height: 32px">
        </div>
        <div class="sidebar-brand-text mx-3">SIMBK NEPUR</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/beranda">
            <i class="fa-solid fa-house-chimney"></i>
            <span>Beranda</span></a>
    </li>
    {{-- Feature Restriction Using Ifs --}}
    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'guru' || Auth::user()->role == 'kepalaSekolah')
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                aria-expanded="true" aria-controls="collapsePages">
                <i class="fa-solid fa-chalkboard-user"></i>
                <span>Siswa</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="">Laporan BK</a>
                    <a class="collapse-item" href="">List Siswa</a>
                    <a class="collapse-item" href="">Prestasi Siswa</a>
                </div>
            </div>
        </li>
    @endif

    @if (Auth::user()->role == 'admin')
        <li class="nav-item">
            <a class="nav-link" href="">
                <i class="fa-solid fa-person-chalkboard"></i>
                <span>List Guru BK</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/tahun-ajar">
                <i class="fa-solid fa-calendar-week"></i>
                <span>Tahun Ajar</span></a>
        </li>
    @endif

    @if (Auth::user()->role == 'siswa')
        <li class="nav-item">
            <a class="nav-link" href="">
                <i class="fa-solid fa-folder-open"></i>
                <span>Riwayatku</span></a>
        </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
