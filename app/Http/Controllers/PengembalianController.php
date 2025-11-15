<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Carbon\Carbon;

class PengembalianController extends Controller
{
    /**
     * Menampilkan daftar semua data pengembalian.
     */
    public function index()
    {
        $pengembalian = Peminjaman::with(['user','buku'])
            ->where('status','dikembalikan')
            ->orderBy('tanggal_pengembalian','desc') // ← ganti dari tanggal_dikembalikan
            ->get();

            return view('dataPengembalian', compact('pengembalian'));
        }

    /**
     * Proses pengembalian buku dan hitung denda jika terlambat.
     */
   public function kembalikan($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $tanggalKembali = Carbon::now();
        $jatuhTempo = Carbon::parse($peminjaman->tanggal_kembali);
        $terlambat = $tanggalKembali->gt($jatuhTempo) ? $tanggalKembali->diffInDays($jatuhTempo) : 0;
        $denda = $terlambat * 1000;

        $peminjaman->update([
            'tanggal_pengembalian' => $tanggalKembali->toDateTimeString(),
            'status' => 'dikembalikan',
            'denda' => $denda,
            // Jika mau bisa ambil keterangan dari request, kalau kosong pakai default
            'keterangan' => request('keterangan') ?? 'Tidak ada keterangan',
        ]);

        return redirect()->route('dataPengembalian')->with('success', 'Buku berhasil dikembalikan!');
    }

    /**
     * Menampilkan data pengembalian untuk halaman khusus.
     */
    public function dataPengembalian()
    {
        $pengembalian = Peminjaman::with(['user', 'buku'])
            ->where('status', 'dikembalikan')
            ->orderBy('tanggal_dikembalikan', 'desc')
            ->get();

        return view('dataPengembalian', compact('pengembalian'));
    }

    /**
     * Fungsi tambahan untuk menghitung denda (bisa juga dipakai di tempat lain).
     */
    private function hitungDenda($tanggal_pengembalian, $tanggal_dikembalikan)
    {
        $jatuhTempo = Carbon::parse($tanggal_pengembalian);
        $dikembalikan = Carbon::parse($tanggal_dikembalikan);

        $terlambat = $dikembalikan->gt($jatuhTempo)
            ? $dikembalikan->diffInDays($jatuhTempo)
            : 0;

        return $terlambat * 1000; // Rp1.000 per hari
    }
}
