<x-layout>
    <div class="card">
        <div class="card-body">
            <h3 class="fw-semibold">Edit Kota/Kabupaten</h3>
            <p class="mb-0">Perbarui data kota yang sudah ada untuk memastikan keakuratan informasi.</p>
            <div class="mt-4">
                <form action="{{ route('kokab.update', $kokab->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nama_kokab" class="form-label">Nama Kokab</label>
                        <input type="text" class="form-control" id="nama_kokab" name="nama_kokab"
                            value="{{ $kokab->nama_kokab }}" required>
                    </div>
                    <button type="submit" class="btn btn-warning">Update</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
