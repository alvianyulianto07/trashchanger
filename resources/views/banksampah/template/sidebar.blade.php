<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
          <a class="nav-link sidebar-link" href="#">TrashChanger</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
          <a class="nav-link sidebar-link" href="#">TC</a>
      </div>
      <ul class="sidebar-menu" id="sidebar-menu">
        <form action="{{ route('penjualan.laporan') }}" method="POST" style="margin: 0;">
          @csrf
          <input type="hidden" name="year" value="all">
          <input type="hidden" name="month" value="all">


          <!-- Manajemen -->
          <li class="{{ request()->is('sampah', 'sampah/*') ? 'active' : '' }}">
              <a class="nav-link sidebar-link {{ request()->is('sampah') ? 'active' : '' }}" href="/sampah">
                  <i class="fas fa-bars-progress" style="margin-right: 4px;"></i>
                  <span>Manajemen</span>
              </a>
          </li>

          <!-- Penjualan -->
          <li class="{{ request()->is('penjualan') ? 'active' : '' }}">
              <a class="nav-link sidebar-link {{ request()->is('penjualan') ? 'active' : '' }}" href="/penjualan">
                  <i class="fas fa-shop" style="margin-right: 4px;"></i>
                  <span>Penjualan</span>
              </a>
          </li>

          <li class="{{ request()->is('laporan') ? 'active' : '' }}" style="align-items: center;">
            <a class="nav-link sidebar-link {{ request()->is('laporan') ? 'active' : '' }}">
              <button type="submit" class="btn nav-link {{ request()->is('laporan') ? 'active' : '' }}" style="outline: none; padding: 0px; border: none;">
                  <i class="fas fa-chart-bar" style="margin-right: 0px;"></i>
                  <span style="text-decoration: none;">Laporan</span>
              </button>
            </a>
          </li>

        </form>
      </ul>
  </aside>

</div>
