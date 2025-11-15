<x-layoutAdmin>
<div class="container mt-3">
    <h2>Profil Saya</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="row">
        <div class="col-md-4">
            <img src="{{ $user->foto ? Storage::url($user->foto) : asset('default-profile.png') }}"
                 alt="Foto Profil" class="img-thumbnail">
        </div>
        <div class="col-md-8">
            <p><strong>Nama:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Telepon:</strong> {{ $user->no_telp ?? '-' }}</p>
            <p><strong>Alamat:</strong> {{ $user->alamat ?? '-' }}</p>
            <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profil</a>
        </div>
    </div>
</div>
</x-layoutAdmin>
