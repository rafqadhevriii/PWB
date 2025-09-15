<!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div> -->

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('dataBuku') }}" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Data Buku
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('dataAnggota') }}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Data Anggota
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('dataPeminjaman') }}" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Data Peminjaman
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('dataPengembalian') }}" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Data Pengembalian
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('dataLaporan') }}" class="nav-link">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Data Laporan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('katalogBuku') }}" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Katalog Buku
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('riwayatPeminjaman') }}" class="nav-link">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Riwayat Peminjaman
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
