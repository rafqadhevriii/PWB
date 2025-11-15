<x-layoutAdmin>
    <link rel="stylesheet" href="{{ asset('btn.css') }}">

    <div class="section">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Total Dipinjam -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $peminjamanAktif ?? 0 }}</h3>
                                <p>Total Dipinjam</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-book-reader"></i>
                            </div>
                            <a href="{{ route('dataPeminjaman') }}" class="small-box-footer">
                                Lihat detail <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Total Dikembalikan -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>{{ $peminjamanDikembalikan ?? 0 }}</h3>
                                <p>Total Dikembalikan</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <a href="{{ route('dataPengembalian') }}" class="small-box-footer">
                                Lihat detail <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Total Terlambat -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $totalTerlambat ?? 0 }}</h3>
                                <p>Total Terlambat</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <a href="{{ route('dataPeminjaman') }}" class="small-box-footer">
                                Lihat detail <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Total Denda -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>Rp {{ number_format($totalDenda ?? 0, 0, ',', '.') }}</h3>
                                <p>Total Denda</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                            <a href="{{ route('dataPengembalian') }}" class="small-box-footer">
                                Lihat detail <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Daftar Laporan -->
        <div class="card shadow-sm mt-4">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Laporan Peminjaman</h5>
                <a href="#" class="btn cetak-btn btn-sm" onclick="window.print()">
                    <i class="fas fa-print"></i> Cetak Laporan
                </a>
            </div>

            <div class="card-body table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Peminjam</th>
                            <th>Judul Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th>Denda</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($peminjamanDetail as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->user->name ?? '-' }}</td>
                                <td>{{ $item->buku->judul ?? '-' }}</td>
                                <td>{{ $item->tanggal_pinjam }}</td>
                                <td>{{ $item->tanggal_kembali ?? '-' }}</td>

                                <td>
                                    @if ($item->status === 'dipinjam')
                                        <span class="badge bg-primary">Dipinjam</span>
                                    @elseif ($item->status === 'dikembalikan')
                                        <span class="badge bg-success">Dikembalikan</span>
                                    @elseif ($item->status === 'terlambat')
                                        <span class="badge bg-warning text-dark">Terlambat</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($item->status) }}</span>
                                    @endif
                                </td>

                                <td>Rp {{ number_format($item->denda, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">
                                    Belum ada data peminjaman
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layoutAdmin>
