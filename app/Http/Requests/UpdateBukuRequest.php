<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBukuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'gambar'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Ubah menjadi file upload
            'judul'        => 'required|string|max:255',
            'penulis'      => 'required|string|max:255',
            'penerbit'     => 'required|string|max:255',
            'tahun_terbit' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'stok'         => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'gambar.image'          => 'File harus berupa gambar.',
            'gambar.mimes'          => 'Gambar harus berformat JPG, JPEG, atau PNG.',
            'gambar.max'            => 'Ukuran gambar maksimal 2MB.',
            'judul.required'        => 'Judul buku wajib diisi.',
            'penulis.required'      => 'Nama penulis wajib diisi.',
            'penerbit.required'     => 'Nama penerbit wajib diisi.',
            'tahun_terbit.required' => 'Tahun terbit wajib diisi.',
            'tahun_terbit.digits'   => 'Tahun terbit harus 4 digit.',
            'stok.required'         => 'Stok wajib diisi.',
            'stok.integer'          => 'Stok harus berupa angka.',
        ];
    }
}
