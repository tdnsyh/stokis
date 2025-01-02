<x-layout>
    <div class="card">
        <div class="card-body">
            <h3 class=" fw-semibold">Perbarui data stokis</h3>
            <p class="mb-0">Perbarui atau edit informasi stokis yang sudah terdaftar dalam sistem.</p>
            <div class="mt-4">
                <form action="{{ route('stokis.update', $stokis->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Dropdown Kokab yang tidak bisa dirubah -->
                    <div class="mb-3">
                        <label for="kokab_id" class="form-label">Nama Kokab</label>
                        <select class="form-select" id="kokab_id" name="kokab_id" disabled>
                            <option value="">Pilih Kokab</option>
                            @foreach ($kokabs as $kokab)
                                <option value="{{ $kokab->id }}" @if ($kokab->id == $stokis->kokab_id) selected @endif>
                                    {{ $kokab->nama_kokab }}
                                </option>
                            @endforeach
                        </select>
                        <!-- Hidden input untuk mengirim nilai kokab_id -->
                        <input type="hidden" name="kokab_id" value="{{ $stokis->kokab_id }}">
                    </div>

                    <!-- Dropdown Kecamatan yang tidak bisa dirubah -->
                    <div class="mb-3">
                        <label for="kecamatan_id" class="form-label">Nama Kecamatan</label>
                        <select class="form-select" id="kecamatan_id" name="kecamatan_id" disabled>
                            <option value="">Pilih Kecamatan</option>
                            @foreach ($kecamatans as $kecamatan)
                                <option value="{{ $kecamatan->id }}" @if ($kecamatan->id == $stokis->kecamatan_id) selected @endif>
                                    {{ $kecamatan->nama_kecamatan }}
                                </option>
                            @endforeach
                        </select>
                        <!-- Hidden input untuk mengirim nilai kecamatan_id -->
                        <input type="hidden" name="kecamatan_id" value="{{ $stokis->kecamatan_id }}">
                    </div>

                    <!-- Input untuk data lain yang bisa diubah -->
                    <div class="mb-3">
                        <label for="nama_stokis" class="form-label">Nama Stokis</label>
                        <input type="text" class="form-control" id="nama_stokis" name="nama_stokis"
                            value="{{ $stokis->nama_stokis }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="no_hp" class="form-label">No HP</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp"
                            value="{{ $stokis->no_hp }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="member" class="form-label">Member</label>
                        <input type="text" class="form-control" id="member" name="member"
                            value="{{ $stokis->member }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="nama_member" class="form-label">Nama Member</label>
                        <input type="text" class="form-control" id="nama_member" name="nama_member"
                            value="{{ $stokis->nama_member }}" required>
                    </div>
                    <div class="tpmbp">
                        <button type="submit" class="btn btn-warning">Update</button>
                        <a href="{{ route('stokis.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
