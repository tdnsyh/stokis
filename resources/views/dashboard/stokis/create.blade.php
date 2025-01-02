<x-layout>
    <div class="card">
        <div class="card-body">
            <h3 class=" fw-semibold">Tambah Data Stokis </h3>
            <p class="mb-0">Masukkan informasi baru mengenai stokis untuk memperbarui data yang ada.</p>
            <div class="mt-4">
                <form action="{{ route('stokis.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="kokab_id" class="form-label">Nama Kokab</label>
                        <select class="form-select" id="kokab_id" name="kokab_id" required>
                            <option value="">Pilih Kokab</option>
                            @foreach ($kokabs as $kokab)
                                <option value="{{ $kokab->id }}" @if (old('kokab_id') == $kokab->id) selected @endif>
                                    {{ $kokab->nama_kokab }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kecamatan_id" class="form-label">Nama Kecamatan</label>
                        <select class="form-select" id="kecamatan_id" name="kecamatan_id" required>
                            <option value="">Pilih Kecamatan</option>
                            @foreach ($kecamatans as $kecamatan)
                                <option value="{{ $kecamatan->id }}" data-kokab_id="{{ $kecamatan->kokab_id }}">
                                    {{ $kecamatan->nama_kecamatan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nama_stokis" class="form-label">Nama Stokis</label>
                        <input type="text" class="form-control" id="nama_stokis" name="nama_stokis" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">No HP</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                    </div>
                    <div class="mb-3">
                        <label for="member" class="form-label">Member</label>
                        <input type="text" class="form-control" id="member" name="member" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_member" class="form-label">Nama Member</label>
                        <input type="text" class="form-control" id="nama_member" name="nama_member" required>
                    </div>
                    <div class="back">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('stokis.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('kokab_id').addEventListener('change', function() {
            var kokab_id = this.value;
            var kecamatanOptions = document.querySelectorAll('#kecamatan_id option');
            var kecamatanSelect = document.getElementById('kecamatan_id');

            kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            kecamatanOptions.forEach(function(option) {
                if (option.getAttribute('data-kokab_id') == kokab_id || kokab_id === "") {
                    kecamatanSelect.appendChild(option);
                }
            });
        });
    </script>
</x-layout>
