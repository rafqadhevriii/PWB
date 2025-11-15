<x-layoutadmin>
    <section class="content-header">
        <div class="container-fluid">
            <h4>Riwayat Peminjaman Buku</h4>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Riwayat Peminjaman</h3>
                </div>
                <div class="card-body">
                    @if($riwayat->count() > 0)
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Peminjam</th>
                                <th>Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($riwayat as $key => $r)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $r->user->name ?? 'N/A' }}</td>
                                <td>{{ $r->buku->judul ?? 'N/A' }}</td>
                                <td>
                                    @if($r->tanggal_pinjam)
                                        {{ \Carbon\Carbon::parse($r->tanggal_pinjam)->format('d M Y') }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if($r->tanggal_kembali)
                                        {{ \Carbon\Carbon::parse($r->tanggal_kembali)->format('d M Y') }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    <span class="badge
                                        @if($r->status == 'dikembalikan') badge-success
                                        @elseif($r->status == 'terlambat') badge-danger
                                        @else badge-secondary @endif">
                                        {{ ucfirst($r->status) }}
                                    </span>
                                </td>
                                <td>
                                    @if($r->status == 'dikembalikan')
                                        Buku telah dikembalikan dengan baik.
                                    @elseif($r->status == 'terlambat')
                                        Buku dikembalikan melebihi batas waktu.
                                    @else
                                        Tidak ada keterangan.
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle"></i> Belum ada riwayat peminjaman.
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</x-layoutadmin>
