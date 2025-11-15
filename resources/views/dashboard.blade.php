<x-layoutAdmin>
    @if (Auth::user()->role === 'admin')
        <!-- Dashboard Admin -->
        <section class="content">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-12">
                        <h3>Dashboard Admin</h3>
                        <p class="text-muted">Selamat datang, {{ auth()->user()->name }}!</p>
                    </div>
                </div>

                <!-- Statistik -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $totalAnggota }}</h3>
                                <p>Total Anggota</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <a href="{{ route('dataAnggota') }}" class="small-box-footer">Lihat detail <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $totalBuku }}</h3>
                                <p>Total Buku</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-book"></i>
                            </div>
                            <a href="{{ route('dataBuku') }}" class="small-box-footer">Lihat detail <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $totalPeminjaman }}</h3>
                                <p>Sedang Dipinjam</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-book-reader"></i>
                            </div>
                            <a href="{{ route('dataPeminjaman') }}" class="small-box-footer">Lihat detail <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>{{ $totalPengembalian }}</h3>
                                <p>Dikembalikan Hari Ini</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <a href="{{ route('dataPengembalian') }}" class="small-box-footer">Lihat detail <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <!-- Dashboard User -->
        <section class="content">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-12">
                        <h3>Dashboard Anggota</h3>
                        <p class="text-muted">Halo, {{ auth()->user()->name }}!</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $bukuDipinjam }}</h3>
                                <p>Buku Dipinjam</p>
                            </div>
                            <div class="icon"><i class="fas fa-book-reader"></i></div>
                            <a href="{{ route('riwayatPeminjaman') }}" class="small-box-footer">Lihat detail <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $belumDikembalikan }}</h3>
                                <p>Perlu Dikembalikan</p>
                            </div>
                            <div class="icon"><i class="fas fa-clock"></i></div>
                            <a href="{{ route('riwayatPeminjaman') }}" class="small-box-footer">Lihat detail <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    {{-- <div class="col-lg-4 col-12">
                    <div class="col-lg-4 col-12">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <h5>Pinjam Buku Baru</h5>
                                <p class="text-muted">Temukan buku menarik di katalog</p>
                                <a href="{{ route('katalogBuku') }}" class="btn btn-primary">
                                    <i class="fas fa-book"></i> Lihat Katalog
                                </a>
                            </div>
                        </div>
                    </div> --}}
                    </div>
                </div>
            </div>
        </section>
    @endif
</x-layoutAdmin>
