<x-layout>
    <div class="card">
        <div class="card-body">
            <h3 class="fw-semibold">Edit Kecamatan</h3>
            <p class="mb-0">Perbarui data kecamatan yang terdaftar untuk menjaga informasi yang up-to-date.</p>
            <div class="mt-4">
                <form action="{{ route('kecamatan.update', $kecamatan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="kokab_id" class="form-label">Nama Kokab</label>
                        <select class="form-select" id="kokab_id" name="kokab_id" required>
                            <option value="">Pilih Kokab</option>
                            @foreach ($kokabs as $kokab)
                                <option value="{{ $kokab->id }}" @if ($kokab->id == $kecamatan->kokab_id) selected @endif>
                                    {{ $kokab->nama_kokab }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nama_kecamatan" class="form-label">Nama Kecamatan</label>
                        <input type="text" class="form-control" id="nama_kecamatan" name="nama_kecamatan"
                            value="{{ $kecamatan->nama_kecamatan }}" required>
                    </div>
                    <button type="submit" class="btn btn-warning">Update</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
