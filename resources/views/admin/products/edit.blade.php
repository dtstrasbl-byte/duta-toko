@extends('layouts.admin')

@section('title', 'Ubah Produk')
@section('page_title', 'Edit: ' . $product->name)

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card-admin p-4 p-md-5">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom" style="border-color:var(--border)!important;">
                <div>
                    <h5 class="mb-1" style="font-weight:300;">Edit Produk</h5>
                    <p class="text-muted small mb-0">Ubah data, harga, stok, atau foto produk.</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('products.show', $product->slug) }}" target="_blank" class="btn btn-outline-dark btn-sm">Pratinjau</a>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-dark btn-sm">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>

            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    {{-- Kategori --}}
                    <div class="col-md-6">
                        <label for="category_id" class="section-label d-block mb-1">Kategori <span style="color:#c00;">*</span></label>
                        <select name="category_id" id="category_id" class="form-select rounded-0 @error('category_id') is-invalid @enderror" style="border-color:var(--border);" required>
                            <option value="">— Pilih Kategori —</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Nama --}}
                    <div class="col-md-6">
                        <label for="name" class="section-label d-block mb-1">Nama Produk <span style="color:#c00;">*</span></label>
                        <input type="text" name="name" id="name" class="form-control rounded-0 @error('name') is-invalid @enderror" style="border-color:var(--border);" value="{{ old('name', $product->name) }}" required maxlength="150">
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Harga --}}
                    <div class="col-md-6">
                        <label for="price" class="section-label d-block mb-1">Harga (Rp) <span style="color:#c00;">*</span></label>
                        <input type="number" name="price" id="price" class="form-control rounded-0 @error('price') is-invalid @enderror" style="border-color:var(--border);" value="{{ old('price', $product->price) }}" required min="0">
                        @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Stok --}}
                    <div class="col-md-6">
                        <label for="stock" class="section-label d-block mb-1">Stok (Pcs) <span style="color:#c00;">*</span></label>
                        <input type="number" name="stock" id="stock" class="form-control rounded-0 @error('stock') is-invalid @enderror" style="border-color:var(--border);" value="{{ old('stock', $product->stock) }}" required min="0">
                        @error('stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Berat --}}
                    <div class="col-md-6">
                        <label for="weight" class="section-label d-block mb-1">Berat / Ukuran</label>
                        <input type="text" name="weight" id="weight" class="form-control rounded-0 @error('weight') is-invalid @enderror" style="border-color:var(--border);" value="{{ old('weight', $product->weight) }}" maxlength="100">
                        @error('weight')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Varian Rasa --}}
                    <div class="col-md-6">
                        <label for="flavor" class="section-label d-block mb-1">Varian Rasa</label>
                        <input type="text" name="flavor" id="flavor" class="form-control rounded-0 @error('flavor') is-invalid @enderror" style="border-color:var(--border);" value="{{ old('flavor', $product->flavor) }}" maxlength="100">
                        @error('flavor')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Foto Saat Ini & Upload --}}
                    <div class="col-12">
                        <label class="section-label d-block mb-2">Foto Produk</label>
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" style="width:80px;height:80px;object-fit:cover;border:1px solid var(--border);">
                            <div class="flex-grow-1">
                                <small class="text-muted d-block mb-1">Saat ini: <code>{{ $product->image ?? 'default' }}</code></small>
                                <input type="file" name="image" id="imageInputEdit" class="form-control rounded-0 @error('image') is-invalid @enderror" style="border-color:var(--border);" accept="image/jpeg,image/png,image/jpg,image/webp,image/svg+xml">
                                <small class="text-muted" style="font-size:.72rem;">Kosongkan jika tidak ingin mengganti. Max 2MB.</small>
                            </div>
                        </div>

                        <div id="imagePreviewContainerEdit" class="mt-2 d-none">
                            <span class="text-muted small d-block mb-1">Pratinjau baru:</span>
                            <img id="imagePreviewEdit" src="#" alt="Preview" style="max-height:140px;max-width:200px;object-fit:contain;border:1px solid var(--border);">
                        </div>
                        @error('image')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="col-12">
                        <label for="description" class="section-label d-block mb-1">Deskripsi <span style="color:#c00;">*</span></label>
                        <textarea name="description" id="description" rows="4" class="form-control rounded-0 @error('description') is-invalid @enderror" style="border-color:var(--border);" required maxlength="2000">{{ old('description', $product->description) }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Unggulan --}}
                    <div class="col-12">
                        <div class="form-check p-3" style="background:var(--bg-off);border:1px solid var(--border);">
                            <input class="form-check-input rounded-0 ms-0 me-2" type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }} style="border-color:var(--border);">
                            <label class="form-check-label small" for="is_featured" style="font-weight:500;">
                                Tampilkan sebagai produk unggulan di halaman utama
                            </label>
                        </div>
                    </div>

                    {{-- Buttons --}}
                    <div class="col-12 mt-4 pt-3 border-top d-flex gap-2 justify-content-end" style="border-color:var(--border)!important;">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-dark">Batal</a>
                        <button type="submit" class="btn btn-dark">Perbarui Produk</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const imageInputEdit = document.getElementById('imageInputEdit');
    const imagePreviewContainerEdit = document.getElementById('imagePreviewContainerEdit');
    const imagePreviewEdit = document.getElementById('imagePreviewEdit');

    if (imageInputEdit) {
        imageInputEdit.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imagePreviewEdit.setAttribute('src', e.target.result);
                    imagePreviewContainerEdit.classList.remove('d-none');
                }
                reader.readAsDataURL(file);
            } else {
                imagePreviewContainerEdit.classList.add('d-none');
            }
        });
    }
</script>
@endsection
