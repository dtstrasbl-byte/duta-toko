@extends('layouts.app')
@section('title', 'Kontak')

@section('content')
<section class="py-4 border-bottom" style="background: var(--bg-off);">
    <div class="container">
        <p class="text-muted small mb-1"><a href="{{ route('home') }}" class="text-link text-muted">Beranda</a> / Kontak</p>
        <h1 style="font-weight:300;" class="mb-0">Kontak &amp; Lokasi</h1>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-5">
                <p class="section-label">Informasi</p>

                <div class="mb-4">
                    <p class="small text-muted mb-1">Alamat</p>
                    <p class="mb-0">Jl. Duta Bakery No. 103, Bandar Lampung, Lampung 35152</p>
                </div>
                <div class="mb-4">
                    <p class="small text-muted mb-1">WhatsApp</p>
                    <p class="mb-0"><a href="https://wa.me/6281234567890" target="_blank" class="text-link">+62 812-3456-7890</a></p>
                </div>
                <div class="mb-4">
                    <p class="small text-muted mb-1">Email</p>
                    <p class="mb-0"><a href="mailto:info@dutajayabakery.com" class="text-link">info@dutajayabakery.com</a></p>
                </div>
                <div class="mb-4">
                    <p class="small text-muted mb-1">Jam Buka</p>
                    <p class="mb-0">Sen — Jum: 06.30 — 21.00 WIB</p>
                    <p class="mb-0">Sab — Min: 06.30 — 22.00 WIB</p>
                </div>

                <div class="p-4 mt-4 text-center" style="background:#f5f5f0; border:1px solid var(--border);">
                    <p class="text-muted small mb-2">Lokasi</p>
                    <a href="https://maps.google.com" target="_blank" class="btn btn-outline-dark btn-sm">Buka di Google Maps</a>
                </div>
            </div>
            <div class="col-lg-7">
                <p class="section-label">Kirim Pesan</p>
                <p class="text-muted small mb-4">Ada pertanyaan atau ingin konsultasi pesanan? Tuliskan di bawah ini.</p>
                <form onsubmit="event.preventDefault(); alert('Pesan Anda telah diterima. Terima kasih!'); this.reset();">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small text-muted">Nama</label>
                            <input type="text" class="form-control rounded-0 border" required style="border-color: var(--border) !important;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small text-muted">No. WhatsApp</label>
                            <input type="tel" class="form-control rounded-0 border" required style="border-color: var(--border) !important;">
                        </div>
                        <div class="col-12">
                            <label class="form-label small text-muted">Email</label>
                            <input type="email" class="form-control rounded-0 border" required style="border-color: var(--border) !important;">
                        </div>
                        <div class="col-12">
                            <label class="form-label small text-muted">Keperluan</label>
                            <select class="form-select rounded-0 border" required style="border-color: var(--border) !important;">
                                <option value="">Pilih...</option>
                                <option>Pemesanan Custom Cake</option>
                                <option>Snack Box Rapat</option>
                                <option>Informasi Katalog</option>
                                <option>Kemitraan</option>
                                <option>Lainnya</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label small text-muted">Pesan</label>
                            <textarea class="form-control rounded-0 border" rows="4" required style="border-color: var(--border) !important;"></textarea>
                        </div>
                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-dark w-100">Kirim Pesan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
