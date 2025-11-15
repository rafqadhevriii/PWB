<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnggotaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|unique:users,email',
            'alamat'  => 'required|string|max:255',
            'no_telp' => 'required|string|max:15', 
            'password'=> 'required|min:6|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'Nama wajib diisi.',
            'email.required'   => 'Email wajib diisi.',
            'email.email'      => 'Format email tidak valid.',
            'email.unique'     => 'Email sudah digunakan.',
            'alamat.required'  => 'Alamat wajib diisi.',
            'no_telp.required' => 'Nomor telepon wajib diisi.',
            'no_telp.string'   => 'Nomor telepon harus berupa teks.',
            'password.required'=> 'Password wajib diisi.',
            'password.min'     => 'Password minimal 6 karakter.',
            'password.confirmed'=> 'Konfirmasi password tidak cocok.',
        ];
    }
}
