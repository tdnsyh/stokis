<x-layout>
    <div class="card">
        <div class="card-body">
            <h3 class="fw-semibold">Data Kota</h3>
            <p class="mb-0">Kelola data kota yang relevan untuk pengelolaan distribusi dan penjualan.</p>
            <div class="mt-4">
                <a href="{{ route('kokab.create') }}" class="btn btn-primary mb-3">Tambah Data</a>
                <x-alert></x-alert>
                @if ($kokabs->isEmpty())
                    <div class="alert alert-warning" role="alert">
                        Belum ada data kokab.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kokab</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kokabs as $kokab)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td> <!-- Menampilkan nomor urut -->
                                        <td>{{ $kokab->nama_kokab }}</td>
                                        <td>
                                            <a href="{{ route('kokab.edit', $kokab->id) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('kokab.destroy', $kokab->id) }}" method="POST"
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
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>
