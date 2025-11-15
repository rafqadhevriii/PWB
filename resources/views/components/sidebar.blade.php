<!-- Sidebar -->
    <div class="sidebar">
     
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
          @if (Auth::user()->role === 'admin')
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
          @else
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
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
