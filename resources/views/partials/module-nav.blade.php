<div class="card border-0 shadow-sm mb-4">
    <div class="card-body py-2 px-3">
        <ul class="nav nav-pills flex-wrap gap-1 small fw-medium">
            @if (auth()->user()->hasRole('admin'))
                <li class="nav-item">
                    <a class="nav-link py-1 px-3 {{ request()->routeIs('dashboard') ? 'active' : 'text-secondary' }}"
                       href="{{ route('dashboard') }}">
                        Dashboard
                    </a>
                </li>
            @endif

            <li class="nav-item">
                <a class="nav-link py-1 px-3 {{ request()->routeIs('mahasiswa.*') ? 'active' : 'text-secondary' }}"
                   href="{{ route('mahasiswa.index') }}">
                    Mahasiswa
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link py-1 px-3 {{ request()->routeIs('dosen.*') ? 'active' : 'text-secondary' }}"
                   href="{{ route('dosen.index') }}">
                    Dosen
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link py-1 px-3 {{ request()->routeIs('topik.*') ? 'active' : 'text-secondary' }}"
                   href="{{ route('topik.index') }}">
                    Topik
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link py-1 px-3 {{ request()->routeIs('ruang.*') ? 'active' : 'text-secondary' }}"
                   href="{{ route('ruang.index') }}">
                    Ruang
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link py-1 px-3 {{ request()->routeIs('gedung.*') ? 'active' : 'text-secondary' }}"
                   href="{{ route('gedung.index') }}">
                    Gedung
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link py-1 px-3 {{ request()->routeIs('fasilitas.*') ? 'active' : 'text-secondary' }}"
                   href="{{ route('fasilitas.index') }}">
                    Fasilitas
                </a>
            </li>
        </ul>
    </div>
</div>
