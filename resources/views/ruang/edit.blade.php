<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Ruang Sidang</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card border-0 shadow-sm mx-auto" style="max-width: 750px;">
        <div class="card-body p-4 p-md-5">

            <h2 class="fw-bold mb-1">Edit Ruang Sidang</h2>
            <p class="text-secondary mb-4">
                Perbarui informasi ruang ujian/sidang.
            </p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('ruang.update', $ruang->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_ruang" class="form-label">Nama Ruang</label>
                    <input type="text" id="nama_ruang" name="nama_ruang"
                           class="form-control"
                           value="{{ old('nama_ruang', $ruang->nama_ruang) }}" required>
                </div>

                <div class="mb-4">
                    <label for="gedung" class="form-label">Gedung</label>
                    <input type="text" id="gedung" name="gedung"
                           class="form-control"
                           list="daftar-gedung"
                           value="{{ old('gedung', $ruang->gedung) }}" required>
                    <datalist id="daftar-gedung">
                        @foreach ($gedungs as $g)
                            <option value="{{ $g->nama_gedung }}"></option>
                        @endforeach
                    </datalist>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('ruang.index') }}" class="btn btn-outline-secondary">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Simpan Perubahan
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
