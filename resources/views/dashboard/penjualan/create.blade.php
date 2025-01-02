<x-layout>
    <div class="card">
        <div class="card-body">
            <h3 class=" fw-semibold">Tambah Data Penjualan </h3>
            <p class="mb-0">Tambah data transaksi penjualan baru lengkap dengan detail produk dan jumlah yang terjual.
            </p>
            <div class="mt-4">
                <form action="{{ route('penjualan.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="stokis_id" class="form-label">Pilih Stokis</label>
                        <select name="stokis_id" id="stokis_id" class="form-select" required>
                            <option value="">-- Pilih Stokis --</option>
                            @foreach ($stokis as $stokisItem)
                                <option value="{{ $stokisItem->id }}">
                                    {{ $stokisItem->kokab->nama_kokab ?? 'Tanpa Kokab' }} -
                                    {{ $stokisItem->kecamatan->nama_kecamatan ?? 'Tanpa Kecamatan' }} -
                                    {{ $stokisItem->nama_stokis }} -
                                    {{ $stokisItem->member }} -
                                    {{ $stokisItem->nama_member }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="quartal" class="form-label">Pilih Quartal</label>
                        <select name="quartal" id="quartal" class="form-select" required>
                            <option value="">-- Pilih Quartal --</option>
                            <option value="Q1">Q1 (Jan-Mar)</option>
                            <option value="Q2">Q2 (Apr-Jun)</option>
                            <option value="Q3">Q3 (Jul-Sep)</option>
                            <option value="Q4">Q4 (Oct-Dec)</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tahun" class="form-label">Pilih Tahun</label>
                        <select name="tahun" id="tahun" class="form-select" required>
                            <option value="">-- Pilih Tahun --</option>
                            @foreach ($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="quartal-fields" class="row g-3">
                        <div class="col-md-4 jan-mar">
                            <label for="jan" class="form-label">Jan</label>
                            <input type="number" name="jan" id="jan" class="form-control" placeholder="0"
                                min="0">
                        </div>
                        <div class="col-md-4 jan-mar">
                            <label for="feb" class="form-label">Feb</label>
                            <input type="number" name="feb" id="feb" class="form-control" placeholder="0"
                                min="0">
                        </div>
                        <div class="col-md-4 jan-mar">
                            <label for="mar" class="form-label">Mar</label>
                            <input type="number" name="mar" id="mar" class="form-control" placeholder="0"
                                min="0">
                        </div>
                        <div class="col-md-4 apr-jun">
                            <label for="apr" class="form-label">Apr</label>
                            <input type="number" name="apr" id="apr" class="form-control" placeholder="0"
                                min="0">
                        </div>
                        <div class="col-md-4 apr-jun">
                            <label for="mei" class="form-label">Mei</label>
                            <input type="number" name="mei" id="mei" class="form-control" placeholder="0"
                                min="0">
                        </div>
                        <div class="col-md-4 apr-jun">
                            <label for="jun" class="form-label">Jun</label>
                            <input type="number" name="jun" id="jun" class="form-control" placeholder="0"
                                min="0">
                        </div>
                        <div class="col-md-4 jul-sep">
                            <label for="jul" class="form-label">Jul</label>
                            <input type="number" name="jul" id="jul" class="form-control" placeholder="0"
                                min="0">
                        </div>
                        <div class="col-md-4 jul-sep">
                            <label for="agt" class="form-label">Agt</label>
                            <input type="number" name="agt" id="agt" class="form-control"
                                placeholder="0" min="0">
                        </div>
                        <div class="col-md-4 jul-sep">
                            <label for="sep" class="form-label">Sep</label>
                            <input type="number" name="sep" id="sep" class="form-control"
                                placeholder="0" min="0">
                        </div>
                        <div class="col-md-4 okt-des">
                            <label for="okt" class="form-label">Okt</label>
                            <input type="number" name="okt" id="okt" class="form-control"
                                placeholder="0" min="0">
                        </div>
                        <div class="col-md-4 okt-des">
                            <label for="nov" class="form-label">Nov</label>
                            <input type="number" name="nov" id="nov" class="form-control"
                                placeholder="0" min="0">
                        </div>
                        <div class="col-md-4 okt-des">
                            <label for="des" class="form-label">Des</label>
                            <input type="number" name="des" id="des" class="form-control"
                                placeholder="0" min="0">
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('quartal').addEventListener('change', function() {
            const quartalSections = {
                Q1: ['jan-mar'],
                Q2: ['apr-jun'],
                Q3: ['jul-sep'],
                Q4: ['okt-des']
            };

            // Sembunyikan semua field terlebih dahulu
            document.querySelectorAll('#quartal-fields .col-md-4').forEach(section => {
                section.style.display = 'none';
            });

            const selectedQuartal = this.value;

            if (selectedQuartal && quartalSections[selectedQuartal]) {
                // Tampilkan hanya field yang sesuai dengan quartal terpilih
                quartalSections[selectedQuartal].forEach(className => {
                    document.querySelectorAll(`#quartal-fields .${className}`).forEach(section => {
                        section.style.display = 'block'; // Tampilkan elemen yang sesuai
                    });
                });
            }
        });

        // Trigger perubahan untuk inisialisasi awal
        document.getElementById('quartal').dispatchEvent(new Event('change'));
    </script>
</x-layout>
