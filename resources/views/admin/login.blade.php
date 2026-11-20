<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | Duta Bakery</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --text: #1a1a1a; --muted: #888; --border: #e8e8e8; --bg: #fff; --bg-off: #fafaf8; }
        * { letter-spacing: 0.01em; }
        body {
            font-family: 'Plus Jakarta Sans', -apple-system, sans-serif;
            background: var(--bg-off);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            -webkit-font-smoothing: antialiased;
        }
        .login-card {
            background: var(--bg);
            border: 1px solid var(--border);
            width: 100%;
            max-width: 420px;
            padding: 3rem 2.5rem;
        }
        .section-label {
            font-size: .65rem; font-weight: 600;
            text-transform: uppercase; letter-spacing: .16em;
            color: var(--muted);
        }
        .form-control {
            border-radius: 0;
            border-color: var(--border);
            padding: .6rem .8rem;
            font-size: .88rem;
        }
        .form-control:focus {
            border-color: var(--text);
            box-shadow: none;
        }
        .btn-dark {
            background: var(--text); border: none; font-weight: 500;
            font-size: .82rem; letter-spacing: .06em; text-transform: uppercase;
            padding: .6rem 1.4rem; border-radius: 0; width: 100%;
        }
        .btn-dark:hover { opacity: .8; background: var(--text); }
        ::selection { background: var(--text); color: #fff; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="text-center mb-4">
            <img src="{{ asset('images/logo.svg') }}" alt="Duta Bakery" style="height:28px;" class="mb-3">
            <p class="section-label">Admin Panel</p>
        </div>

        @if($errors->any())
            <div class="border p-2 mb-3 small" style="border-color:var(--border)!important;background:#fff5f5;">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="section-label d-block mb-1">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="admin@dutabakery.com" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="mb-3">
                <label for="password" class="section-label d-block mb-1">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
            </div>

            <div class="mb-4">
                <div class="form-check">
                    <input class="form-check-input rounded-0" type="checkbox" name="remember" id="remember" style="border-color:var(--border);">
                    <label class="form-check-label small text-muted" for="remember">Ingat saya</label>
                </div>
            </div>

            <button type="submit" class="btn btn-dark">Masuk</button>
        </form>

        <div class="text-center mt-4">
            <a href="{{ route('home') }}" class="small text-muted text-decoration-none" style="border-bottom:1px solid var(--border);">← Kembali ke Website</a>
        </div>

        <div class="text-center mt-3">
            <span class="small text-muted">Duta Satria Sabil — 24312103</span>
        </div>
    </div>
</body>
</html>
