@extends('layouts.app')
@section('title', 'Katalog Produk')

@section('content')
<section class="py-4 border-bottom" style="background: var(--bg-off);">
    <div class="container">
        <p class="text-muted small mb-1"><a href="{{ route('home') }}" class="text-link text-muted">Beranda</a> / Katalog</p>
        <h1 style="font-weight:300;" class="mb-0">Katalog Produk</h1>
    </div>
</section>

<section class="py-5">
    <div class="container">
        {{-- Filter --}}
        <div class="border p-3 mb-4" style="border-color: var(--border) !important;">
            <form action="{{ route('products.index') }}" method="GET" class="row g-2 align-items-center">
                <div class="col-lg-5 col-md-6">
                    <input type="text" name="search" class="form-control form-control-sm rounded-0 border" placeholder="Cari produk..." value="{{ request('search') }}" style="border-color: var(--border) !important;">
                </div>
                <div class="col-lg-3 col-md-3 col-6">
                    <select name="category" class="form-select form-select-sm rounded-0 border" onchange="this.form.submit()" style="border-color: var(--border) !important;">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>{{ $cat->name }} ({{ $cat->products_count }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-6">
                    <select name="sort" class="form-select form-select-sm rounded-0 border" onchange="this.form.submit()" style="border-color: var(--border) !important;">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga ↑</option>
                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga ↓</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>A — Z</option>
                    </select>
                </div>
                <div class="col-lg-1 text-end">
                    @if(request()->hasAny(['search','category','sort']))
                    <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-dark w-100">Reset</a>
                    @else
                    <button type="submit" class="btn btn-sm btn-dark w-100">Cari</button>
                    @endif
                </div>
            </form>
        </div>

        <p class="text-muted small mb-4">Menampilkan {{ $products->total() }} produk</p>

        @if($products->count() > 0)
        <div class="row g-4">
            @foreach($products as $product)
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card-min h-100">
                    <a href="{{ route('products.show', $product->slug) }}">
                        <div style="background:#f5f5f0;">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-100" style="height:220px; object-fit:cover;">
                        </div>
                    </a>
                    <div class="p-3">
                        <span class="badge-min">{{ $product->category->name }}</span>
                        <h6 class="mt-2 mb-1"><a href="{{ route('products.show', $product->slug) }}" class="text-link">{{ $product->name }}</a></h6>
                        @if($product->flavor)<small class="text-muted d-block mb-2">{{ $product->flavor }}</small>@endif
                        <p class="text-muted small mb-3">{{ Str::limit($product->description, 80) }}</p>
                        <div class="d-flex justify-content-between align-items-center pt-2 border-top" style="border-color: var(--border) !important;">
                            <span class="price">{{ $product->formatted_price }}</span>
                            <span class="text-muted" style="font-size:.72rem;">Stok: {{ $product->stock }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-5">{{ $products->links('pagination::bootstrap-5') }}</div>
        @else
        <div class="text-center py-5">
            <p class="text-muted mb-3">Tidak ada produk yang ditemukan.</p>
            <a href="{{ route('products.index') }}" class="btn btn-outline-dark btn-sm">Reset Filter</a>
        </div>
        @endif
    </div>
</section>
@endsection
