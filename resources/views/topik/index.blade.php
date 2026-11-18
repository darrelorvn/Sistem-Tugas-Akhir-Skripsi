<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Topik &amp; Bidang Minat</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1">Topik &amp; Bidang Minat</h2>
        </div>

        <div class="d-flex align-items-center gap-2">
            @if (auth()->user()->hasRole('admin'))
                <a href="{{ route('topik.create') }}"
                   class="btn btn-primary">
                    + Tambah Topik
                </a>
            @endif

            <span class="text-secondary small">
                {{ auth()->user()->name }} ({{ auth()->user()->role }})
            </span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm">
                    Logout
                </button>
            </form>
        </div>
    </div>

    @include('partials.module-nav')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <form action="{{ route('topik.index') }}" method="GET" class="row g-2 mb-4">
                <div class="col-md-9">
                    <input
                        type="text"
                        name="cari"
                        class="form-control"
                        placeholder="Cari berdasarkan ID, nama topik, atau kata kunci..."
                        value="{{ $keyword ?? request('cari') }}">
                </div>

                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100">Cari</button>
                    <a href="{{ route('topik.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>No.</th>
                            <th>Kode</th>
                            <th>Nama Bidang Minat</th>
                            <th>Topik Utama</th>
                            <th>Kata Kunci</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($topiks as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <span class="badge bg-primary">{{ strtoupper($item->id) }}</span>
                                </td>
                                <td class="fw-semibold">{{ $item->nama }}</td>
                                <td class="text-secondary small">{{ \Illuminate\Support\Str::limit($item->topik_utama ?: '-', 60) }}</td>
                                <td>
                                    @forelse (array_slice(array_filter(array_map('trim', explode(',', $item->keywords))), 0, 3) as $kw)
                                        <span class="badge bg-light text-dark border">{{ $kw }}</span>
                                    @empty
                                        <span class="text-secondary small">-</span>
                                    @endforelse
                                </td>
                                <td class="text-center">
                                    <div class="d-inline-flex gap-1">
                                        <a href="{{ route('topik.show', $item->id) }}"
                                           class="btn btn-outline-info btn-sm">
                                            Detail
                                        </a>

                                        @if (auth()->user()->hasRole('admin'))
                                            <a href="{{ route('topik.edit', $item->id) }}"
                                               class="btn btn-outline-warning btn-sm">
                                                Edit
                                            </a>

                                            <form action="{{ route('topik.destroy', $item->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus topik {{ $item->nama }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                                    Hapus
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-secondary py-4">
                                    Belum ada data topik &amp; bidang minat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
