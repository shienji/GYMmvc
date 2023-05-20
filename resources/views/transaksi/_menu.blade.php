{{-- MENU --}}
<li class="nav-item menu-open">
    <a href="#" class="nav-link side-trans">
      <i class="nav-icon fas fa-money-check"></i>
      <p>
        Transaksi
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{ route('trans-vdashboard')}}" class="nav-link side-trans-vdashboard">
          <i class="far fa-circle nav-icon  text-danger"></i>
          <p>Dashboard</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('trans-vregister')}}" class="nav-link side-trans-vregister">
          <i class="far fa-circle nav-icon  text-warning"></i>
          <p>Pembayaran Anggota</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('trans-vrenewal')}}" class="nav-link side-trans-vrenewal">
          <i class="far fa-circle nav-icon  text-success"></i>
          <p>Perpanjangan Anggota</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('trans-vevent')}}" class="nav-link">
          <i class="far fa-circle nav-icon text-info"></i>
          <p>Registrasi Kegiatan</p>
        </a>
      </li>
    </ul>
</li>

{{-- LAPORAN --}}

{{-- <li class="nav-item">
    <a href="#" class="nav-link side-trans-lap">
      <i class="nav-icon fas fa-chart-pie"></i>
      <p>
        Laporan
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{ route('trans-lregister')}}" class="nav-link side-trans-lap-lregister">
          <i class="far fa-circle nav-icon  text-warning"></i>
          <p>Pembayaran Anggota</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('trans-lrenewal')}}" class="nav-link  side-trans-lap-lrenewal">
          <i class="far fa-circle nav-icon  text-success"></i>
          <p>Perpanjangan Anggota</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('trans-levent')}}" class="nav-link  side-trans-lap-levent">
          <i class="far fa-circle nav-icon text-info"></i>
          <p>Registrasi Kegiatan</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('trans-ljual')}}" class="nav-link  side-trans-lap-ljual">
          <i class="far fa-circle nav-icon text-danger"></i>
          <p>Penjualan Barang</p>
        </a>
      </li> --}}
      
    </ul>
</li>