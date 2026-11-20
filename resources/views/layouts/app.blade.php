<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Duta Bakery') | PT Duta Jaya Bakery</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --text: #1a1a1a;
            --text-muted: #888;
            --text-light: #bbb;
            --border: #e8e8e8;
            --bg: #ffffff;
            --bg-off: #fafaf8;
            --accent: #1a1a1a;
        }
        * { letter-spacing: 0.01em; }
        body {
            font-family: 'Plus Jakarta Sans', -apple-system, sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            -webkit-font-smoothing: antialiased;
        }
        .navbar { background: var(--bg); border-bottom: 1px solid var(--border); padding: .9rem 0; }
        .navbar-brand img { height: 32px; }
        .nav-link {
            color: var(--text-muted) !important;
            font-weight: 500;
            font-size: .88rem;
            text-transform: uppercase;
            letter-spacing: .08em;
            padding: .4rem .9rem !important;
            transition: color .2s;
        }
        .nav-link:hover, .nav-link.active { color: var(--text) !important; }
        .btn-dark {
            background: var(--text);
            border: none;
            font-weight: 500;
            font-size: .85rem;
            letter-spacing: .06em;
            text-transform: uppercase;
            padding: .55rem 1.6rem;
            border-radius: 0;
            transition: opacity .2s;
        }
        .btn-dark:hover { opacity: .8; background: var(--text); }
        .btn-outline-dark {
            border: 1px solid var(--text);
            color: var(--text);
            font-weight: 500;
            font-size: .85rem;
            letter-spacing: .06em;
            text-transform: uppercase;
            padding: .55rem 1.6rem;
            border-radius: 0;
            background: transparent;
            transition: all .2s;
        }
        .btn-outline-dark:hover { background: var(--text); color: #fff; }
        .section-label {
            font-size: .72rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .18em;
            color: var(--text-muted);
            margin-bottom: .5rem;
        }
        .card-min {
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 0;
            overflow: hidden;
            transition: border-color .3s;
        }
        .card-min:hover { border-color: var(--text); }
        .card-min img { transition: opacity .3s; }
        .card-min:hover img { opacity: .9; }
        .price { font-weight: 600; font-size: 1rem; }
        .divider { border: none; border-top: 1px solid var(--border); margin: 0; }
        a.text-link { color: var(--text); text-decoration: none; border-bottom: 1px solid transparent; transition: border-color .2s; }
        a.text-link:hover { border-bottom-color: var(--text); }
        footer {
            margin-top: auto;
            border-top: 1px solid var(--border);
            background: var(--bg);
            color: var(--text-muted);
            font-size: .82rem;
        }
        .badge-min {
            background: var(--bg-off);
            color: var(--text-muted);
            font-weight: 500;
            font-size: .72rem;
            text-transform: uppercase;
            letter-spacing: .1em;
            padding: .3rem .7rem;
            border: 1px solid var(--border);
            border-radius: 0;
        }
        .btn-wa-float {
            position: fixed; bottom: 24px; right: 24px;
            background: var(--text); color: #fff;
            border-radius: 50%; width: 52px; height: 52px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem; text-decoration: none;
            box-shadow: 0 2px 12px rgba(0,0,0,.12);
            z-index: 1000; transition: transform .2s;
        }
        .btn-wa-float:hover { transform: scale(1.08); color: #fff; }
        ::selection { background: var(--text); color: #fff; }
    </style>
    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.svg') }}" alt="Duta Bakery">
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-lg-1">
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}">Katalog</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Kontak</a></li>
                    <li class="nav-item ms-lg-3"><a class="nav-link" href="{{ route('admin.dashboard') }}" style="font-size:.78rem;">Admin →</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-3">
        @if(session('success'))
            <div class="alert border rounded-0 d-flex align-items-center py-2 px-3 small" style="border-color: var(--border) !important; background: var(--bg-off);">
                <span class="text-muted me-2">✓</span> {{ session('success') }}
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" style="font-size:.6rem;"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert border rounded-0 d-flex align-items-center py-2 px-3 small" style="border-color: #ddd !important; background: #fff5f5;">
                <span class="text-danger me-2">✕</span> {{ session('error') }}
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" style="font-size:.6rem;"></button>
            </div>
        @endif
    </div>

    <main>@yield('content')</main>

    <a href="https://wa.me/6281234567890?text=Halo%20Duta%20Bakery" target="_blank" class="btn-wa-float">
        <i class="bi bi-whatsapp"></i>
    </a>

    <footer class="py-5">
        <div class="container">
            <div class="row g-4 mb-4">
                <div class="col-lg-5">
                    <img src="{{ asset('images/logo.svg') }}" alt="Logo" style="height:28px;" class="mb-3">
                    <p class="small text-muted lh-lg" style="max-width:380px;">
                        Duta Bakery merupakan usaha UMKM yang bergerak di bidang kuliner, khususnya produksi dan penjualan berbagai macam roti dan kue.
                    </p>
                </div>
                <div class="col-6 col-lg-2">
                    <p class="section-label">Navigasi</p>
                    <ul class="list-unstyled small d-flex flex-column gap-1">
                        <li><a href="{{ route('home') }}" class="text-link text-muted">Beranda</a></li>
                        <li><a href="{{ route('products.index') }}" class="text-link text-muted">Katalog</a></li>
                        <li><a href="{{ route('about') }}" class="text-link text-muted">Tentang</a></li>
                        <li><a href="{{ route('contact') }}" class="text-link text-muted">Kontak</a></li>
                        <li><a href="{{ route('admin.login') }}" class="text-link text-muted">Panel Admin</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2">
                    <p class="section-label">Jam Buka</p>
                    <ul class="list-unstyled small text-muted d-flex flex-column gap-1">
                        <li>Sen — Jum: 06.30 — 21.00</li>
                        <li>Sab — Min: 06.30 — 22.00</li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <p class="section-label">Kontak</p>
                    <ul class="list-unstyled small text-muted d-flex flex-column gap-1">
                        <li>+62 812-3456-7890</li>
                        <li>info@dutajayabakery.com</li>
                        <li>Bandar Lampung, Indonesia</li>
                    </ul>
                </div>
            </div>
            <hr class="divider mb-3">
            <div class="d-flex justify-content-between align-items-center small text-muted flex-wrap gap-2">
                <span>&copy; {{ date('Y') }} PT Duta Jaya Bakery</span>
                <span>Duta Satria Sabil — 24312103</span>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
