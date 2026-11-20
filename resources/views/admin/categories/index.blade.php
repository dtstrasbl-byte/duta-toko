@extends('layouts.admin')

@section('title', 'Kelola Kategori')
@section('page_title', 'Kategori')

@section('content')
<div class="row g-4">
    {{-- Form Tambah Kategori --}}
    <div class="col-lg-4">
        <div class="card-admin p-4">
            <span class="section-label d-block mb-3">Tambah Kategori Baru</span>

            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="section-label d-block mb-1">Nama <span style="color:#c00;">*</span></label>
                    <input type="text" name="name" id="name" class="form-control rounded-0 @error('name') is-invalid @enderror" style="border-color:var(--border);" placeholder="Donat & Bomboloni" value="{{ old('name') }}" required maxlength="100">
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="icon" class="section-label d-block mb-1">Icon</label>
                    <input type="text" name="icon" id="icon" class="form-control rounded-0 @error('icon') is-invalid @enderror" style="border-color:var(--border);" placeholder="bi-egg-fried" value="{{ old('icon', 'bi-bag-heart') }}" maxlength="50">
                    <small class="text-muted" style="font-size:.7rem;">Class Bootstrap Icons</small>
                </div>

                <div class="mb-3">
                    <label for="description" class="section-label d-block mb-1">Deskripsi</label>
                    <textarea name="description" id="description" rows="3" class="form-control rounded-0 @error('description') is-invalid @enderror" style="border-color:var(--border);" placeholder="Penjelasan singkat...">{{ old('description') }}</textarea>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <button type="submit" class="btn btn-dark w-100">Simpan Kategori</button>
            </form>
        </div>
    </div>

    {{-- Tabel Kategori --}}
    <div class="col-lg-8">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <span class="section-label">Daftar Kategori</span>
            <span class="badge-min">{{ $categories->count() }} total</span>
        </div>
        <div class="card-admin">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th style="width:40px;">Icon</th>
                            <th>Nama</th>
                            <th>Slug</th>
                            <th>Produk</th>
                            <th class="text-end" style="width:120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>
                                    <i class="bi {{ $category->icon ?? 'bi-bag-heart' }}" style="font-size:1.1rem;color:var(--muted);"></i>
                                </td>
                                <td>
                                    <strong style="font-size:.88rem;">{{ $category->name }}</strong>
                                    @if($category->description)
                                        <div class="text-muted" style="font-size:.72rem;">{{ Str::limit($category->description, 50) }}</div>
                                    @endif
                                </td>
                                <td><code style="font-size:.75rem;">{{ $category->slug }}</code></td>
                                <td><span class="badge-min">{{ $category->products_count }}</span></td>
                                <td class="text-end">
                                    <button type="button" class="btn btn-outline-dark btn-sm px-2 py-1 me-1" style="font-size:.68rem;" data-bs-toggle="modal" data-bs-target="#editCatModal{{ $category->id }}" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-dark btn-sm px-2 py-1" style="font-size:.68rem;" data-bs-toggle="modal" data-bs-target="#deleteCatModal{{ $category->id }}" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                    {{-- Edit Modal --}}
                                    <div class="modal fade text-start" id="editCatModal{{ $category->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content rounded-0 border" style="border-color:var(--border)!important;">
                                                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header border-bottom" style="border-color:var(--border)!important;">
                                                        <h6 class="modal-title" style="font-weight:500;">Edit: {{ $category->name }}</h6>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" style="font-size:.6rem;"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="section-label d-block mb-1">Nama</label>
                                                            <input type="text" name="name" class="form-control rounded-0" style="border-color:var(--border);" value="{{ $category->name }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="section-label d-block mb-1">Icon</label>
                                                            <input type="text" name="icon" class="form-control rounded-0" style="border-color:var(--border);" value="{{ $category->icon }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="section-label d-block mb-1">Deskripsi</label>
                                                            <textarea name="description" rows="3" class="form-control rounded-0" style="border-color:var(--border);">{{ $category->description }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer border-top" style="border-color:var(--border)!important;">
                                                        <button type="button" class="btn btn-outline-dark btn-sm" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-dark btn-sm">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Delete Modal --}}
                                    <div class="modal fade text-start" id="deleteCatModal{{ $category->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content rounded-0 border" style="border-color:var(--border)!important;">
                                                <div class="modal-header border-bottom" style="border-color:var(--border)!important;">
                                                    <h6 class="modal-title" style="font-weight:500;">Hapus Kategori</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="font-size:.6rem;"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="small mb-2">Hapus kategori <strong>"{{ $category->name }}"</strong>?</p>
                                                    @if($category->products_count > 0)
                                                        <div class="p-2 small text-muted" style="background:var(--bg-off);border:1px solid var(--border);">
                                                            Kategori ini memiliki <strong>{{ $category->products_count }} produk</strong>. Pindahkan atau hapus produk terlebih dahulu.
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="modal-footer border-top" style="border-color:var(--border)!important;">
                                                    <button type="button" class="btn btn-outline-dark btn-sm" data-bs-dismiss="modal">Batal</button>
                                                    @if($category->products_count == 0)
                                                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-dark btn-sm">Hapus</button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted small">Belum ada kategori.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
