<x-layout>
    <div class="card">
        <div class="card-body">
            <h3 class="fw-semibold">Tambah Kota/Kabupaten</h3>
            <p class="mb-0">Masukkan informasi kota baru yang terkait dengan distribusi atau penjualan.
            </p>
            <div class="mt-4">
                <form action="{{ route('kokab.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_kokab" class="form-label">Nama Kokab</label>
                        <input type="text" class="form-control" id="nama_kokab" name="nama_kokab" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
