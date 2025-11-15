<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Perpustakaan</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .header h2 {
            margin: 5px 0;
            font-size: 18px;
            color: #555;
        }
        .header p {
            margin: 3px 0;
            color: #666;
        }

        .stat-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin: 20px 0;
        }
        .stat-item {
            text-align: center;
            padding: 15px;
            border: 1px solid #ddd;
            background: #fff;
            border-radius: 5px;
        }
        .stat-number {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .stat-label {
            font-size: 11px;
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 12px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 7px;
        }
        th {
            background: #f2f2f2;
            font-weight: bold;
        }

        .badge {
            padding: 4px 8px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
        }
        .badge-warning { background: #ffc107; color: #000; }
        .badge-success { background: #28a745; color: #fff; }
        .badge-danger { background: #dc3545; color: #fff; }
        .badge-secondary { background: #6c757d; color: #fff; }

        .footer {
            text-align: right;
            margin-top: 40px;
            font-size: 11px;
            color: #666;
        }

        @media print {
            .no-print { display: none; }
            body { margin: 0; }
        }
    </style>
</head>

<body>

    <!-- Header -->
    <div class="header">
        <h1>LAPORAN PERPUSTAKAAN</h1>
        <h2>Sistem Informasi Perpustakaan</h2>
        <p>Periode: {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} -
            {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</p>
        <p>Tanggal Cetak: {{ \Carbon\Carbon::now()->format('d M Y H:i') }}</p>
    </div>


    <!-- Statistik -->
    <div class="stat-grid">
        <div class="stat-item">
            <div class="stat-number">{{ $totalBuku }}</div>
            <div class="stat-label">TOTAL BUKU</div>
        </div>

        <div class="stat-item">
            <div class="stat-number">{{ $totalAnggota }}</div>
            <div class="stat-label">TOTAL ANGGOTA</div>
        </div>

        <div class="stat-item">
            <div class="stat-number">{{ $totalPeminjaman }}</div>
            <div class="stat-label">TOTAL PEMINJAMAN</div>
        </div>

        <div class="stat-item">
            <div class="stat-number">{{ $peminjamanAktif }}</div>
            <div class="stat-label">SEDANG DIPINJAM</div>
        </div>

        <div class="stat-item">
            <div class="stat-number">{{ $peminjamanDikembalikan }}</div>
            <div class="stat-label">DIKEMBALIKAN</div>
        </div>

        <div class="stat-item">
            <div class="stat-number">Rp {{ number_format($totalDenda, 0, ',', '.') }}</div>
            <div class="stat-label">TOTAL DENDA</div>
        </div>
    </div>


    <!-- Info Periode -->
    <div class="info" style="margin-bottom: 20px;">
        <strong>Periode:</strong> {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} -
        {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}<br>

        <strong>Jenis Data:</strong> {{ ucfirst($jenisData) }}<br>

        <strong>Tanggal Cetak:</strong> {{ \Carbon\Carbon::now()->format('d M Y H:i') }}
    </div>


    <!-- ============================= -->
    <!-- DETAIL LAPORAN SESUAI JENIS   -->
    <!-- ============================= -->

    @if($jenisData == 'peminjaman')

        <h3>Detail Peminjaman</h3>

        @if($peminjaman->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Peminjam</th>
                        <th>Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Batas Kembali</th>
                        <th>Status</th>
                        <th>Denda</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peminjaman as $key => $p)
                        @php
                            $tanggalPinjam = \Carbon\Carbon::parse($p->tanggal_pinjam);
                            $batasKembali = \Carbon\Carbon::parse($p->tanggal_kembali);
                        @endphp
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $p->user->name ?? 'N/A' }}</td>
                            <td>{{ $p->buku->judul ?? 'N/A' }}</td>
                            <td>{{ $tanggalPinjam->format('d M Y') }}</td>
                            <td>{{ $batasKembali->format('d M Y') }}</td>
                            <td><span class="badge badge-warning">Dipinjam</span></td>
                            <td>
                                @if($p->denda > 0)
                                    Rp {{ number_format($p->denda, 0, ',', '.') }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="text-align:center;color:#666;font-style:italic;">Tidak ada data peminjaman.</p>
        @endif


    @elseif($jenisData == 'pengembalian')

        <h3>Detail Pengembalian</h3>

        @if($pengembalian->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Peminjam</th>
                        <th>Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Batas Kembali</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th>Denda</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengembalian as $key => $p)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $p->user->name }}</td>
                            <td>{{ $p->buku->judul }}</td>
                            <td>{{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d M Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($p->tanggal_kembali)->format('d M Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($p->tanggal_pengembalian)->format('d M Y') }}</td>
                            <td><span class="badge badge-success">Dikembalikan</span></td>
                            <td>
                                @if($p->denda > 0)
                                    Rp {{ number_format($p->denda, 0, ',', '.') }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="text-align:center;color:#666;font-style:italic;">Tidak ada data pengembalian.</p>
        @endif


    @elseif($jenisData == 'buku')

        <h3>Data Buku</h3>

        @if($buku->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>Tahun</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($buku as $key => $b)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $b->judul }}</td>
                            <td>{{ $b->penulis }}</td>
                            <td>{{ $b->penerbit }}</td>
                            <td>{{ $b->tahun_terbit }}</td>
                            <td>{{ $b->stok }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="text-align:center;color:#666;font-style:italic;">Tidak ada data buku.</p>
        @endif


    @elseif($jenisData == 'anggota')

        <h3>Data Anggota</h3>

        @if($anggota->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($anggota as $key => $a)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $a->name }}</td>
                            <td>{{ $a->email }}</td>
                            <td>{{ $a->telepon ?? '-' }}</td>
                            <td>{{ $a->alamat ?? '-' }}</td>
                            <td>{{ ucfirst($a->role) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="text-align:center;color:#666;font-style:italic;">Tidak ada data anggota.</p>
        @endif
    @else

        <p style="text-align:center;color:#666;font-style:italic;">
            Tidak ada data untuk jenis laporan yang dipilih.
        </p>

    @endif


    <!-- Footer -->
    <div class="footer">
        Dicetak oleh: {{ Auth::user()->name }}<br>
        {{ \Carbon\Carbon::now()->format('d M Y H:i:s') }}
    </div>

    <div class="no-print" style="text-align:center;margin-top:20px;">
        <button onclick="window.print()" style="padding:10px 20px;background:#007bff;color:#fff;border:none;border-radius:5px;">
            🖨️ Cetak Laporan
        </button>
        <button onclick="window.close()" style="padding:10px 20px;background:#6c757d;color:#fff;border:none;border-radius:5px;margin-left:10px;">
            ❌ Tutup
        </button>
    </div>

    <script>
        window.onload = () => setTimeout(() => window.print(), 500);
    </script>

</body>
</html>
