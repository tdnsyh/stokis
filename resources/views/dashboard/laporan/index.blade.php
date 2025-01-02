<x-layout>
    <div class="card">
        <div class="card-body">
            <h3 class="fw-semibold">Laporan</h3>
            <p class="mb-0">Akses laporan menyeluruh mengenai data stokis, penjualan, dan wilayah untuk analisis lebih
                lanjut.
            </p>
            <div class="mt-4">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                            type="button" role="tab" aria-controls="nav-home" aria-selected="true">Laporan data
                            penjualan</button>
                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                            type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Laporan
                            data stokis</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                        tabindex="0">
                        <form method="GET" action="{{ route('laporan.index') }}" class="row g-3 mb-4 mt-3">
                            <div class="col-md-3">
                                <label for="tahun" class="form-label">Tahun</label>
                                <select name="tahun" id="tahun" class="form-select">
                                    <option value="">Semua Tahun</option>
                                    @foreach ($filterOptions['tahun'] as $filterTahun)
                                        <option value="{{ $filterTahun }}"
                                            {{ $filterTahun == request('tahun') ? 'selected' : '' }}>
                                            {{ $filterTahun }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="kokab" class="form-label">Kota/Kabupaten</label>
                                <select name="kokab" id="kokab" class="form-select">
                                    <option value="">Semua Kokab</option>
                                    @foreach ($filterOptions['kokab'] as $id => $namaKokab)
                                        <option value="{{ $id }}"
                                            {{ $id == request('kokab') ? 'selected' : '' }}>
                                            {{ $namaKokab }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <select name="kecamatan" id="kecamatan" class="form-select">
                                    <option value="">Semua Kecamatan</option>
                                    @foreach ($filterOptions['kecamatan'] as $id => $namaKecamatan)
                                        <option value="{{ $id }}"
                                            {{ $id == request('kecamatan') ? 'selected' : '' }}>
                                            {{ $namaKecamatan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="stokis" class="form-label">Stokis</label>
                                <select name="stokis" id="stokis" class="form-select">
                                    <option value="">Semua Stokis</option>
                                    @foreach ($filterOptions['stokis'] as $filterStokis)
                                        <option value="{{ $filterStokis->id }}"
                                            {{ $filterStokis->id == request('stokis') ? 'selected' : '' }}>
                                            {{ $filterStokis->nama_stokis }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </form>
                        <div class="text-">
                            <button id="exportButton" class="btn btn-outline-success mb-3">Export data
                                penjualan</button>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="table-dark">
                                    <tr class="border-0">
                                        <th class="rounded-start">No</th>
                                        <th>Stokis</th>
                                        <th>Kokab</th>
                                        <th>Kecamatan</th>
                                        <th>No HP</th>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Tahun</th>
                                        <th>Jan</th>
                                        <th>Feb</th>
                                        <th>Mar</th>
                                        <th>Apr</th>
                                        <th>Mei</th>
                                        <th>Jun</th>
                                        <th>Jul</th>
                                        <th>Agt</th>
                                        <th>Sep</th>
                                        <th>Okt</th>
                                        <th>Nov</th>
                                        <th>Des</th>
                                        <th class="rounded-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stokis as $stokisData)
                                        @foreach ($stokisData->penjualan as $key => $penjualan)
                                            <tr>
                                                <td>{{ $loop->parent->index + 1 }}.{{ $key + 1 }}</td>
                                                <td>{{ $stokisData->nama_stokis }}</td>
                                                <td>{{ $stokisData->kokab->nama_kokab ?? '-' }}</td>
                                                <td>{{ $stokisData->kecamatan->nama_kecamatan ?? '-' }}</td>
                                                <td>{{ $stokisData->no_hp }}</td>
                                                <td>{{ $stokisData->member }}</td>
                                                <td>{{ $stokisData->nama_member }}</td>
                                                <td>{{ $penjualan->tahun }}</td>
                                                <td>{{ $penjualan->jan }}</td>
                                                <td>{{ $penjualan->feb }}</td>
                                                <td>{{ $penjualan->mar }}</td>
                                                <td>{{ $penjualan->apr }}</td>
                                                <td>{{ $penjualan->mei }}</td>
                                                <td>{{ $penjualan->jun }}</td>
                                                <td>{{ $penjualan->jul }}</td>
                                                <td>{{ $penjualan->agt }}</td>
                                                <td>{{ $penjualan->sep }}</td>
                                                <td>{{ $penjualan->okt }}</td>
                                                <td>{{ $penjualan->nov }}</td>
                                                <td>{{ $penjualan->des }}</td>
                                                <td>{{ $penjualan->total }}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"
                        tabindex="0">
                        <div class="mt-4">
                            <button id="exportButtonn" class="btn btn-outline-success mb-3">Export data stokis</button>
                            <div class="table-responsive">
                                <table id="stokisTable" class="table">
                                    <thead class="table-dark">
                                        <tr class="border-0">
                                            <th class="rounded-start">No</th>
                                            <th>Stokis</th>
                                            <th>Kokab</th>
                                            <th>Kecamatan</th>
                                            <th>No HP</th>
                                            <th>ID</th>
                                            <th class="rounded-end">Member</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($stokis as $key => $stokisData)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $stokisData->nama_stokis }}</td>
                                                <td>{{ $stokisData->kokab->nama_kokab ?? '-' }}</td>
                                                <td>{{ $stokisData->kecamatan->nama_kecamatan ?? '-' }}</td>
                                                <td>{{ $stokisData->no_hp }}</td>
                                                <td>{{ $stokisData->member }}</td>
                                                <td>{{ $stokisData->nama_member }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.2/xlsx.full.min.js"></script>
    <script>
        document.getElementById('exportButton').addEventListener('click', function() {
            var wb = XLSX.utils.table_to_book(document.querySelector('table'), {
                sheet: "Sheet 1"
            });
            XLSX.writeFile(wb, 'tabel_data.xlsx');
        });
    </script>
    <script>
        document.getElementById('exportButtonn').addEventListener('click', function() {
            const rows = Array.from(document.querySelectorAll('#stokisTable tbody tr'));

            let sheetData = [
                ["No", "Stokis", "Kokab", "Kecamatan", "No HP", "ID", "Nama", "Member"],
            ];

            rows.forEach(row => {
                const rowData = Array.from(row.cells).map(cell => cell.textContent);
                sheetData.push(rowData);
            });

            const wb = XLSX.utils.book_new();

            const sheet = XLSX.utils.aoa_to_sheet(sheetData);
            XLSX.utils.book_append_sheet(wb, sheet, 'Stokis Data');

            XLSX.writeFile(wb, 'stokis_data.xlsx');
        });
    </script>
</x-layout>
