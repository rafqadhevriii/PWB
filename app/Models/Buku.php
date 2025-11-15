<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = [
        'gambar',
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'stok',
    ];

    // Relasi ke peminjaman

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }

    // Cek apakah buku tersedia untuk dipinjam
    public function isAvailable()
    {
        return $this->stok > 0;
    }

    // Kurangi stok
    public function decreaseStock()
    {
        $this->decrement('stok');
    }

    // Tambah stok
    public function increaseStock()
    {
        $this->increment('stok');
    }
}
