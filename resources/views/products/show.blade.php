@extends('layouts.app')
@section('title', $product->name)

@section('content')
<section class="py-4 border-bottom" style="background: var(--bg-off);">
    <div class="container">
        <p class="text-muted small mb-0">
            <a href="{{ route('home') }}" class="text-link text-muted">Beranda</a> /
            <a href="{{ route('products.index') }}" class="text-link text-muted">Katalog</a> /
            <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="text-link text-muted">{{ $product->category->name }}</a> /
            {{ $product->name }}
        </p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6">
                <div style="background:#f5f5f0; border:1px solid var(--border);">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-100" style="max-height:460px; object-fit:contain; padding:1rem;">
                </div>
            </div>
            <div class="col-lg-6">
                <span class="badge-min mb-3 d-inline-block">{{ $product->category->name }}</span>
                <h1 style="font-weight:400; font-size:1.8rem;" class="mb-2">{{ $product->name }}</h1>
                <p class="text-muted small mb-4">
                    {{ $product->stock > 0 ? 'Tersedia — ' . $product->stock . ' pcs' : 'Pre-order' }}
                </p>

                <div class="py-3 border-top border-bottom mb-4" style="border-color: var(--border) !important;">
                    <span style="font-size:1.5rem; font-weight:600;">{{ $product->formatted_price }}</span>
                </div>

                <p class="text-muted mb-4" style="line-height:1.75;">{{ $product->description }}</p>

                <div class="row g-3 mb-4 small">
                    @if($product->weight)
                    <div class="col-6">
                        <span class="text-muted d-block">Berat</span>
                        <span>{{ $product->weight }}</span>
                    </div>
                    @endif
                    @if($product->flavor)
                    <div class="col-6">
                        <span class="text-muted d-block">Varian</span>
                        <span>{{ $product->flavor }}</span>
                    </div>
                    @endif
                    <div class="col-6">
                        <span class="text-muted d-block">Kategori</span>
                        <span>{{ $product->category->name }}</span>
                    </div>
                    <div class="col-6">
                        <span class="text-muted d-block">Produsen</span>
                        <span>PT Duta Jaya Bakery</span>
                    </div>
                </div>

                <div class="d-flex gap-3">
                    <a href="https://wa.me/6281234567890?text={{ urlencode('Halo Duta Bakery, saya ingin memesan ' . $product->name . ' (' . $product->formatted_price . ')') }}" target="_blank" class="btn btn-dark flex-grow-1">
                        Pesan via WhatsApp
                    </a>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-dark">← Kembali</a>
                </div>
            </div>
        </div>

        @if($relatedProducts->count() > 0)
        <div class="mt-5 pt-5 border-top" style="border-color: var(--border) !important;">
            <p class="section-label">Produk Terkait</p>
            <div class="row g-4">
                @foreach($relatedProducts as $rel)
                <div class="col-6 col-md-3">
                    <div class="card-min h-100">
                        <a href="{{ route('products.show', $rel->slug) }}">
                            <div style="background:#f5f5f0;"><img src="{{ $rel->image_url }}" alt="{{ $rel->name }}" class="w-100" style="height:150px; object-fit:cover;"></div>
                        </a>
                        <div class="p-3">
                            <h6 class="small mb-1"><a href="{{ route('products.show', $rel->slug) }}" class="text-link">{{ $rel->name }}</a></h6>
                            <span class="price small">{{ $rel->formatted_price }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
