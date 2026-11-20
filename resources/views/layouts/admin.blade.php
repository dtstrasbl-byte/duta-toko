<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') | Duta Bakery</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root { --text: #1a1a1a; --muted: #888; --border: #e8e8e8; --bg: #fff; --bg-off: #fafaf8; }
        * { letter-spacing: 0.01em; }
        body {
            font-family: 'Plus Jakarta Sans', -apple-system, sans-serif;
            background: #f7f7f5;
            color: var(--text);
            -webkit-font-smoothing: antialiased;
        }
        .sidebar {
            width: 240px; min-height: 100vh;
            background: var(--bg); border-right: 1px solid var(--border);
            position: fixed; top: 0; left: 0; z-index: 100;
            display: flex; flex-direction: column;
        }
        .sidebar-brand {
            padding: 1.4rem 1.5rem;
            border-bottom: 1px solid var(--border);
        }
        .sidebar-nav { padding: .75rem; flex-grow: 1; }
        .sidebar-label {
            font-size: .65rem; font-weight: 600;
            text-transform: uppercase; letter-spacing: .16em;
            color: var(--muted); padding: .6rem .75rem .3rem;
        }
        .sidebar-link {
            display: flex; align-items: center; gap: .65rem;
            padding: .6rem .75rem; color: var(--muted);
            text-decoration: none; font-weight: 500; font-size: .88rem;
            border-radius: 0; transition: all .15s; margin-bottom: 1px;
        }
        .sidebar-link:hover { color: var(--text); background: var(--bg-off); }
        .sidebar-link.active { color: var(--text); background: var(--bg-off); border-left: 2px solid var(--text); }
        .main-wrapper { margin-left: 240px; min-height: 100vh; display: flex; flex-direction: column; }
        .topbar {
            height: 56px; background: var(--bg);
            border-bottom: 1px solid var(--border);
            padding: 0 2rem; display: flex;
            align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 90;
        }
        .content-body { padding: 2rem; flex-grow: 1; }
        .card-admin { background: var(--bg); border: 1px solid var(--border); border-radius: 0; }
        .btn-dark {
            background: var(--text); border: none; font-weight: 500;
            font-size: .82rem; letter-spacing: .06em; text-transform: uppercase;
            padding: .5rem 1.4rem; border-radius: 0;
        }
        .btn-dark:hover { opacity: .8; background: var(--text); }
        .btn-outline-dark {
            border: 1px solid var(--text); color: var(--text);
            font-weight: 500; font-size: .82rem; letter-spacing: .06em;
            text-transform: uppercase; padding: .5rem 1.4rem;
            border-radius: 0; background: transparent;
        }
        .btn-outline-dark:hover { background: var(--text); color: #fff; }
        .section-label {
            font-size: .65rem; font-weight: 600;
            text-transform: uppercase; letter-spacing: .16em;
            color: var(--muted);
        }
        .table th { font-size: .72rem; font-weight: 600; text-transform: uppercase; letter-spacing: .1em; color: var(--muted); border-bottom: 1px solid var(--border); }
        .table td { border-bottom: 1px solid var(--border); vertical-align: middle; }
        .badge-min {
            background: var(--bg-off); color: var(--muted);
            font-weight: 500; font-size: .7rem; text-transform: uppercase;
            letter-spacing: .08em; padding: .25rem .6rem;
            border: 1px solid var(--border); border-radius: 0;
        }
        ::selection { background: var(--text); color: #fff; }
        @media (max-width: 991.98px) {
            .sidebar { margin-left: -240px; transition: margin-left .3s; }
            .sidebar.show { margin-left: 0; }
            .main-wrapper { margin-left: 0; }
        }
    </style>
    @yield('styles')
</head>
<body>
    <aside class="sidebar" id="adminSidebar">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}" class="text-decoration-none">
                <img src="{{ asset('images/logo.svg') }}" alt="Duta Bakery" style="height:24px;">
            </a>
        </div>
        <div class="sidebar-nav">
            <div class="sidebar-label">Dashboard</div>
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2"></i> Ringkasan
            </a>

            <div class="sidebar-label mt-3">Katalog</div>
            <a href="{{ route('admin.products.index') }}" class="sidebar-link {{ request()->routeIs('admin.products.index') || request()->routeIs('admin.products.edit') ? 'active' : '' }}">
                <i class="bi bi-box"></i> Produk
            </a>
            <a href="{{ route('admin.products.create') }}" class="sidebar-link {{ request()->routeIs('admin.products.create') ? 'active' : '' }}">
                <i class="bi bi-plus"></i> Tambah Produk
            </a>
            <a href="{{ route('admin.categories.index') }}" class="sidebar-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="bi bi-folder"></i> Kategori
            </a>

            <div class="sidebar-label mt-3">Website</div>
            <a href="{{ route('home') }}" target="_blank" class="sidebar-link">
                <i class="bi bi-arrow-up-right"></i> Buka Toko
            </a>
        </div>
        <div class="p-3 border-top small text-muted" style="border-color: var(--border) !important;">
            <div>{{ Auth::user()->name }}</div>
            <div style="font-size:.72rem;" class="mb-2">{{ Auth::user()->email }}</div>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-dark btn-sm w-100" style="font-size:.68rem;padding:.3rem .5rem;">Logout</button>
            </form>
        </div>
    </aside>

    <div class="main-wrapper">
        <header class="topbar">
            <div class="d-flex align-items-center">
                <button class="btn btn-sm d-lg-none me-3 border-0" id="sidebarToggle"><i class="bi bi-list fs-5"></i></button>
                <h6 class="mb-0 fw-600" style="font-size:.92rem;">@yield('page_title', 'Dashboard')</h6>
            </div>
            <span class="section-label d-none d-md-inline">PT Duta Jaya Bakery</span>
        </header>

        <div class="content-body">
            @if(session('success'))
                <div class="alert border rounded-0 d-flex align-items-center py-2 px-3 small mb-4" style="border-color: var(--border) !important; background: var(--bg-off);">
                    <span class="text-muted me-2">✓</span> {{ session('success') }}
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" style="font-size:.55rem;"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert border rounded-0 d-flex align-items-center py-2 px-3 small mb-4" style="border-color: #ddd !important; background: #fff5f5;">
                    <span class="text-danger me-2">✕</span> {{ session('error') }}
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" style="font-size:.55rem;"></button>
                </div>
            @endif
            @if($errors->any())
                <div class="alert border rounded-0 py-2 px-3 small mb-4" style="border-color: #ddd !important; background: #fff5f5;">
                    <strong class="d-block mb-1">Periksa kembali isian form:</strong>
                    <ul class="mb-0 ps-3">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="alert" style="font-size:.55rem;"></button>
                </div>
            @endif
            @yield('content')
        </div>

        <footer class="border-top py-3 px-4 small text-muted d-flex justify-content-between" style="border-color: var(--border) !important; background: var(--bg);">
            <span>&copy; {{ date('Y') }} PT Duta Jaya Bakery</span>
            <span>Duta Satria Sabil — 24312103</span>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const t = document.getElementById('sidebarToggle');
        const s = document.getElementById('adminSidebar');
        if (t) t.addEventListener('click', () => s.classList.toggle('show'));
    </script>
    @yield('scripts')
</body>
</html>
