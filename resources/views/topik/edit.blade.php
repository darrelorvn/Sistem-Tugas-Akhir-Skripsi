<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Topik &amp; Bidang Minat</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card border-0 shadow-sm mx-auto" style="max-width: 750px;">
        <div class="card-body p-4 p-md-5">

            <h2 class="fw-bold mb-1">Edit Topik &amp; Bidang Minat</h2>
            <p class="text-secondary mb-4">
                Perbarui informasi taksonomi topik riset (Kode: <strong>{{ strtoupper($topik->id) }}</strong>).
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

            <form action="{{ route('topik.update', $topik->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Bidang Minat</label>
                    <input type="text" id="nama" name="nama"
                           class="form-control"
                           value="{{ old('nama', $topik->nama) }}" required>
                </div>

                <div class="mb-3">
                    <label for="topik_utama" class="form-label">Topik Riset Utama</label>
                    <input type="text" id="topik_utama" name="topik_utama"
                           class="form-control"
                           value="{{ old('topik_utama', $topik->topik_utama) }}">
                </div>

                <div class="mb-3">
                    <label for="keywords" class="form-label">Kata Kunci (pisahkan dengan koma)</label>
                    <input type="text" id="keywords" name="keywords"
                           class="form-control"
                           value="{{ old('keywords', $topik->keywords) }}">
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi Fokus</label>
                    <textarea id="deskripsi" name="deskripsi" rows="3"
                              class="form-control">{{ old('deskripsi', $topik->deskripsi) }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="studi_kasus" class="form-label">Studi Kasus</label>
                    <textarea id="studi_kasus" name="studi_kasus" rows="2"
                              class="form-control">{{ old('studi_kasus', $topik->studi_kasus) }}</textarea>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('topik.index') }}" class="btn btn-outline-secondary">
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
