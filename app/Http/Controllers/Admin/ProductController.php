<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Menampilkan daftar semua produk (Admin).
     */
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->latest()->paginate(10)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    /**
     * Menampilkan form tambah produk baru.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Menyimpan produk baru ke database dengan validasi sisi server.
     */
    public function store(Request $request)
    {
        // Validasi sisi server (Memenuhi ketentuan UTS: wajib diisi, batas maksimal karakter, tipe data)
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:150',
            'description' => 'required|string|max:2000',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'weight' => 'nullable|string|max:100',
            'flavor' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'is_featured' => 'nullable|boolean',
        ], [
            'name.required' => 'Nama produk roti/kue wajib diisi.',
            'name.max' => 'Nama produk maksimal 150 karakter.',
            'category_id.required' => 'Kategori produk wajib dipilih.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.',
            'price.required' => 'Harga produk wajib diisi.',
            'price.numeric' => 'Harga produk harus berupa angka/nominal yang valid.',
            'price.min' => 'Harga tidak boleh kurang dari 0.',
            'stock.required' => 'Jumlah stok wajib diisi.',
            'stock.integer' => 'Stok produk harus berupa bilangan bulat.',
            'stock.min' => 'Stok produk tidak boleh kurang dari 0.',
            'description.required' => 'Deskripsi produk wajib diisi.',
            'description.max' => 'Deskripsi produk maksimal 2000 karakter.',
            'image.image' => 'File yang diunggah harus berupa file gambar.',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, webp, atau svg.',
            'image.max' => 'Ukuran gambar maksimal adalah 2MB.',
        ]);

        // Upload file gambar ke storage/public/products
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        // Generate slug unik
        $baseSlug = Str::slug($validated['name']);
        $slug = $baseSlug;
        $counter = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }
        $validated['slug'] = $slug;
        $validated['is_featured'] = $request->has('is_featured');

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk "' . $validated['name'] . '" berhasil ditambahkan ke katalog Duta Bakery!');
    }

    /**
     * Menampilkan form edit produk.
     */
    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Memperbarui data produk dengan validasi sisi server.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:150',
            'description' => 'required|string|max:2000',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'weight' => 'nullable|string|max:100',
            'flavor' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'is_featured' => 'nullable|boolean',
        ], [
            'name.required' => 'Nama produk roti/kue wajib diisi.',
            'name.max' => 'Nama produk maksimal 150 karakter.',
            'category_id.required' => 'Kategori produk wajib dipilih.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.',
            'price.required' => 'Harga produk wajib diisi.',
            'price.numeric' => 'Harga produk harus berupa angka/nominal yang valid.',
            'price.min' => 'Harga tidak boleh kurang dari 0.',
            'stock.required' => 'Jumlah stok wajib diisi.',
            'stock.integer' => 'Stok produk harus berupa bilangan bulat.',
            'stock.min' => 'Stok produk tidak boleh kurang dari 0.',
            'description.required' => 'Deskripsi produk wajib diisi.',
            'description.max' => 'Deskripsi produk maksimal 2000 karakter.',
            'image.image' => 'File yang diunggah harus berupa file gambar.',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, webp, atau svg.',
            'image.max' => 'Ukuran gambar maksimal adalah 2MB.',
        ]);

        // Handle update image
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada dan file bukan bawaan seeder
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                // Keep sample seeder SVGs if user wants or remove safely
                if (!str_contains($product->image, 'svg')) {
                    Storage::disk('public')->delete($product->image);
                }
            }

            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        // Perbarui slug jika nama berubah
        if ($product->name !== $validated['name']) {
            $baseSlug = Str::slug($validated['name']);
            $slug = $baseSlug;
            $counter = 1;
            while (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                $slug = $baseSlug . '-' . $counter++;
            }
            $validated['slug'] = $slug;
        }

        $validated['is_featured'] = $request->has('is_featured');

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Data produk "' . $product->name . '" berhasil diperbarui!');
    }

    /**
     * Menghapus produk dari database.
     */
    public function destroy(Product $product)
    {
        $name = $product->name;

        // Hapus file gambar jika ada
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            if (!str_contains($product->image, 'svg')) {
                Storage::disk('public')->delete($product->image);
            }
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk "' . $name . '" berhasil dihapus dari sistem.');
    }
}
