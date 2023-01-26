<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a class="nav-link" href="#">TrashChanger</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a class="nav-link" href="#">TC</a>
        </div>
        <ul class="sidebar-menu" id="sidebar-menu">

            <li class="{{ request()->is('sampah', 'sampah/*') ? 'active' : '' }}">
                <a class="nav-link" href="#"><i class="fas fa-bars-progress"></i><span>Manajemen</span></a>
            </li>

            <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="#"><i class="fas fa-shop"></i><span>Penjualan</span></a>
            </li>

            <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="#"><i class="fas fa-user"></i><span>Profile</span></a>
            </li>

            {{-- <li class="{{ request()->is('kendaraan', 'kendaraan-mobil', 'kendaraan/*', 'kendaraan-mobil/*') ? 'active' : ''}}">
          <a href="#" class="nav-link"><i class="fas fa-light fa-car-side"></i><span>Kendaraan</span></a>
          @if (Auth::user()->role == 0 && !request()->is('kendaraan/*/detail') && !request()->is('kendaraan/*/edit'))
          <ul class="dropdown-menu">
            <li class="{{ request()->is('kendaraan', 'kendaraan/*') ? 'active' : ''}}"><a class="nav-link " href="kendaraan">Motor</a></li>
            <li class="{{ request()->is('kendaraan-mobil', 'kendaraan-mobil/*') ? 'active' : ''}}"><a class="nav-link" href="kendaraan-mobil">Mobil</a></li>
          </ul>
          @endif
        </li>
        <li class="{{ request()->is('pelanggan', 'pelanggan/*') ? 'active' : ''}}">
          <a href="#" class="nav-link"><i class="fas fa-light fa-user"></i> <span>Pelanggan</span></a>
        </li>
        <li class="{{ request()->is('transaksi','transaksi-mobil', 'transaksi/*','transaksi-mobil/*') ? 'active' : ''}}">
          <a href="#" class="nav-link" ><i class="fas fa-light fa-file"></i> <span>Pembelian</span></a>
          @if (Auth::user()->role == 0 && !request()->is('transaksi/*'))
          <ul class="dropdown-menu">
            <li class="{{ request()->is('transaksi')? 'active' : ''}}"><a class="nav-link " href="transaksi">Motor</a></li>
            <li class="{{ request()->is('transaksi-mobil','transaksi-mobil/*') ? 'active' : ''}}"><a class="nav-link" href="transaksi-mobil">Mobil</a></li>
          </ul>
          @endif
        </li>

        <li class="{{ request()->is('laporan','laporan-mobil', 'laporan/*','laporan-mobil/*') ? 'active' : '' }}">
          <a href="#" class="nav-link"><i class="fas fa-folder"></i><span>Laporan</span></a>
          @if (Auth::user()->role == 0)
          <ul class="dropdown-menu">
            <li class="{{ request()->is('laporan') ? 'active' : ''}}"><a class="nav-link " href="laporan">Motor</a></li>
            <li class="{{ request()->is('laporan-mobil') ? 'active' : ''}}"><a class="nav-link" href="laporan-mobil">Mobil</a></li>
          </ul>
          @endif
        </li>
        @if (Auth::user()->role == 0)
        <li class="{{ request()->is('user','cabang', 'user/*', 'cabang/*') ? 'active' : '' }}">
          <a href="#" class="nav-link" ><i class="fas fa-users"></i> <span>Administrasi</span></a>
          @if (!request()->is('cabang/*') && !request()->is('user/*'))
          <ul class="dropdown-menu">
            <li class="{{ request()->is('user') ? 'active' : ''}}"><a class="nav-link " href="user">User</a></li>
            <li class="{{ request()->is('cabang') ? 'active' : ''}}"><a class="nav-link" href="cabang">Cabang</a></li>
          </ul>
          @endif
        </li>
        @endif --}}

    </aside>
</div>
