@extends('layouts.app')
@section('title', 'Beranda')

@section('content')
{{-- Hero --}}
<section class="py-5 border-bottom" style="background: var(--bg-off);">
    <div class="container py-lg-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <p class="section-label">PT Duta Jaya Bakery</p>
                <h1 class="display-5 mb-4" style="font-weight:300; line-height:1.2;">
                    Roti &amp; kue segar<br>
                    <span style="font-weight:600;">berkualitas tinggi</span>
                </h1>
                <p class="text-muted mb-4" style="max-width:480px; line-height:1.7;">
                    Duta Bakery merupakan usaha UMKM yang bergerak di bidang kuliner, khususnya produksi dan penjualan berbagai macam roti dan kue. Duta Bakery menyediakan produk berkualitas dengan cita rasa lezat, harga terjangkau, serta mengutamakan kebersihan dan kepuasan pelanggan.
                </p>
                <div class="d-flex gap-3">
                    <a href="{{ route('products.index') }}" class="btn btn-dark">Lihat Katalog</a>
                    <a href="{{ route('about') }}" class="btn btn-outline-dark">Tentang Kami</a>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="text-center p-5" style="background: #f0f0ec;">
                    <img src="{{ asset('images/logo.svg') }}" alt="Duta Bakery" class="img-fluid" style="max-width:280px; opacity:.8;">
                    <p class="mt-4 text-muted small" style="letter-spacing:.1em; text-transform:uppercase;">Fresh from oven · sejak 2024</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Kategori --}}
<section class="py-5 border-bottom">
    <div class="container">
        <p class="section-label">Kategori</p>
        <h2 class="mb-4" style="font-weight:300;">Jelajahi Varian Kami</h2>
        <div class="row g-3">
            @foreach($categories as $category)
            <div class="col-6 col-md">
                <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="text-decoration-none text-dark">
                    <div class="p-3 border text-center" style="border-color: var(--border) !important; transition: border-color .2s;" onmouseover="this.style.borderColor='#1a1a1a'" onmouseout="this.style.borderColor='var(--border)'">
                        <div class="fw-600 small">{{ $category->name }}</div>
                        <div class="text-muted" style="font-size:.72rem;">{{ $category->products_count }} produk</div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Produk Unggulan --}}
<section class="py-5 border-bottom">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <p class="section-label">Pilihan Terbaik</p>
                <h2 style="font-weight:300;">Produk Unggulan</h2>
            </div>
            <a href="{{ route('products.index') }}" class="text-link text-muted small" style="text-transform:uppercase; letter-spacing:.08em;">Semua Produk →</a>
        </div>
        <div class="row g-4">
            @forelse($featuredProducts as $product)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card-min h-100">
                    <a href="{{ route('products.show', $product->slug) }}">
                        <div style="background:#f5f5f0;">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-100" style="height:220px; object-fit:cover;">
                        </div>
                    </a>
                    <div class="p-3">
                        <div class="d-flex justify-content-between align-items-start mb-1">
                            <span class="badge-min">{{ $product->category->name }}</span>
                        </div>
                        <h6 class="mt-2 mb-1">
                            <a href="{{ route('products.show', $product->slug) }}" class="text-link">{{ $product->name }}</a>
                        </h6>
                        <p class="text-muted small mb-3" style="line-height:1.5;">{{ Str::limit($product->description, 80) }}</p>
                        <div class="d-flex justify-content-between align-items-center pt-2 border-top" style="border-color: var(--border) !important;">
                            <span class="price">{{ $product->formatted_price }}</span>
                            <a href="{{ route('products.show', $product->slug) }}" class="text-muted small text-link">Detail →</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5 text-muted">Belum ada produk unggulan.</div>
            @endforelse
        </div>
    </div>
</section>

{{-- Keunggulan --}}
<section class="py-5 border-bottom" style="background: var(--bg-off);">
    <div class="container">
        <p class="section-label text-center">Kenapa Duta Bakery</p>
        <h2 class="text-center mb-5" style="font-weight:300;">Komitmen Kami</h2>
        <div class="row g-4 text-center">
            @php
            $values = [
                ['Bahan Premium', 'Tepung, butter, dan cokelat berkualitas terbaik.'],
                ['100% Higienis', 'Standar sanitasi ketat di setiap proses produksi.'],
                ['Harga Terjangkau', 'Produk istimewa yang ramah di kantong.'],
                ['Fresh Daily', 'Dipanggang segar setiap pagi dan sore.'],
            ];
            @endphp
            @foreach($values as $v)
            <div class="col-md-3 col-sm-6">
                <h6 class="fw-600 mb-2">{{ $v[0] }}</h6>
                <p class="text-muted small mb-0" style="line-height:1.6;">{{ $v[1] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-5">
    <div class="container text-center py-4">
        <h2 style="font-weight:300;" class="mb-3">Ingin memesan untuk acara spesial?</h2>
        <p class="text-muted mb-4 mx-auto" style="max-width:500px;">Kami menerima pesanan snack box, roti rapat, kue ulang tahun, dan paket hantaran.</p>
        <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-dark">Hubungi Kami</a>
    </div>
</section>
@endsection
