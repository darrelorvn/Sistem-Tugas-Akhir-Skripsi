<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $topik->nama }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card border-0 shadow-sm mx-auto" style="max-width: 750px;">
        <div class="card-body p-4 p-md-5">

            <div class="d-flex justify-content-between align-items-start gap-3 mb-3">
                <div>
                    <span class="badge bg-primary mb-2">{{ strtoupper($topik->id) }}</span>
                    <h2 class="fw-bold mb-0">{{ $topik->nama }}</h2>
                </div>
            </div>

            <hr class="my-4">

            <div class="mb-4">
                <h6 class="text-secondary text-uppercase small fw-semibold mb-1">Topik Riset Utama</h6>
                <p class="mb-0">{{ $topik->topik_utama ?: '-' }}</p>
            </div>

            <div class="mb-4">
                <h6 class="text-secondary text-uppercase small fw-semibold mb-2">Kata Kunci</h6>
                <div class="d-flex flex-wrap gap-1">
                    @forelse (array_filter(array_map('trim', explode(',', $topik->keywords))) as $k)
                        <span class="badge bg-light text-dark border">{{ $k }}</span>
                    @empty
                        <span class="text-secondary">-</span>
                    @endforelse
                </div>
            </div>

            <div class="mb-4">
                <h6 class="text-secondary text-uppercase small fw-semibold mb-1">Deskripsi Fokus</h6>
                <p class="mb-0">{{ $topik->deskripsi ?: '-' }}</p>
            </div>

            <div class="mb-4">
                <h6 class="text-secondary text-uppercase small fw-semibold mb-1">Studi Kasus</h6>
                <p class="mb-0">{{ $topik->studi_kasus ?: '-' }}</p>
            </div>

            <div class="d-flex justify-content-end gap-2 pt-2">
                <a href="{{ route('topik.index') }}" class="btn btn-outline-secondary">
                    Kembali
                </a>

                @if (auth()->user()->hasRole('admin'))
                    <a href="{{ route('topik.edit', $topik->id) }}" class="btn btn-primary">
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
