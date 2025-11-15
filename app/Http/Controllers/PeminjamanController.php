<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    // 🔹 Menampilkan daftar peminjaman (admin)
    public function index()
    {
        $peminjaman = Peminjaman::with(['user','buku'])
            ->where('status', 'dipinjam')
            ->latest()
            ->get();

        return view('dataPeminjaman', compact('peminjaman'));
    }

    // 🔹 Proses meminjam buku (user)
    public function pinjamBuku($bukuId)
    {
        $user = Auth::user();
        $buku = Buku::findOrFail($bukuId);

        if (!$buku->isAvailable()) {
            return back()->with('error', 'Stok buku habis');
        }

        if ($user->isBorrowing($bukuId)) {
            return back()->with('error', 'Buku ini belum kamu kembalikan');
        }

        $pinjam = Peminjaman::create([
            'user_id' => $user->id,
            'buku_id' => $bukuId,
            'tanggal_pinjam' => Carbon::now(),
            'tanggal_kembali' => Carbon::now()->addDays(7),
            'status' => 'dipinjam'
        ]);

        $buku->decreaseStock();

        return back()->with('success', 'Berhasil meminjam buku');
    }

    // 🔹 Menampilkan riwayat peminjaman (user)
    public function riwayatPeminjaman()
    {
        $user = Auth::user();

        $peminjaman = Peminjaman::with('buku')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dataPeminjaman', compact('peminjaman'));
    }

    // 🔹 Mengembalikan buku (user)
    public function kembalikanBuku($id)
    {
        $p = Peminjaman::with('buku')->findOrFail($id);

        if (Auth::id() !== $p->user_id) {
            return back()->with('error', 'Anda tidak memiliki akses.');
        }

        if ($p->status === 'dikembalikan') {
            return back()->with('error', 'Buku sudah dikembalikan.');
        }

        $now = Carbon::now();

        $hariTerlambat = Carbon::parse($p->tanggal_kembali)
            ->diffInDays($now, false);

        $denda = $hariTerlambat > 0 ? $hariTerlambat * 5000 : 0;

        $p->update([
            'status' => 'dikembalikan',
            'tanggal_pengembalian' => $now,
            'denda' => $denda
        ]);

        $p->buku->increment('stok');

        return back()->with('success', 'Buku berhasil dikembalikan.');
    }

    // 🔹 Menghapus peminjaman (admin)
    public function destroy($id)
    {
        $p = Peminjaman::findOrFail($id);
        $p->delete();

        return back()->with('success', 'Data peminjaman berhasil dihapus.');
    }
}
