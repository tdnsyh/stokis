<x-layout>
    <div class="card">
        <div class="card-body">
            <h3 class=" fw-semibold">Penjualan</h3>
            <p class="mb-0">Pantau dan kelola data penjualan yang sudah tercatat di sistem, termasuk transaksi dan
                status penjualan.
            </p>
            <div class="mt-4">
                <a href="{{ route('penjualan.create') }}" class="btn btn-primary mb-3">Tambah Data</a>
                <x-alert></x-alert>
                <label for="tahun" class="form-label">Filter Tahun</label>
                <div class="row row-cols-1 row-cols-md-2">
                    <div class="col">
                        <form method="GET" action="{{ route('penjualan.index') }}" class="mb-3">
                            <select name="tahun" id="tahun" class="form-select" onchange="this.form.submit()">
                                @for ($y = now()->year - 5; $y <= now()->year + 5; $y++)
                                    <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>
                                        {{ $y }}</option>
                                @endfor
                            </select>
                        </form>
                    </div>
                    <div class="col">
                        <form method="GET" action="{{ route('penjualan.index') }}" class="mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search"
                                    placeholder="Cari Nama Stokis, Member, atau Nama Member"
                                    value="{{ request()->get('search') }}">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr class="table-dark border-0">
                                <th class="rounded-start">No</th>
                                <th>Nama Stokis</th>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Q1</th>
                                <th>Q2</th>
                                <th>Q3</th>
                                <th>Q4</th>
                                <th>Total</th>
                                <th>Updated</th>
                                <th class="rounded-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stokis as $index => $stokisItem)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $stokisItem->nama_stokis }}</td>
                                    <td>{{ $stokisItem->member }}</td>
                                    <td>{{ $stokisItem->nama_member }}</td>
                                    <td>
                                        {{ $stokisItem->jan + $stokisItem->feb + $stokisItem->mar }}
                                    </td>
                                    <td>
                                        {{ $stokisItem->apr + $stokisItem->mei + $stokisItem->jun }}
                                    </td>
                                    <td>
                                        {{ $stokisItem->jul + $stokisItem->agt + $stokisItem->sep }}
                                    </td>
                                    <td>
                                        {{ $stokisItem->okt + $stokisItem->nov + $stokisItem->des }}
                                    </td>
                                    <td>{{ $stokisItem->total }}</td>
                                    <td>{{ $stokisItem->updated_at ? $stokisItem->updated_at->format('d M Y') : '-' }}
                                    </td>
                                    <td>
                                        <a href="{{ route('penjualan.detail', ['stokis_id' => $stokisItem->id]) }}"
                                            class="btn btn-info btn-sm">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layout>
