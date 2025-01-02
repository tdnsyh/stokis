<x-layout>
    <div class="card">
        <div class="card-body">
            <h3 class="fw-semibold">Tambah Kecamatan</h3>
            <p class="mb-0">Tambah informasi kecamatan baru yang relevan dalam sistem.</p>
            <div class="mt-4">
                <form action="{{ route('kecamatan.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="kokab_id" class="form-label">Nama Kokab</label>
                        <select class="form-select" id="kokab_id" name="kokab_id" required>
                            <option value="">Pilih Kokab</option>
                            @foreach ($kokabs as $kokab)
                                <option value="{{ $kokab->id }}">{{ $kokab->nama_kokab }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nama_kecamatan" class="form-label">Nama Kecamatan</label>
                        <input type="text" class="form-control" id="nama_kecamatan" name="nama_kecamatan" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
