@extends('layouts.admin')

@section('title', 'Kelola Produk')
@section('page_title', 'Daftar Produk')

@section('content')
{{-- Header --}}
<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <h5 class="mb-1" style="font-weight:300;">Manajemen Produk</h5>
        <p class="text-muted small mb-0">Kelola katalog produk, harga, stok, serta foto produk.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-dark btn-sm">Kategori</a>
        <a href="{{ route('admin.products.create') }}" class="btn btn-dark btn-sm">+ Tambah Produk</a>
    </div>
</div>

{{-- Search & Filter --}}
<div class="card-admin p-3 mb-4">
    <form action="{{ route('admin.products.index') }}" method="GET" class="row g-2 align-items-end">
        <div class="col-md-6">
            <input type="text" name="search" class="form-control rounded-0" style="border-color:var(--border);" placeholder="Cari nama produk..." value="{{ request('search') }}">
        </div>
        <div class="col-md-4">
            <select name="category_id" class="form-select rounded-0" style="border-color:var(--border);" onchange="this.form.submit()">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 d-flex gap-2">
            <button type="submit" class="btn btn-dark w-100">Cari</button>
            @if(request()->hasAny(['search', 'category_id']))
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-dark" title="Reset">
                    <i class="bi bi-x-lg"></i>
                </a>
            @endif
        </div>
    </form>
</div>

{{-- Product Table --}}
<div class="card-admin">
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th style="width:40px;">No</th>
                    <th style="width:60px;">Foto</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Unggulan</th>
                    <th class="text-center" style="width:140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $index => $product)
                    <tr>
                        <td class="text-muted small">{{ $products->firstItem() + $index }}</td>
                        <td>
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" style="width:44px;height:44px;object-fit:cover;border:1px solid var(--border);">
                        </td>
                        <td>
                            <a href="{{ route('products.show', $product->slug) }}" target="_blank" class="text-decoration-none" style="color:var(--text);font-weight:500;font-size:.88rem;">
                                {{ $product->name }}
                            </a>
                            <div class="text-muted" style="font-size:.72rem;">
                                @if($product->weight)<span class="me-2">{{ $product->weight }}</span>@endif
                                @if($product->flavor)<span>{{ $product->flavor }}</span>@endif
                            </div>
                        </td>
                        <td><span class="badge-min">{{ $product->category->name }}</span></td>
                        <td style="font-size:.88rem;">{{ $product->formatted_price }}</td>
                        <td><span class="badge-min">{{ $product->stock }} pcs</span></td>
                        <td>
                            @if($product->is_featured)
                                <span class="badge-min" style="border-color:var(--text);color:var(--text);">Ya</span>
                            @else
                                <span class="badge-min">Tidak</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('products.show', $product->slug) }}" target="_blank" class="btn btn-outline-dark btn-sm px-2 py-1 me-1" style="font-size:.68rem;" title="Lihat">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-outline-dark btn-sm px-2 py-1 me-1" style="font-size:.68rem;" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <button type="button" class="btn btn-outline-dark btn-sm px-2 py-1" style="font-size:.68rem;" title="Hapus" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $product->id }}">
                                <i class="bi bi-trash"></i>
                            </button>

                            {{-- Delete Modal --}}
                            <div class="modal fade text-start" id="deleteModal{{ $product->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-0 border" style="border-color:var(--border)!important;">
                                        <div class="modal-header border-bottom" style="border-color:var(--border)!important;">
                                            <h6 class="modal-title" style="font-weight:500;">Hapus Produk</h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" style="font-size:.6rem;"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="small mb-3">Apakah Anda yakin ingin menghapus produk ini?</p>
                                            <div class="d-flex align-items-center gap-3 p-3" style="background:var(--bg-off);border:1px solid var(--border);">
                                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" style="width:44px;height:44px;object-fit:cover;border:1px solid var(--border);">
                                                <div>
                                                    <strong class="d-block" style="font-size:.88rem;">{{ $product->name }}</strong>
                                                    <small class="text-muted">{{ $product->formatted_price }}</small>
                                                </div>
                                            </div>
                                            <small class="text-muted d-block mt-2">Data dan foto akan dihapus permanen.</small>
                                        </div>
                                        <div class="modal-footer border-top" style="border-color:var(--border)!important;">
                                            <button type="button" class="btn btn-outline-dark btn-sm" data-bs-dismiss="modal">Batal</button>
                                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-dark btn-sm">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted small">
                            Belum ada produk.
                            <div class="mt-2">
                                <a href="{{ route('admin.products.create') }}" class="btn btn-dark btn-sm">+ Tambah Produk</a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($products->hasPages())
        <div class="p-3 border-top d-flex justify-content-center" style="border-color:var(--border)!important;">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
