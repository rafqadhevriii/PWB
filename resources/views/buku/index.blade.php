<x-layoutAdmin>
    <section class="content-header">
        <div class="container-fluid">
            <h4>Data Buku</h4>
            <a href="{{ route('createDataBuku') }}" class="btn btn-primary mb-3">
                <i class="fas fa-plus"></i> Tambah Buku
            </a>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Buku</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Gambar</th>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Penerbit</th>
                                <th>Tahun Terbit</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($buku as $b)
                            <tr>
                                <td>
                                    @if($b->gambar)
                                        <img src="{{ asset('storage/' . $b->gambar) }}" alt="Gambar buku" width="60" height="80" style="object-fit: cover;">
                                    @else
                                        <div class="text-center text-muted" style="width: 60px; height: 80px; background: #f8f9fa; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-book"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $b->judul }}</td>
                                <td>{{ $b->penulis }}</td>
                                <td>{{ $b->penerbit }}</td>
                                <td>{{ $b->tahun_terbit }}</td>
                                <td>
                                    <span class="badge {{ $b->stok > 0 ? 'badge-success' : 'badge-danger' }}">
                                        {{ $b->stok }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('editDataBuku', $b->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('deleteDataBuku', $b->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus buku ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</x-layoutAdmin>
