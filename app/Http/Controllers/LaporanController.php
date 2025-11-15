<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Filter tanggal
        $startDate = $request->get('start_date', Carbon::now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::now()->format('Y-m-d'));
        $jenisData = $request->get('jenis_data', 'peminjaman');

        // Statistik
        $totalBuku = Buku::count();
        $totalAnggota = User::where('role', 'user')->count();
        $totalPeminjaman = Peminjaman::whereBetween('created_at', [$startDate, $endDate])->count();
        $peminjamanAktif = Peminjaman::where('status', 'dipinjam')->count();
        $peminjamanDikembalikan = Peminjaman::where('status', 'dikembalikan')
            ->whereBetween('tanggal_pengembalian', [$startDate, $endDate])
            ->count();
        $totalDenda = Peminjaman::whereBetween('tanggal_pengembalian', [$startDate, $endDate])
            ->sum('denda');

        // Data utama (semua peminjaman)
        $peminjamanDetail = Peminjaman::with(['user', 'buku'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'desc')
            ->get();

        // Filter berdasarkan jenis data
        $peminjaman = collect();
        $pengembalian = collect();
        $buku = collect();
        $anggota = collect();

        if ($jenisData === 'peminjaman') {
            $peminjaman = Peminjaman::with(['user', 'buku'])
                ->whereBetween('created_at', [$startDate, $endDate])
                ->orderBy('created_at', 'desc')
                ->get();
        }

        if ($jenisData === 'pengembalian') {
            $pengembalian = Peminjaman::with(['user', 'buku'])
                ->where('status', 'dikembalikan')
                ->whereBetween('tanggal_pengembalian', [$startDate, $endDate])
                ->orderBy('tanggal_pengembalian', 'desc')
                ->get();
        }

        if ($jenisData === 'buku') {
            $buku = Buku::orderBy('judul', 'asc')->get();
        }

        if ($jenisData === 'anggota') {
            $anggota = User::where('role', 'user')->orderBy('name', 'asc')->get();
        }

        return view('dataLaporan', compact(
            'totalBuku',
            'totalAnggota',
            'totalPeminjaman',
            'peminjamanAktif',
            'peminjamanDikembalikan',
            'totalDenda',
            'peminjamanDetail',
            'peminjaman',
            'pengembalian',
            'buku',
            'anggota',
            'startDate',
            'endDate',
            'jenisData'
        ));
    }

    public function cetakLaporan(Request $request)
    {
        // Sama seperti index
        $startDate = $request->get('start_date', Carbon::now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::now()->format('Y-m-d'));
        $jenisData = $request->get('jenis_data', 'peminjaman');

        $totalBuku = Buku::count();
        $totalAnggota = User::where('role', 'user')->count();
        $totalPeminjaman = Peminjaman::whereBetween('created_at', [$startDate, $endDate])->count();
        $peminjamanAktif = Peminjaman::where('status', 'dipinjam')->count();
        $peminjamanDikembalikan = Peminjaman::where('status', 'dikembalikan')
            ->whereBetween('tanggal_pengembalian', [$startDate, $endDate])
            ->count();
        $totalDenda = Peminjaman::whereBetween('tanggal_pengembalian', [$startDate, $endDate])
            ->sum('denda');

        $peminjamanDetail = Peminjaman::with(['user', 'buku'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'desc')
            ->get();

        $peminjaman = collect();
        $pengembalian = collect();
        $buku = collect();
        $anggota = collect();

        if ($jenisData === 'peminjaman') {
            $peminjaman = Peminjaman::with(['user', 'buku'])
                ->whereBetween('created_at', [$startDate, $endDate])
                ->orderBy('created_at', 'desc')
                ->get();
        }

        if ($jenisData === 'pengembalian') {
            $pengembalian = Peminjaman::with(['user', 'buku'])
                ->where('status', 'dikembalikan')
                ->whereBetween('tanggal_pengembalian', [$startDate, $endDate])
                ->orderBy('tanggal_pengembalian', 'desc')
                ->get();
        }

        if ($jenisData === 'buku') {
            $buku = Buku::orderBy('judul', 'asc')->get();
        }

        if ($jenisData === 'anggota') {
            $anggota = User::where('role', 'user')->orderBy('name', 'asc')->get();
        }

        return view('cetakLaporan', compact(
            'totalBuku',
            'totalAnggota',
            'totalPeminjaman',
            'peminjamanAktif',
            'peminjamanDikembalikan',
            'totalDenda',
            'peminjamanDetail',
            'peminjaman',
            'pengembalian',
            'buku',
            'anggota',
            'startDate',
            'endDate',
            'jenisData'
        ));
    }
}
