@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Ringkasan')

@section('content')
{{-- Stats --}}
<div class="row g-3 mb-5">
    <div class="col-sm-6 col-xl-3">
        <div class="card-admin p-4">
            <span class="section-label">Total Produk</span>
            <h2 class="fw-300 mt-2 mb-1" style="font-weight:300;font-size:2.4rem;">{{ $totalProducts }}</h2>
            <small class="text-muted">Item aktif</small>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card-admin p-4">
            <span class="section-label">Kategori</span>
            <h2 class="fw-300 mt-2 mb-1" style="font-weight:300;font-size:2.4rem;">{{ $totalCategories }}</h2>
            <small class="text-muted">Kelompok varian</small>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card-admin p-4">
            <span class="section-label">Total Stok</span>
            <h2 class="fw-300 mt-2 mb-1" style="font-weight:300;font-size:2.4rem;">{{ $totalStock }}</h2>
            <small class="text-muted">Pcs tersedia</small>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card-admin p-4">
            <span class="section-label">Unggulan</span>
            <h2 class="fw-300 mt-2 mb-1" style="font-weight:300;font-size:2.4rem;">{{ $featuredCount }}</h2>
            <small class="text-muted">Di homepage</small>
        </div>
    </div>
</div>

{{-- Quick Actions & Low Stock --}}
<div class="row g-4 mb-5">
    <div class="col-lg-8">
        <span class="section-label d-block mb-3">Aksi Cepat</span>
        <div class="row g-3">
            <div class="col-md-4">
                <a href="{{ route('admin.products.create') }}" class="card-admin p-4 d-block text-decoration-none" style="transition:background .15s;" onmouseover="this.style.background='var(--bg-off)'" onmouseout="this.style.background=''">
                    <i class="bi bi-plus d-block mb-2" style="font-size:1.4rem;"></i>
                    <strong class="d-block" style="font-size:.88rem;">Tambah Produk</strong>
                    <small class="text-muted">Upload foto &amp; harga</small>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('admin.categories.index') }}" class="card-admin p-4 d-block text-decoration-none" style="transition:background .15s;" onmouseover="this.style.background='var(--bg-off)'" onmouseout="this.style.background=''">
                    <i class="bi bi-folder d-block mb-2" style="font-size:1.4rem;"></i>
                    <strong class="d-block" style="font-size:.88rem;">Kelola Kategori</strong>
                    <small class="text-muted">Atur varian menu</small>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('products.index') }}" target="_blank" class="card-admin p-4 d-block text-decoration-none" style="transition:background .15s;" onmouseover="this.style.background='var(--bg-off)'" onmouseout="this.style.background=''">
                    <i class="bi bi-arrow-up-right d-block mb-2" style="font-size:1.4rem;"></i>
                    <strong class="d-block" style="font-size:.88rem;">Katalog Publik</strong>
                    <small class="text-muted">Lihat tampilan pembeli</small>
                </a>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <span class="section-label d-block mb-3">Stok Rendah (&lt; 10 pcs)</span>
        <div class="card-admin p-4" style="min-height:160px;">
            @if($lowStockProducts->count() > 0)
                @foreach($lowStockProducts as $low)
                    <div class="d-flex justify-content-between align-items-center py-2 {{ !$loop->last ? 'border-bottom' : '' }}" style="border-color:var(--border)!important;">
                        <span class="small text-truncate me-2">{{ $low->name }}</span>
                        <span class="badge-min">{{ $low->stock }} pcs</span>
                    </div>
                @endforeach
            @else
                <div class="text-center py-4 text-muted small">
                    Semua stok aman (≥ 10 pcs).
                </div>
            @endif
        </div>
    </div>
</div>

{{-- Latest Products --}}
<div class="mb-2 d-flex justify-content-between align-items-center">
    <span class="section-label">5 Produk Terbaru</span>
    <a href="{{ route('admin.products.create') }}" class="btn btn-dark btn-sm">+ Tambah</a>
</div>
<div class="card-admin">
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th style="width:60px;">Foto</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Status</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($latestProducts as $prod)
                    <tr>
                        <td>
                            <img src="{{ $prod->image_url }}" alt="{{ $prod->name }}" style="width:40px;height:40px;object-fit:cover;border:1px solid var(--border);">
                        </td>
                        <td>
                            <strong style="font-size:.88rem;">{{ $prod->name }}</strong>
                            <div class="text-muted" style="font-size:.72rem;">{{ $prod->slug }}</div>
                        </td>
                        <td><span class="badge-min">{{ $prod->category->name }}</span></td>
                        <td style="font-size:.88rem;">{{ $prod->formatted_price }}</td>
                        <td><span class="badge-min">{{ $prod->stock }} pcs</span></td>
                        <td>
                            @if($prod->is_featured)
                                <span class="badge-min" style="border-color:var(--text);color:var(--text);">Unggulan</span>
                            @else
                                <span class="badge-min">Reguler</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('products.show', $prod->slug) }}" target="_blank" class="btn btn-outline-dark btn-sm px-2 py-1" style="font-size:.7rem;">Lihat</a>
                            <a href="{{ route('admin.products.edit', $prod->id) }}" class="btn btn-outline-dark btn-sm px-2 py-1" style="font-size:.7rem;">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
