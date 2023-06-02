{{-- USER --}}
<li class="nav-item menu-open">
    <a href="#" class="nav-link side-trans">
        <i class="nav-icon fas fa-money-check"></i>
        <p>
            User
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('layout-adminpage') }}" class="nav-link side-trans-vdashboard">
                <i class="far fa-circle nav-icon  text-secondary"></i>
                <p>Admin Page</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link side-trans-vdashboard">
                <i class="far fa-circle nav-icon  text-secondary"></i>
                <p>User Page</p>
            </a>
        </li>
    </ul>
</li>

{{-- MASTER --}}
<li class="nav-item menu-open">
    <a href="#" class="nav-link side-trans">
        <i class="nav-icon fas fa-money-check"></i>
        <p>
            Master
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="#" class="nav-link side-trans-vdashboard">
                <i class="far fa-circle nav-icon  text-secondary"></i>
                <p>Master User</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('role_master') }}" class="nav-link side-trans-vdashboard">
                <i class="far fa-circle nav-icon  text-danger"></i>
                <p>Master Role</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('fasilitas_master') }}" class="nav-link side-trans-vregister">
                <i class="far fa-circle nav-icon  text-warning"></i>
                <p>Master Fasilitas</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('peralatan_master') }}" class="nav-link side-trans-vrenewal">
                <i class="far fa-circle nav-icon  text-success"></i>
                <p>Master Peralatan</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('pelatih_master') }}" class="nav-link">
                <i class="far fa-circle nav-icon text-info"></i>
                <p>Master Pelatih</p>
            </a>
        </li>
    </ul>
</li>

{{-- TRANSAKSI --}}
<li class="nav-item menu-open">
    <a href="#" class="nav-link side-trans">
        <i class="nav-icon fas fa-money-check"></i>
        <p>
            Transaksi
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        {{-- <li class="nav-item">
            <a href="{{ route('trans-vdashboard') }}" class="nav-link side-trans-vdashboard">
                <i class="far fa-circle nav-icon  text-danger"></i>
                <p>Dashboard</p>
            </a>
        </li> --}}
        <li class="nav-item">
            <a href="{{ route('trans-vregister') }}" class="nav-link side-trans-vregister">
                <i class="far fa-circle nav-icon  text-warning"></i>
                <p>Pembayaran Anggota</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('trans-vrenewal') }}" class="nav-link side-trans-vrenewal">
                <i class="far fa-circle nav-icon  text-success"></i>
                <p>Perpanjangan Anggota</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('trans-vevent') }}" class="nav-link">
                <i class="far fa-circle nav-icon text-info"></i>
                <p>Registrasi Kegiatan</p>
            </a>
        </li>
    </ul>
</li>

{{-- LAPORAN --}}
<li class="nav-item menu-open">
    <a href="#" class="nav-link side-trans">
        <i class="nav-icon fas fa-chart-pie"></i>
        <p>
            Laporan
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('laporan-user') }}" class="nav-link side-trans-vdashboard">
                <i class="far fa-circle nav-icon  text-danger"></i>
                <p>User</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('laporan-transaksi') }}" class="nav-link side-trans-vregister">
                <i class="far fa-circle nav-icon  text-warning"></i>
                <p>Transaksi</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('laporan-fasilitas') }}" class="nav-link side-trans-vrenewal">
                <i class="far fa-circle nav-icon  text-success"></i>
                <p>Fasilitas</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('laporan-event') }}" class="nav-link">
                <i class="far fa-circle nav-icon text-info"></i>
                <p>Event</p>
            </a>
        </li>
    </ul>
</li>
{{-- JANGAN LUPA DI HIDE BAGIAN INI --}}
{{-- LOGIN REGISTER --}}
<li class="nav-item menu-open">
    <a href="#" class="nav-link side-trans">
        <i class="nav-icon fas fa-chart-pie"></i>
        <p>
            Login Register
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('layout-loginpage') }}" class="nav-link side-trans-vdashboard">
                <i class="far fa-circle nav-icon  text-danger"></i>
                <p>Login</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('layout-registerpage') }}" class="nav-link side-trans-vregister">
                <i class="far fa-circle nav-icon  text-warning"></i>
                <p>Register</p>
            </a>
        </li>
    </ul>
</li>
