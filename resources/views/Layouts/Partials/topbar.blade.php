<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <h1 class="h5 text-gray-800">Dashboard {{ Auth::user()->role }} </h1>
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">@ {{ Auth::user()->username }}</span>
                @if (Auth::user()->role == 'siswa')
                    <img class="img-profile rounded-circle" src="{{ asset(Auth::user()->profilSiswa->fotoSiswa) }}">
                @endif
                @if (Auth::user()->role == 'guru')
                    <img class="img-profile rounded-circle" src="{{ asset(Auth::user()->profilGuru->fotoGuruBK) }}">
                @endif
                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'kepalaSekolah')
                    <img class="img-profile rounded-circle" src="{{ asset('assets/hiroles.png') }}">
                @endif
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                @if (Auth::user()->role == 'guru' || Auth::user()->role == 'siswa')
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profil Akun
                    </a>
                    <div class="dropdown-divider"></div>
                @endif

                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

</nav>
