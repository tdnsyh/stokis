<x-layout>
    <div class="card">
        <div class="card-body">
            <h3 class="fw-semibold">Data Stokis</h3>
            <p class="mb-0">Kelola dan perbarui informasi tentang stokis, termasuk menambah dan mengedit data stokis
                yang ada.
            </p>
            <div class="mt-4">
                <a href="{{ route('stokis.create') }}" class="btn btn-primary mb-3">Tambah Data</a>
                <x-alert></x-alert>
                <form action="{{ route('stokis.index') }}" method="GET" class="mb-3">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <select class="form-select" name="kecamatan_id">
                                <option value="">Pilih Kecamatan</option>
                                @foreach ($kecamatans as $kecamatan)
                                    <option value="{{ $kecamatan->id }}"
                                        {{ request('kecamatan_id') == $kecamatan->id ? 'selected' : '' }}>
                                        {{ $kecamatan->nama_kecamatan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <input type="text" name="search" class="form-control" value="{{ request('search') }}"
                                placeholder="Cari Stokis atau Member">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>
                @if ($stokis->isEmpty())
                    <div class="alert alert-warning" role="alert">
                        Belum ada data stokis.
                    </div>
                @else
                    <table class="table">
                        <thead class="table-dark">
                            <tr class="border-0">
                                <th class="rounded-start">No</th>
                                <th>Nama Stokis</th>
                                <th>Nama Member</th>
                                <th>No HP</th>
                                <th>Nama Kokab</th>
                                <th>Nama Kecamatan</th>
                                <th class="rounded-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stokis as $stokisItem)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $stokisItem->nama_stokis }}</td>
                                    <td>{{ $stokisItem->nama_member }}</td>
                                    <td>{{ $stokisItem->no_hp }}</td>
                                    <td>{{ $stokisItem->kokab->nama_kokab }}</td>
                                    <td>{{ $stokisItem->kecamatan->nama_kecamatan }}</td>
                                    <td>
                                        <a href="{{ route('stokis.edit', $stokisItem->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('stokis.destroy', $stokisItem->id) }}" method="POST"
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
