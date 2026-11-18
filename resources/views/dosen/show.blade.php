<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $dosen->nama }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card border-0 shadow-sm mx-auto" style="max-width: 750px;">
        <div class="card-body p-4 p-md-5">

            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="rounded-circle bg-primary bg-opacity-10 text-primary fw-bold d-flex align-items-center justify-content-center"
                     style="width: 60px; height: 60px; font-size: 1.4rem; flex-shrink: 0;">
                    {{ strtoupper(mb_substr($dosen->nama, 0, 1)) }}
                </div>
                <div>
                    <h2 class="fw-bold mb-0">{{ $dosen->nama }}</h2>
                    <div class="text-secondary small">NIDN: {{ $dosen->nidn }}</div>
                </div>
            </div>

            <hr class="my-4">

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <h6 class="text-secondary text-uppercase small fw-semibold mb-1">Jabatan Fungsional</h6>
                    <p class="mb-0">{{ $dosen->jabatan ?: '-' }}</p>
                </div>

                <div class="col-md-6">
                    <h6 class="text-secondary text-uppercase small fw-semibold mb-1">Pendidikan Terakhir</h6>
                    <p class="mb-0">{{ $dosen->pendidikan ?: '-' }}</p>
                </div>

                <div class="col-md-6">
                    <h6 class="text-secondary text-uppercase small fw-semibold mb-1">Kepakaran Riset</h6>
                    <p class="mb-0">{{ $dosen->kepakaran ?: '-' }}</p>
                </div>

                <div class="col-md-6">
                    <h6 class="text-secondary text-uppercase small fw-semibold mb-1">Email</h6>
                    <p class="mb-0">{{ $dosen->email ?: '-' }}</p>
                </div>
            </div>

            <div class="mb-4">
                <h6 class="text-secondary text-uppercase small fw-semibold mb-1">Deskripsi</h6>
                <p class="mb-0">{{ $dosen->deskripsi ?: '-' }}</p>
            </div>

            <div class="d-flex justify-content-end gap-2 pt-2">
                <a href="{{ route('dosen.index') }}" class="btn btn-outline-secondary">
                    Kembali
                </a>

                @if (auth()->user()->hasRole('admin'))
                    <a href="{{ route('dosen.edit', $dosen->nidn) }}" class="btn btn-primary">
                        Edit
                    </a>
                @endif
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
