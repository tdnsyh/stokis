<x-layout>
    <div class="card">
        <div class="card-body">
            <h3 class="fw-semibold">Data Kecamatan</h3>
            <p class="mb-0">Kelola data kecamatan yang terkait dengan wilayah distribusi dan penjualan produk.</p>
            <div class="mt-4">
                <a href="{{ route('kecamatan.create') }}" class="btn btn-primary mb-3">Tambah Data</a>
                <x-alert></x-alert>
                @if ($kecamatans->isEmpty())
                    <div class="alert alert-warning" role="alert">
                        Belum ada data kecamatan.
                    </div>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kecamatan</th>
                                <th>Nama Kokab</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kecamatans as $kecamatan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kecamatan->nama_kecamatan }}</td>
                                    <td>{{ $kecamatan->kokab->nama_kokab }}</td>
                                    <td>
                                        <a href="{{ route('kecamatan.edit', $kecamatan->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('kecamatan.destroy', $kecamatan->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-layout>
