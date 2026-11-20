<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PublicProductController extends Controller
{
    /**
     * Menampilkan katalog publik produk dengan filter dan search.
     */
    public function index(Request $request)
    {
        $query = Product::with('category');

        // Filter berdasarkan kategori
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Pencarian berdasarkan nama produk atau deskripsi
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('flavor', 'like', "%{$search}%");
            });
        }

        // Urutkan data
        switch ($request->get('sort')) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'latest':
            default:
                $query->latest();
                break;
        }

        $products = $query->paginate(9)->withQueryString();
        $categories = Category::withCount('products')->get();
        $selectedCategory = $request->filled('category') 
            ? Category::where('slug', $request->category)->first() 
            : null;

        return view('products.index', compact('products', 'categories', 'selectedCategory'));
    }

    /**
     * Menampilkan halaman detail produk.
     */
    public function show(string $slug)
    {
        $product = Product::with('category')->where('slug', $slug)->firstOrFail();

        // Produk terkait dalam kategori yang sama
        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}
