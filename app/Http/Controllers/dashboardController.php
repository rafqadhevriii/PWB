<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Jika yang login adalah ADMIN
        if (Auth::user()->role === 'admin') {
            return view('dashboard', [
                // Hitung jumlah anggota (user biasa)
                'totalAnggota' => User::where('role', 'user')->count(),

                // Hitung total buku
                'totalBuku' => Buku::count(),

                // Hitung total buku yang sedang dipinjam
                'totalPeminjaman' => Peminjaman::where('status', 'dipinjam')->count(),

                // Buku yang dikembalikan hari ini
                'totalPengembalian' => Peminjaman::where('status', 'dikembalikan')
                    ->whereDate('tanggal_pengembalian', today())
                    ->count(),
            ]);
        }

        // Jika yang login adalah USER
        else {
            $userId = Auth::id();

            return view('dashboard', [
                // Cocok dengan Blade: $bukuDipinjam
                'bukuDipinjam' => Peminjaman::where('user_id', $userId)
                    ->where('status', 'dipinjam')
                    ->count(),

                // Cocok dengan Blade: $belumDikembalikan
                'belumDikembalikan' => Peminjaman::where('user_id', $userId)
                    ->where('status', 'dipinjam')
                    ->where('tanggal_pengembalian', '<', now())
                    ->count(),
            ]);
        }
    }
}
