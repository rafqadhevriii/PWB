<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnggotaRequest;
use App\Http\Requests\UpdateAnggotaRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = User::all();
        return view('anggota.index', compact('anggota'));
    }

    public function create()
    {
        return view('anggota.create');
    }

    public function store(StoreAnggotaRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('dataAnggota')->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $anggota = User::findOrFail($id);
        return view('anggota.edit', compact('anggota'));
    }

    public function update(UpdateAnggotaRequest $request, $id)
    {
        $anggota = User::findOrFail($id);
        $validated = $request->validated();

        // Handle password - hanya update jika diisi
        if (empty($validated['password'])) {
            unset($validated['password']);
            unset($validated['password_confirmation']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        $anggota->update($validated);

        return redirect()->route('dataAnggota')->with('success', 'Anggota berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $anggota = User::findOrFail($id);
        $anggota->delete();

        return redirect()->route('dataAnggota')->with('success', 'Anggota berhasil dihapus.');
    }
}
