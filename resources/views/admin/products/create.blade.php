@extends('layouts.admin')

@section('title', 'Tambah Produk')
@section('page_title', 'Tambah Produk Baru')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        {{-- Validation Info --}}
        <div class="card-admin p-3 mb-4" style="background:var(--bg-off);">
            <span class="section-label d-block mb-1">Ketentuan Validasi</span>
            <ul class="mb-0 small ps-3 text-muted" style="font-size:.8rem;">
                <li><strong>Wajib diisi:</strong> Nama, Kategori, Harga, Stok, Deskripsi.</li>
                <li><strong>Max karakter:</strong> Nama 150, Deskripsi 2000.</li>
                <li><strong>Tipe data:</strong> Harga (numeric ≥ 0), Stok (integer ≥ 0), Gambar (jpeg/png/webp/svg, max 2MB).</li>
            </ul>
        </div>

        <div class="card-admin p-4 p-md-5">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom" style="border-color:var(--border)!important;">
                <div>
                    <h5 class="mb-1" style="font-weight:300;">Form Produk Baru</h5>
                    <p class="text-muted small mb-0">Isi data produk dengan lengkap.</p>
                </div>
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-dark btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">
                    {{-- Kategori --}}
                    <div class="col-md-6">
                        <label for="category_id" class="section-label d-block mb-1">Kategori <span style="color:#c00;">*</span></label>
                        <select name="category_id" id="category_id" class="form-select rounded-0 @error('category_id') is-invalid @enderror" style="border-color:var(--border);" required>
                            <option value="">— Pilih Kategori —</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Nama --}}
                    <div class="col-md-6">
                        <label for="name" class="section-label d-block mb-1">Nama Produk <span style="color:#c00;">*</span></label>
                        <input type="text" name="name" id="name" class="form-control rounded-0 @error('name') is-invalid @enderror" style="border-color:var(--border);" placeholder="Roti Sobek Cokelat" value="{{ old('name') }}" required maxlength="150">
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Harga --}}
                    <div class="col-md-6">
                        <label for="price" class="section-label d-block mb-1">Harga (Rp) <span style="color:#c00;">*</span></label>
                        <input type="number" name="price" id="price" class="form-control rounded-0 @error('price') is-invalid @enderror" style="border-color:var(--border);" placeholder="15000" value="{{ old('price') }}" required min="0">
                        @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Stok --}}
                    <div class="col-md-6">
                        <label for="stock" class="section-label d-block mb-1">Stok (Pcs) <span style="color:#c00;">*</span></label>
                        <input type="number" name="stock" id="stock" class="form-control rounded-0 @error('stock') is-invalid @enderror" style="border-color:var(--border);" placeholder="25" value="{{ old('stock', 10) }}" required min="0">
                        @error('stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Berat --}}
                    <div class="col-md-6">
                        <label for="weight" class="section-label d-block mb-1">Berat / Ukuran</label>
                        <input type="text" name="weight" id="weight" class="form-control rounded-0 @error('weight') is-invalid @enderror" style="border-color:var(--border);" placeholder="120 gram" value="{{ old('weight') }}" maxlength="100">
                        @error('weight')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Varian Rasa --}}
                    <div class="col-md-6">
                        <label for="flavor" class="section-label d-block mb-1">Varian Rasa</label>
                        <input type="text" name="flavor" id="flavor" class="form-control rounded-0 @error('flavor') is-invalid @enderror" style="border-color:var(--border);" placeholder="Keju Cheddar" value="{{ old('flavor') }}" maxlength="100">
                        @error('flavor')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Upload Foto --}}
                    <div class="col-12">
                        <label for="image" class="section-label d-block mb-1">Foto Produk</label>
                        <input type="file" name="image" id="imageInput" class="form-control rounded-0 @error('image') is-invalid @enderror" style="border-color:var(--border);" accept="image/jpeg,image/png,image/jpg,image/webp,image/svg+xml">
                        <small class="text-muted" style="font-size:.72rem;">JPG, PNG, WEBP, SVG — max 2MB</small>
                        @error('image')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror

                        <div id="imagePreviewContainer" class="mt-2 d-none">
                            <span class="text-muted small d-block mb-1">Pratinjau:</span>
                            <img id="imagePreview" src="#" alt="Preview" style="max-height:140px;max-width:200px;object-fit:contain;border:1px solid var(--border);">
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="col-12">
                        <label for="description" class="section-label d-block mb-1">Deskripsi <span style="color:#c00;">*</span></label>
                        <textarea name="description" id="description" rows="4" class="form-control rounded-0 @error('description') is-invalid @enderror" style="border-color:var(--border);" placeholder="Jelaskan cita rasa, bahan, dan saran penyajian..." required maxlength="2000">{{ old('description') }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Unggulan --}}
                    <div class="col-12">
                        <div class="form-check p-3" style="background:var(--bg-off);border:1px solid var(--border);">
                            <input class="form-check-input rounded-0 ms-0 me-2" type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} style="border-color:var(--border);">
                            <label class="form-check-label small" for="is_featured" style="font-weight:500;">
                                Tampilkan sebagai produk unggulan di halaman utama
                            </label>
                        </div>
                    </div>

                    {{-- Buttons --}}
                    <div class="col-12 mt-4 pt-3 border-top d-flex gap-2 justify-content-end" style="border-color:var(--border)!important;">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-dark">Batal</a>
                        <button type="submit" class="btn btn-dark">Simpan Produk</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const imageInput = document.getElementById('imageInput');
    const imagePreviewContainer = document.getElementById('imagePreviewContainer');
    const imagePreview = document.getElementById('imagePreview');

    if (imageInput) {
        imageInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imagePreview.setAttribute('src', e.target.result);
                    imagePreviewContainer.classList.remove('d-none');
                }
                reader.readAsDataURL(file);
            } else {
                imagePreviewContainer.classList.add('d-none');
            }
        });
    }
</script>
@endsection
