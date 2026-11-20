@extends('layouts.app')
@section('title', 'Tentang Kami')

@section('content')
<section class="py-4 border-bottom" style="background: var(--bg-off);">
    <div class="container">
        <p class="text-muted small mb-1"><a href="{{ route('home') }}" class="text-link text-muted">Beranda</a> / Tentang Kami</p>
        <h1 style="font-weight:300;" class="mb-0">Tentang Duta Bakery</h1>
    </div>
</section>

<section class="py-5 border-bottom">
    <div class="container">
        <div class="row g-5 align-items-start">
            <div class="col-lg-5">
                <div class="p-5 text-center" style="background: #f5f5f0; border: 1px solid var(--border);">
                    <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="img-fluid mb-4" style="max-width:220px; opacity:.8;">
                    <p class="text-muted small mb-0" style="letter-spacing:.1em; text-transform:uppercase;">Est. 2024 · Bandar Lampung</p>
                </div>
            </div>
            <div class="col-lg-7">
                <p class="section-label">Profil Usaha</p>
                <h2 style="font-weight:300;" class="mb-4">PT Duta Jaya Bakery</h2>
                <p class="text-muted lh-lg mb-4">
                    Duta Bakery merupakan usaha UMKM yang bergerak di bidang kuliner, khususnya produksi dan penjualan berbagai macam roti dan kue. Duta Bakery menyediakan produk berkualitas dengan cita rasa lezat, harga terjangkau, serta mengutamakan kebersihan dan kepuasan pelanggan. Melalui website, pelanggan dapat melihat katalog produk dan informasi setiap kue dengan mudah.
                </p>
                <p class="text-muted lh-lg">
                    Didirikan dengan semangat memberdayakan pangan lokal, PT Duta Jaya Bakery memadukan keahlian pemanggangan tradisional dan modern. Setiap produk diolah menggunakan bahan alami bermutu tinggi tanpa pengawet berbahaya.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="py-5 border-bottom" style="background: var(--bg-off);">
    <div class="container">
        <div class="row g-5">
            <div class="col-md-6">
                <p class="section-label">Visi</p>
                <p class="text-muted lh-lg">
                    Menjadi UMKM bakery terdepan dan terpercaya yang dikenal karena kelezatan cita rasa, standar higienitas, serta akses produk yang mudah dan terjangkau.
                </p>
            </div>
            <div class="col-md-6">
                <p class="section-label">Misi</p>
                <ul class="text-muted small lh-lg ps-3">
                    <li class="mb-2">Memproduksi roti, cake, pastry, dan kue kering dengan bahan bermutu dan selalu fresh.</li>
                    <li class="mb-2">Menjaga kebersihan sesuai standar kesehatan makanan.</li>
                    <li class="mb-2">Menawarkan harga ramah kantong bagi masyarakat umum.</li>
                    <li>Menyediakan layanan digital agar pelanggan dapat melihat katalog dan memesan dengan mudah.</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="border p-4 d-flex align-items-center gap-4 flex-wrap" style="border-color: var(--border) !important;">
            <div class="d-flex align-items-center justify-content-center" style="width:56px; height:56px; background:#f5f5f0; font-weight:600; font-size:1.1rem; flex-shrink:0;">DS</div>
            <div>
                <p class="section-label mb-1">Pengembang Project UTS</p>
                <p class="mb-0"><strong>Duta Satria Sabil</strong> — NPM: 24312103</p>
                <p class="text-muted small mb-0">Web II · Semester 5 · Laravel {{ app()->version() }}</p>
            </div>
        </div>
    </div>
</section>
@endsection
