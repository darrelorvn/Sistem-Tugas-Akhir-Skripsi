<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Dosen Pembimbing</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card border-0 shadow-sm mx-auto" style="max-width: 750px;">
        <div class="card-body p-4 p-md-5">

            <h2 class="fw-bold mb-1">Tambah Dosen Pembimbing</h2>
            <p class="text-secondary mb-4">
                Masukkan informasi profil dan kepakaran dosen pembimbing baru.
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

            <form action="{{ route('dosen.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="nidn" class="form-label">NIDN</label>
                        <input type="text" id="nidn" name="nidn"
                               class="form-control"
                               value="{{ old('nidn') }}" required>
                    </div>

                    <div class="col-md-7 mb-3">
                        <label for="nama" class="form-label">Nama Lengkap &amp; Gelar</label>
                        <input type="text" id="nama" name="nama"
                               class="form-control"
                               value="{{ old('nama') }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="jabatan" class="form-label">Jabatan Fungsional</label>
                        <input type="text" id="jabatan" name="jabatan"
                               class="form-control"
                               placeholder="Contoh: Lektor / Asisten Ahli"
                               value="{{ old('jabatan') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="pendidikan" class="form-label">Pendidikan Terakhir</label>
                        <input type="text" id="pendidikan" name="pendidikan"
                               class="form-control"
                               placeholder="Contoh: S3 Ilmu Komputer"
                               value="{{ old('pendidikan') }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="kepakaran" class="form-label">Kepakaran Riset</label>
                        <input type="text" id="kepakaran" name="kepakaran"
                               class="form-control"
                               placeholder="Contoh: Machine Learning, RPL"
                               value="{{ old('kepakaran') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email"
                               class="form-control"
                               value="{{ old('email') }}">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" rows="3"
                              class="form-control">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('dosen.index') }}" class="btn btn-outline-secondary">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
