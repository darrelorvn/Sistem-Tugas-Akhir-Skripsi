<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Fasilitas Ruang</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card border-0 shadow-sm mx-auto" style="max-width: 750px;">
        <div class="card-body p-4 p-md-5">

            <h2 class="fw-bold mb-1">Edit Fasilitas Ruang</h2>
            <p class="text-secondary mb-4">
                Perbarui informasi fasilitas proyektor dan PC di ruangan.
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

            <form action="{{ route('fasilitas.update', $fasilitas->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_ruang" class="form-label">Nama Ruang</label>
                    <input type="text" id="nama_ruang" name="nama_ruang"
                           class="form-control"
                           list="daftar-ruang"
                           value="{{ old('nama_ruang', $fasilitas->nama_ruang) }}" required>
                    <datalist id="daftar-ruang">
                        @foreach ($ruangs as $r)
                            <option value="{{ $r->nama_ruang }}"></option>
                        @endforeach
                    </datalist>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="proyektor" class="form-label">Proyektor</label>
                        <select id="proyektor" name="proyektor" class="form-select" required>
                            <option value="Ada" {{ old('proyektor', $fasilitas->proyektor) === 'Ada' ? 'selected' : '' }}>Ada</option>
                            <option value="Tidak Ada" {{ old('proyektor', $fasilitas->proyektor) === 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="pc" class="form-label">PC</label>
                        <select id="pc" name="pc" class="form-select" required>
                            <option value="Ada" {{ old('pc', $fasilitas->pc) === 'Ada' ? 'selected' : '' }}>Ada</option>
                            <option value="Tidak Ada" {{ old('pc', $fasilitas->pc) === 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('fasilitas.index') }}" class="btn btn-outline-secondary">
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
