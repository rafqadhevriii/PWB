<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Http\Requests\StoreBukuRequest;
use App\Http\Requests\UpdateBukuRequest;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::all();
        return view('buku.index', compact('buku'));
    }

    public function create()
    {
        return view('buku.create');
    }

    public function store(StoreBukuRequest $request)
    {
        $validated = $request->validated();

        // Handle upload gambar
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('buku-images', 'public');
            $validated['gambar'] = $gambarPath;
        }

        Buku::create($validated);

        return redirect()->route('dataBuku')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        return view('buku.edit', compact('buku'));
    }

    public function update(UpdateBukuRequest $request, $id)
    {
        $buku = Buku::findOrFail($id);
        $validated = $request->validated();

        // Handle upload gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($buku->gambar && Storage::disk('public')->exists($buku->gambar)) {
                Storage::disk('public')->delete($buku->gambar);
            }

            $gambarPath = $request->file('gambar')->store('buku-images', 'public');
            $validated['gambar'] = $gambarPath;
        } else {
            // Jika tidak ada gambar baru, pertahankan gambar lama
            unset($validated['gambar']);
        }

        $buku->update($validated);

        return redirect()->route('dataBuku')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);

        // Hapus gambar dari storage
        if ($buku->gambar && Storage::disk('public')->exists($buku->gambar)) {
            Storage::disk('public')->delete($buku->gambar);
        }

        $buku->delete();

        return redirect()->route('dataBuku')->with('success', 'Buku berhasil dihapus.');
    }

    public function katalogBuku()
    {
        $query = Buku::where('stok', '>', 0);

        if ($search = request('search')) {
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('penulis', 'like', "%{$search}%")
                  ->orWhere('penerbit', 'like', "%{$search}%");
            });
        }

        $buku = $query->paginate(9);
        return view('katalogBuku', compact('buku'));
    }

}